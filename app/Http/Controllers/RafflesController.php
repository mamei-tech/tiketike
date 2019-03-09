<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\TkTk\CodesGenerator;
use App\Notifications\RaffleCreated;
use App\Promo;
use App\RaffleStatus;
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
        $this->raffleRepository = $raffleRepository;
    }


    // TODO Identify which methods apply to convert to rest method !!!!
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
        //TODO: Add some catcha in this form for the users/clients

        $categories = RaffleCategory::all();

        return view('raffles.create', [
            'rcategories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRaffleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // TODO Need validation, the raffle must own of the current user
    public function edit($id)
    {
        $raffle = Raffle::find($id);

        $categories = RaffleCategory::all();
        return view('raffles.edit', [
            'raffle' => $raffle,
            'rcategories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // TODO Need validation on a custom reques class, the raffle must own of the current user
    public function update(Request $request, $id)
    {
        $raffle = Raffle::find($id);
        $raffle->title = $request->get('title');
        $raffle->description = $request->get('description');
        $raffle->price = $request->get('price');
        $raffle->category = $request->get('category');
        $raffle->save();
        return redirect()
            ->route('raffles.index',null, '303')
            ->with('success','Raffle updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function follow($id)
    {
        $raffle = Raffle::find($id);
        $raffle->getFollowers()->sync(User::find(Auth::user()->id));
        return redirect()->back()
            ->with('success', 'Raffle follow successfully');
    }
}
