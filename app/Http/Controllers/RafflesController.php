<?php

namespace App\Http\Controllers;

use App\Http\Aux\CodesGenerator;
use App\RaffleStatus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Raffle;
use App\RaffleCategory;
use App\Http\Requests\StoreRaffleRequest;


class RafflesController extends Controller
{
    // TODO Identify which methods apply to convert to rest method !!!!
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $raffles = Raffle::paginate(3);
//        var_dump($raffles->first()->getOwner->lastname);
//        die();
        return view('raffles')->with('raffles', $raffles);
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
    public function store(StoreRaffleRequest $request)
    {
        $raffle = new Raffle;

        $raffle->id = CodesGenerator::newRaffleId();
        $raffle->owner = Auth::id();
        $raffle->category = $request->category;
        $raffle->status = RaffleStatus::where('status', 'Unpublished')->first()->id;    // Unpublished by default.
        $raffle->title = $request->title;
        $raffle->description = $request->description;
        $raffle->price = $request->price;

        $raffle->save();

        return redirect()
            ->route('raffles.create',null, '303')
            ->with('success','Raffle ' . $raffle->code . ' create successfully');
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

    /**
     *
     * Anullate the raffle
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function null($id) {
        $raffle = Raffle::find($id);
        $raffle->anullate();

        return redirect()->back()
            ->with('success', 'Raffle "' . $id . '" anulled successfully');

    }

    public function follow($id)
    {
        $raffle = Raffle::find($id);
        $raffle->getFollowers()->sync(User::find(Auth::user()->id));
        return redirect()->back()
            ->with('success', 'Raffle follow successfully');
    }
}
