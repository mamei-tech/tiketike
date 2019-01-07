<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ChkRPublishRequest;
use App\Http\TkTk\Cfg\CfgRaffles;
use App\Http\TkTk\Formula;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Raffle;

class URaffleController extends ApiController
{
    private $cfghandler =  null;                        // Raffle configs handler

    public function __construct()
    {
        /* -- The rest of the thing -- */
        // Makin a new config handler
        $this->cfghandler = new CfgRaffles();
    }

    /**
     * Compute the missing (tkcount or tkprice) values for publishing the raffle
     *
     * @param ChkRPublishRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function compute(ChkRPublishRequest $request)
    {
        $this->setStatusCode(Response::HTTP_OK);

        $missingValue = null;             //Value of field requested
        $rafflePublishData = null;

        // Finding raffle price
        $raffleprice = Raffle::find($request->id)->price;

        //Determining wich value should compute. 'tcount' or 'tprice'
        if ($request->criteria == 'tcount')
        {
            $missingValue = Formula::calcTicketCount(
                $raffleprice,
                $request->profit,
                $request->commissions,
                $request->tprice,
                $this->cfghandler->getConfig('gwfee')->value
            );
            $rafflePublishData = [
                'price'        => $raffleprice,
                'profit'       => $request->profit,
                'commissions'  => $request->commissions,
                'tprice'       => $request->tprice,
                'tcount'       => $missingValue
            ];
        }
        else if ($request->criteria == 'tprice')
        {
            $missingValue = Formula::calcTicketsPrice (
                $raffleprice,
                $request->profit,
                $request->commissions,
                $request->tcount,
                $this->cfghandler->getConfig('gwfee')->value
            );
            $rafflePublishData = [
                'price'        => $raffleprice,
                'profit'       => $request->profit,
                'commissions'  => $request->commissions,
                'tcount'       => $request->tcount,
                'tprice'       => $missingValue
            ];
        }
        else{
            // Wrong request, unknown criteria
            return $this->respond([
                'status' => 'fail',
                'status_code' => '501',
                'message' => 'Something is wrong with the request'
            ]);
        }

        // Good response
        return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            //'message' => 'Testing'

            // Payload
            $request->criteria => $missingValue,
        ])->cookie('azeroth', encrypt($rafflePublishData), 1);
    }

    public function fetchRaffle(Request $request)
    {
        $id = $request->get('id');
        $raffle = Raffle::find($id);
        return $this->respond([
            'status' => 'success',
            'status_code' => Response::HTTP_OK,
            'id' => "$id",
            'title' => "$raffle->title",
            'description' => "$raffle->description",
            'price' => $raffle->price,
            'owner' => $raffle->getOwner->id,
            'category' => $raffle->getCategory->id,
            'location' => $raffle->getLocation->id
        ])->cookie('azeroth', encrypt($raffle->toArray()), 1);
    }
}
