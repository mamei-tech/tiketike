<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Raffle;
use App\Repositories\RaffleRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class ARaffleController extends Controller
{
    private $raffleRepository;

    /**
     * Create a new controller instance.
     *
     * @param RaffleRepository $raffleRepository
     */
    public function __construct(RaffleRepository $raffleRepository)
    {
        // I think this is not needed because I have this in the route middleware
        $this->middleware('permission:anulled_raffle_list')->only(['index']);
        $this->middleware('permission:anulled_raffle_destroy')->only(['destroy']);

        $this->raffleRepository = $raffleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uraffles = $this->raffleRepository->getTenAnulleddRaffles();

        return view('admin.araffles', [
            'raffles' => $uraffles,
            'div_showRaffles' => 'show',
            'li_activeARaffles' => 'active',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $raffle = Raffle::find($id);

        // We can only delete if raffle status is Anulled or Unpublished
        if ($raffle->status == 1 || $raffle->status == 3) {
            $raffle->clearMediaCollection('raffles');
            $raffle->delete();


            // Anulled
            if ($raffle->status == 3) {

                Log::log('INFO', trans('aLogs.adm_araffle_deleted'), [
                        'user' => Auth::user()->id,
                        'raffle' => $raffle->id
                ]);

                return redirect()
                    ->route('arraffle.index', null, '303')
                    ->with('success', 'Raffle ' . $raffle->code . ' deleted successfully');
            }

            // Unpublished
            if ($raffle->status == 1) {

                Log::log('INFO', trans('aLogs.adm_araffle_deleted'), [
                    'user' => Auth::user()->id,
                    'raffle' => $raffle->id
                ]);

                return redirect()
                    ->route('unpublished.index', null, '303')
                    ->with('success', 'Raffle ' . $raffle->code . ' deleted successfully');
            }
        }

        return redirect()->back()->withErrors("The raffle to be anulled don't has the correct status");
    }
}
