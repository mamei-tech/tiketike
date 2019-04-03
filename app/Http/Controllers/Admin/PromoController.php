<?php

namespace App\Http\Controllers\Admin;

use App\Promo;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePromoRequest;
use App\Http\Requests\EditPromoRequest;
use Illuminate\Support\Facades\Log;

class PromoController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:promo_list')          ->  only(['index']);
        $this->middleware('permission:promo_store')         ->  only(['create', 'store']);
        $this->middleware('permission:promo_update')        ->  only(['update']);
        $this->middleware('permission:promo_destroy')       ->  only(['destroy']);
    }


    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promos = DB::table('promos')->get();

        return view('admin.promos', [
            'promos' => $promos,
            'div_showPromo' => 'show',
            'li_activePromoList' => 'active',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promos = DB::table('promos')->get();

        return view('admin.promos',
            [
                'promos' => $promos,
                'div_showPromo' => 'show',
                'li_activePromoList' => 'active',
                'show_create_modal' => 'show',
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePromoRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function store(StorePromoRequest $request)
    {
        $promo = Promo::create($request->all());

        // checking & saving promo img
        if ($request->has('image') and $request->file('image')->isValid()) {
            try {

                $promo->addMediaFromRequest('image')->toMediaCollection('promos', 'promos');  // Second parameters is de defaul filesystem, optional
                $promo->image = $request->image->getClientOriginalName();

                // Saving the image name
                $promo->save();

            } catch (Exception $e) {

                Log::log('ERROR', trans('aLogs.adm_promo_uploaderror').' - '.Auth::user()->id);

                $promo->delete();
                return redirect()->back()->withErrors("Something went wrong uploading the image.");
            }
        }
        // Retriving all the promos for redirect
        $promos = DB::table('promos')->get();

        Log::log('INFO', trans('aLogs.adm_promo_store'), [
            'user'  => Auth::user()->id,
            'promo_id'  => $promo->id
        ]);

        return redirect()->route('promos.index',
            [
                'promos' => $promos,
                'div_showPromo' => 'show',
                'li_activePromoList' => 'active',
            ],
            '303')
            ->with('success', 'Promo "' . $promo->name . '" created successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditPromoRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPromoRequest $request, $id)
    {
        $promo = Promo::find($id);

        if ($promo->canUpdateName($request->name)) {

            $promo->name = $request->name;
            $promo->expdate = $request->expdate;
            $promo->alternative = $request->alternative;
            $promo->website = $request->website;

            $request->type == 1 ? $promo->type = $request->type : $promo->type = 0;
            $request->status == 1 ? $promo->status = $request->status : $promo->status = 0;

            // Working with image here
            if ($request->has('image') and $request->file('image')->isValid()) {
                try {

                    $promo->addMediaFromRequest('image')->toMediaCollection('promos', 'promos');  // Second parameters is de defaul filesystem, optional
                    $promo->image = $request->image->getClientOriginalName();

                } catch (Exception $e) {

                    $promo->delete();
                    return redirect()->back()->withErrors("Something went wrong uploading the image.");
                }
            }


            $promo->save();

            // Retriving all the promos for redirect
            $promos = DB::table('promos')->get();

            Log::log('INFO', trans('aLogs.adm_promo_update'), [
                'user'      => Auth::user()->id,
                'promo_id'  => $promo->id
            ]);

            return redirect()->route('promos.index',
                [
                    'promos' => $promos,
                    'div_showPromo' => 'show',
                    'li_activePromoList' => 'active',
                ],
                '303')
                ->with('success', 'Promo "' . $promo->name . '" updated successfully');
        } else {
            return redirect()->back()->withErrors(trans('validation.name_already_taken'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $name
     * @return \Illuminate\Http\Response
     */
    public function destroy($name)
    {
        $promo = Promo::where('name', $name)->first();
        $promoname = $promo->name;
        $promo->delete();

        Log::log('INFO', trans('aLogs.adm_promo_delete'), [
            'user'      => Auth::user()->id,
            'name'      => $promoname,
        ]);

        return redirect()
            ->route('promos.index', null, '303')
            ->with('success', 'Promo "' . $promo->name . '" deleted successfully');
    }
}
