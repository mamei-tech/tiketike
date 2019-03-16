<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests\ConfirmRaffle;
use App\Http\Requests\UpdateRaffleRequest;
use App\Http\TkTk\CodesGenerator;
use App\Notifications\RaffleCreated;
use App\Notifications\RaffleUpdated;
use App\Payment;
use App\Promo;
use App\RaffleConfirmation;
use App\RaffleStatus;
use App\ReferralsBuys;
use App\Repositories\RaffleRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Raffle;
use App\RaffleCategory;
use App\Http\Requests\StoreRaffleRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Notification;


class RafflesController extends Controller
{
    /**
     * @var RaffleRepository
     */
    private $raffleRepository;

    /**
     * RafflesController constructor.
     * @param RaffleRepository $raffleRepository
     */
    public function __construct(RaffleRepository $raffleRepository)
    {
        $this->middleware('permission:raffles_create')                  ->  only(['create', 'store']);
        $this->middleware('permission:raffles_edit')                    ->  only(['edit', 'update']);
        $this->middleware('permission:raffles_follow')                  ->  only(['follow']);
        $this->middleware('permission:raffles_finished')                ->  only(['finishedView']);
        $this->middleware('permission:raffles_checkConfirmation')       ->  only(['checkConfirmation']);

        $this->raffleRepository = $raffleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suggested = $this->raffleRepository->getSuggested();
        $promos = Promo::where('type',1)->where('status',1)->get();
        $categories = RaffleCategory::all();
        $raffles = Raffle::with('getStatus')
            ->whereHas('getStatus', function (Builder $q) {
                $q->where('status', 'Published');
                $q->orWhere('status','Unpublished');
            })
            ->where('progress','<',100)
            ->orderBy('activation_date','ASC')
            ->paginate(10);
        $countries = Country::all();
        return view('raffles',compact('raffles','suggested','promos','categories','countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = RaffleCategory::all();

        return view('raffles.create', [
            'rcategories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\InvalidBase64Data
     */
    public function store(StoreRaffleRequest $request)
    {
        $raffle = new Raffle;

        $raffle->id         = CodesGenerator::newRaffleId();
        $raffle->owner      = Auth::id();
        $raffle->category   = $request->category;
        $raffle->status     = RaffleStatus::where('status', 'Unpublished')->first()->id;    // Unpublished by default.
        $raffle->title      = $request->title;
        $raffle->description= $request->description;
        $raffle->price      = $request->price;
        $raffle->location   = $request->localization;
        $raffle->owner      = Auth::user()->id;

        $raffle->save();

        foreach ($request->base as $item) {
            $raffle->addMediaFromBase64($item)->usingFileName('filename.jpg')->toMediaCollection('raffles','raffles');
        }

        Auth::user()->notify(new RaffleCreated($raffle,Auth::user()));

        return redirect()->route('main');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRaffleRequest $request, $id)
    {
        $raffle = Raffle::find($id);
        $raffle->title = $request->get('title');
        $raffle->description = $request->get('description');
        $raffle->category = $request->get('category');
        $raffle->location = $request->get('localization');
        $raffle->price = $raffle->price;
        $raffle->save();

        if ($request->base[0] != null or $request->base[1] != null or $request->base[2] != null) {
            $raffle->clearMediaCollection('raffles');
            foreach ($request->base as $item) {
                if ($item != null)
                    $raffle->addMediaFromBase64($item)->usingFileName('filename.jpg')->toMediaCollection('raffles','raffles');
            }
        }

        foreach ($raffle->getFollowers as $follower) {
            $follower->notify(new RaffleUpdated($raffle,$follower));
        }
        return redirect()
            ->back()
            ->with('success','Raffle updated successfully');
    }

    public function follow($id)
    {
        $raffle = Raffle::find($id);
        $raffle->getFollowers()->sync(User::find(Auth::user()->id));
        return redirect()->back()
            ->with('success', 'Raffle follow successfully');
    }

    public function finishedView($id)
    {
        $raffle = Raffle::findOrFail($id);
        $raffleId = $raffle->id;
        $confirmation = RaffleConfirmation::where('raffle_id',$raffle->id)->first();
        $ticket = $raffle->getTickets->where('bingo','1')->first();
        $suggested = $this->raffleRepository->getSuggested();
        $promos = Promo::where('type',1)->where('status',1)->get();
        return view('finished_raffle',compact('raffle','ticket','confirmation','raffleId','suggested','promos'));
    }

    public function checkConfirmation(ConfirmRaffle $request)
    {
        $confirmation = RaffleConfirmation::where('raffle_id',$request->get('raffleId'))->first();
        $oconfirmation = $request->get('oconfirmation') == 'on'?true:false;
        $confirmation->oconfirmation = $oconfirmation;
        $wconfirmation = $request->get('wconfirmation')=='on'?true:false;
        $confirmation->wconfirmation = $wconfirmation;
        $confirmation->save();
        $raffle = Raffle::findOrFail($request->get('raffleId'));
        if ($confirmation->oconfirmation == 1 and $confirmation->wconfirmation == 1)
        {
            $raffle->status = 6;
            $raffle->save();
            $raffle->getOwner->getProfile->balance += $raffle->price;
            $raffle->getOwner->getProfile->save();
            foreach ($raffle->getReferrals as $referral)
            {
                // TODO review if this formula is correct to assign profit to comissionist of a raffle per referral
                $referral->getComisionist->getProfile->balance += $raffle->comissions/$raffle->tickets_count;
                $referral->getComisionist->getProfile->save();
            }
            return redirect()->back()
                ->with('success', 'Congratulations!!! You booth have confirmed the raffle. Enjoy it!!!');
        }
        return redirect()->back()
            ->with('success', 'Thanks for confirm the raffle. Soon you will have news about us.');
    }
}
