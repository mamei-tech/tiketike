<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Raffle;


class ARaffleController extends Controller
{
    // TODO Identify which methods apply to convert to rest method !!!!

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // I think this is not needed because I have this in the route middleware
        // Authentication
        $this->middleware('auth');
        $this->middleware('permission:list raffles');
        $this->middleware('permission:create raffle', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit raffle', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete raffle', ['only' => ['destroy']]);

        /* TODO: Check what this is for, how to use it */
        // Authorization
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uraffles = Raffle::getAnulleddRaffles();

        return view('admin.araffles', [
            'raffles' => $uraffles,
            'div_showRaffles' => 'show',
            'li_activeARaffles' => 'active',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $raffle = Raffle::find($id);

        // We can only delete if raffle status is Anulled or Unpublished
        if($raffle->status == 1 || $raffle->status == 3)
        {
            $raffle->clearMediaCollection('raffles');
            $raffle->delete();


            // Anulled
            if($raffle->status == 3) {
                return redirect()
                    ->route('arraffle.index',null, '303')
                    ->with('success','Raffle ' . $raffle->code . ' deleted successfully');
            }

            // Unpublished
            if($raffle->status == 1){
                return redirect()
                    ->route('unpublished.index',null, '303')
                    ->with('success','Raffle ' . $raffle->code . ' deleted successfully');
            }
        }

        return redirect()->back()->withErrors("The raffle to be anulled don't has the correct status");
    }
}
