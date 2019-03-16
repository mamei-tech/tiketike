<?php

namespace App\Http\Controllers\Admin;

use App\PromoClient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePromoClientRequest;
use Illuminate\Support\Facades\Log;

class PromoClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:promo_c_list')          ->  only(['index']);
        $this->middleware('permission:promo_c_store')         ->  only(['store']);
        $this->middleware('permission:promo_c_update')        ->  only(['update']);
        $this->middleware('permission:promo_c_destroy')       ->  only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = DB::table('promoclients')->get();

        Log::log('INFO', trans('aLogs.adm_promoclietn_section').' - '.Auth::user()->id);

        return view('admin.promosclients', [
            'clients' => $clients,
            'div_showPromo' => 'show',
            'li_activePromoClients' => 'active',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePromoClientRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePromoClientRequest $request)
    {
        $promoclient = new PromoClient;

        $promoclient->name = $request->name;
        $promoclient->email = $request->email;
        $promoclient->contact = serialize(explode(" ", $request->contact));

        $promoclient->save();

        $clients = DB::table('promoclients')->get();

        Log::log('INFO', trans('aLogs.adm_promoclient_store').' - '.Auth::user()->id.' - '.$promoclient.':'.$promoclient->name);

        return redirect()->route('pmclients.index',
            [
                'clients' => $clients,
                'div_showPromo' => 'show',
                'li_activePromoClients' => 'active',
            ],
            '303')
            ->with('success', 'Promo Client "' . $promoclient->name . '" was created successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorePromoClientRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePromoClientRequest $request, $id)
    {
        $promoclient = PromoClient::find($id);

        $promoclient->name = $request->name;
        $promoclient->email = $request->email;
        $promoclient->contact = serialize(explode(" ", $request->contact));

        $promoclient->save();

        $clients = DB::table('promoclients')->get();

        Log::log('INFO', trans('aLogs.adm_promoclient_update').' - '.Auth::user()->id.' promoclient_id:'.$promoclient->ip);

        return redirect()->route('pmclients.index',
            [
                'clients' => $clients,
                'div_showPromo' => 'show',
                'li_activePromoClients' => 'active',
            ],
            '303')
            ->with('success', 'Promo Client with id "' . $promoclient->id . '" has updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = PromoClient::where('id', $id)->first();
        $clientname = $client->name;
        $client->delete();

        Log::log('INFO', trans('aLogs.adm_promoclient_del').' - '.Auth::user()->id.' client_name:'.$clientname);

        return redirect()
            ->route('pmclients.index', null, '303')
            ->with('success', 'Promo "' . $client->name . '" deleted successfully');
    }
}
