<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Country;
use App\Http\Controllers\Controller;
use App\Notifications\RaffleDeleted;
use App\Notifications\RaffleUpdated;
use App\Raffle;
use App\Http\Requests\ChkRPublishRequest;
use App\RaffleCategory;
use App\RaffleStatus;
use App\Repositories\RaffleRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\User;
use App\Http\TkTk\CodesGenerator;



class URaffleController extends Controller
{
    private $raffleRepository;

    /**
     * Create a new controller instance.
     *
     * @param RaffleRepository $raffleRepository
     */
    public function __construct(RaffleRepository $raffleRepository)
    {
        $this->middleware('permission:list_upublished_raffles')          ->  only(['index']);
        $this->middleware('permission:publish_upublished_raffles')       ->  only(['publish']);
        $this->middleware('permission:store_upublished_raffles')         ->  only(['store']);
        $this->middleware('permission:edit_upublished_raffles')          ->  only(['edit']);
        $this->middleware('permission:destroy_upublished_raffles')       ->  only(['destroy']);

        $this->raffleRepository = $raffleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uraffles = $this->raffleRepository->getTenUnpublishedRaffles();
        $users = User::all();
        $catefories = RaffleCategory::all();
        $countries = Country::all();

        return view('admin.uraffles', [
            'raffles' => $uraffles,
            'users' => $users,
            'categories' => $catefories,
            'countries' => $countries,
            'div_showRaffles' => 'show',
            'li_activeURaffles' => 'active',
        ]);
    }

    /**
     * Publish a raffle
     *
     * @param ChkRPublishRequest $request :PublishRaffleRequest data
     * @param $id :Raffle id
     *
     * @return \Illuminate\Http\Response
     */
    public function publish(ChkRPublishRequest $request, $id) {

        // Checking form data autenticity from 'azeroth' cookie
        if (!isset($_COOKIE['azeroth']))
            // The cookie was expired
            return redirect()->back()->withErrors(trans('validation.forminvalid'));

        // Getting the raffle
        $raffle = Raffle::findOrFail($request->id);

        // fin notificaciones
        // Getting & decripting the form data sended to the api
        $apiFormData = decrypt($_COOKIE['azeroth']);

        if ($apiFormData['price']           != $raffle  ->price
            || $apiFormData['profit']       != $request ->profit
            || $apiFormData['commissions']  != $request ->commissions
            || $apiFormData['tcount']       != $request ->tcount
            || $apiFormData['tprice']       != $request ->tprice) {

            // The form data don't match with the data sended to the api previously
            return redirect()->back()->withErrors(trans('validation.forminvalid --'));
        }

        // Everithing is OK, then Publising the raffle
        $raffle->publish($request->profit, $request->commissions, $request->tcount, $request->tprice);

        Log::log('INFO', trans('aLogs.adm_araffle_deleted'), [
            'user' => Auth::user()->id,
            'raffle'    => $raffle->id,
        ]);

        // esta parte son las notificaciones a los usuarios
        $users = $raffle->getFollowers;
        foreach ($users as $user) {
            $user->notify(new RaffleUpdated($raffle,$user));
        }

        return redirect()->route('unpublished.index',
            [
                'raffles' => $this->raffleRepository->getTenUnpublishedRaffles(),
                'div_showRaffles' => 'show',
                'li_activeURaffles' => 'active',
            ],
            '303')
            ->with('success', 'Raffle "' . $id . '" published successfully');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)    {

        $raffle                 = new Raffle;

        $raffle->id             = CodesGenerator::newRaffleId();
        $raffle->owner          = $request->owner;
        $raffle->category       = $request->category;
        $raffle->status         = RaffleStatus::where('status', 'Unpublished')->first()->id;    // Unpublished by default.
        $raffle->title          = $request->title;
        $raffle->description    = $request->description;
        $raffle->price          = $request->price;
        $raffle->location       = $request->location;

        $raffle->save();
        foreach ($request->all()['avatar'] as $item) {

            if ($request->has('avatar') and $item->isValid())
                $raffle->addMedia($item)->toMediaCollection('raffles','raffles');
        }

        Log::log('INFO', trans('aLogs.adm_created_reaffle'),
            [
                'user'      => Auth::user()->id,
                'raffle'    => $raffle->id,
            ]);

        return redirect()->route('unpublished.index',
            [
                'div_showRaffles' => 'show',
                'li_activeURaffles' => 'active',
            ],
            '303')
            ->with('success', 'Raffle created successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $raffle = Raffle::find($id);
        $raffle->title = $request->get('title');
        $raffle->description = $request->get('description');
        $raffle->price = $request->get('price');
        $raffle->category = $request->get('category');
        $raffle->location = $request->get('location');
        $raffle->save();

        foreach ($raffle->getFollowers as $user) {
            $user->notify(new RaffleUpdated($raffle,$user));
        }

        Log::log('INFO', trans('aLogs.adm_updated_reaffle'),
            [
                'user'      => Auth::user()->id,
                'raffle'    => $raffle->id,
            ]);

        return redirect()->route('unpublished.index',
            [
                'div_showRaffles' => 'show',
                'li_activeURaffles' => 'active',
            ],
            '303')
            ->with('success', 'Raffle updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $raffle = Raffle::findOrFail($id);
        foreach ($raffle->getFollowers as $user) {
            $user->notify(new RaffleDeleted($raffle,$user));
        }

        Log::log('INFO', trans('aLogs.adm_updated_delete'),
            [
                'user'      => Auth::user()->id,
            ]);

        Raffle::destroy($id);
        return redirect()->route('unpublished.index',
            [
                'div_showRaffles' => 'show',
                'li_activeURaffles' => 'active',
            ],
            '303')
            ->with('success', 'Raffle deleted successfully');
    }
}
