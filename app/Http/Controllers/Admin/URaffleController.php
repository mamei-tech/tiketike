<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use App\Raffle;
use App\Http\Requests\ChkRPublishRequest;
use App\RaffleCategory;
use App\RaffleStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\Notifications\GeneralNotification;
use App\Http\TkTk\CodesGenerator;
use Exception;


class URaffleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // I think this is not needed because I have this in the route middleware
        $this->middleware('auth');
        $this->middleware('permission:list raffles');
        $this->middleware('permission:create raffle', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit raffle', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete raffle', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uraffles = Raffle::getUnpublishedRaffles();
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
        $raffle = Raffle::find($request->id);

        //TODO esta parte son las notificaciones a los usuarios
        $users = User::get();
        Notification::send($users,new GeneralNotification('A new raffle was published.',$raffle,'raffle.tickets.available'));

        // TODO fin notificaciones


        // Getting & decripting the form data sended to the api
        $apiFormData = decrypt($_COOKIE['azeroth']);

        if ($apiFormData['price'] != $raffle->price
            || $apiFormData['profit'] != $request->profit
            || $apiFormData['commissions'] != $request->commissions
            || $apiFormData['tcount'] != $request->tcount
            || $apiFormData['tprice'] != $request->tprice) {


            // The form data don't match with the data sended to the api previously
            return redirect()->back()->withErrors(trans('validation.forminvalid --'));
        }

        // Everithing is OK, then Publising the raffle
        $raffle->publish($request->profit, $request->commissions, $request->tcount, $request->tprice);
        $users = User::get();
        // Notification::send("Hi, there's a new published raffle",$raffle, 'raffle.tickets.available');


        // TODO Try redirect with compact
        return redirect()->route('unpublished.index',
            [
                'raffles' => Raffle::getUnpublishedRaffles(),
                'div_showRaffles' => 'show',
                'li_activeURaffles' => 'active',
            ],
            '303')
            ->with('success', 'Raffle "' . $id . '" published successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $raffle = new Raffle;

        $raffle->id = CodesGenerator::newRaffleId();
        $id = $raffle->id;
        $raffle->owner = $request->owner;
        $raffle->category = $request->category;
        $raffle->status = RaffleStatus::where('status', 'Unpublished')->first()->id;    // Unpublished by default.
        $raffle->title = $request->title;
        $raffle->description = $request->description;
        $raffle->price = $request->price;
        $raffle->location = $request->location;

        $raffle->save();

        $raffle = Raffle::find($id);
        foreach ($request->all()['avatar'] as $item)
        {
            if ($request->has('avatar') and $item->isValid()) {
                $raffle->addMedia($item)->toMediaCollection('raffles','raffles');
            }

        }
        return redirect()->route('unpublished.index',
            [
                'div_showRaffles' => 'show',
                'li_activeURaffles' => 'active',
            ],
            '303')
            ->with('success', 'Raffle created successfully');
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
    public function edit($id)
    {
        //
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
        //
    }
}
