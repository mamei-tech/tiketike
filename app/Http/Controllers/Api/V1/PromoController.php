<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Promo;


class PromoController extends ApiController
{


    /**
     *
     * Retriving all promo clients
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clients()
    {
        $client = DB::table('promoclients')->select('id', 'name')->get();

        return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),

            // 'message' => 'Life is good'
            'clients'=> $client
        ]);
    }


    /**
     *
     * Retrive the rest of the promo data
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    /* TODO Make a specifical request for validating it */
    public function promodata (Request $request)
    {
        $imageurl = null;

        /*$promo = DB::table('promos')
            ->join('promoclients', 'promos.client', '=', 'promoclients.id')
            ->select('promos.alternative', 'promos.website', 'promoclients.name', 'promoclients.id')
            ->where('promos.name', '=', $request->name)
            ->first();*/

        $promo = Promo::where('name', $request->name)->first();
        $promo->getClient;

        $image = $promo->getMedia('promos')->first();
        if($image)
            $imageurl = $promo->getMedia('promos')->first()->getUrl();

        return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),

            // Getting the promo image url

            // 'message' => 'Life is good'
            'clientid' => $promo->getClient->id,
            'clientname' => $promo->getClient->name,
            'alternative' => $promo->alternative,
            'website' => $promo->website,
            'imageurl' => $imageurl
        ]);

    }
}
