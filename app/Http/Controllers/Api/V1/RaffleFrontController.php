<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChkRPublishRequest;
use App\Http\TkTk\Cfg\CfgRaffles;
use App\Raffle;
use App\Repositories\RaffleRepository;
use App\Http\Resources\RaffleResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class RaffleFrontController extends Controller
{

    public function filterRaffles(Request $request)
    {
        $category = $request->get('category');
        $countries = $request->get('countries') != null ? $request->get('countries'):null;
        $criteria = $request->get('criteria') != null ?$request->get('criteria'):null;
        $raffles = Raffle::when(($category != 'Todos' and $category != 'All'),function ($query) use($category){
                return $query->whereHas('getCategory',function (Builder $q) use ($category) {
                    $q->where('category','=',$category);
                });
            })
            ->when($countries, function ($query) use($countries) {
                return $query->whereIn('location',$countries);
            })
            ->where('progress','<',100)
            ->when($criteria, function ($query) use($criteria) {
                return $query->orderBy($criteria == 'percent'? 'progress':'tickets_price','DESC');
            })
            ->paginate(10);
        $data = RaffleResource::collection($raffles);

        $json_data = array(
            'data' => $data,
            'links' => $raffles->links()
        );

        return response()->json($json_data,200);
    }

    public function markAsRead(Request $request) {
        DB::table('notifications')->where('id','=',$request->get('id'))->update(array(
            'read_at' => date('now')
        ));
        return response()->json('Readed',200);
    }
}
