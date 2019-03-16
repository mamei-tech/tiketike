<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ChkRPublishRequest;
use App\Http\TkTk\Cfg\CfgRaffles;
use App\Raffle;
use App\Repositories\RaffleRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RaffleFrontController extends ApiController
{
    private $raffleRepository;
    private $cfghandler = null;                        // Raffle configs handler

    public function __construct(RaffleRepository $raffleRepository)
    {
        /* -- The rest of the thing -- */
        // Makin a new config handler
        $this->cfghandler = new CfgRaffles();
        $this->raffleRepository = $raffleRepository;
    }

    /**
     * Compute the missing (tkcount or tkprice) values for publishing the raffle
     *
     * @param ChkRPublishRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterByCategory(Request $request)
    {
        $raffles = null;
        $response = '';
        if ($request->get('category') == 'Todos')
            $raffles = Raffle::paginate(10);
        else
            $raffles = $this->raffleRepository->getRafflesByCategory($request->get('category'));
        foreach ($raffles as $raffle) {
            $response .= '<div class="row padding20 bg-rifas1 center-block '.$raffle->id.'">'.PHP_EOL;
            $response .= '<div class="col-xs-4 col-md-6" style="padding-left: 23px;padding-right: 0">'.PHP_EOL;
            $response .= '<div class="hidden-lg visible-xs padding-top-20 padding-left-0">'.PHP_EOL;
            $response .= '<img src="';
            if(count($raffle->getMedia('raffles')) > 0)
                $response .=$raffle->getMedia('raffles')->first()->getUrl();
            $response .='" class="dimenImgCarouselR" alt="">'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '<div id="myCarousel'.$raffle->id.'" class="carousel carouselRifas slide hidden-xs " data-ride="carousel">'.PHP_EOL;
            $response .= '<div class="carousel-inner" role="listbox">'.PHP_EOL;
            $count = 0;
            foreach ($raffle->getMedia('raffles') as $media) {
                $response .= '<div class="item';
                if($count == 0)
                    $response .= ' active';
                $response .='">'.PHP_EOL;
                $response .= '<img src="'.$media->getUrl().'" class="dimenImgCarouselR" alt="First slide"></div>'.PHP_EOL;
                $count ++;
            }
            $response .= '</div>'.PHP_EOL;
            $count = 0;
            $response .= '<ol class="carousel-indicators">'.PHP_EOL;
            while($count < count($raffle->getMedia('raffles'))) {
                $response .= '<li data-target="#myCarousel'.$raffle->id.'" data-slide-to="'.$count.'" class="';
                if($count == 0)
                    $response .= 'active';
                $response .= '"></li>'.PHP_EOL;
                $count++;
            }
            $response .= '</ol>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '<div class="col-xs-8 col-md-6 padding-top10R" style="padding-left: 5px">'.PHP_EOL;
            $response .= '<span class="texto16 colorV hidden-lg visible-xs pull-left margin-right-10 sinkinSans600SB">'.round($raffle->progress).' %</span>'.PHP_EOL;
            $response .= '<span class="texto14 colorN pull-left sinkinSans600SB texto14">'.$raffle->getOwner->name.'</span>'.PHP_EOL;
            $response .= '<span class="ti-location-pin texto16 colorN"></span>'.PHP_EOL;
            $response .= '<span class="texto14 sinkinSans600SB texto14 colorN"><img class="flag-country" src="'.asset('pics/countries/png100px/'.$raffle->getLocation->code.'.png').'"></span>'.PHP_EOL;
            $response .= '<h4 class=" text-uppercase sinkinSans400R textoR">'.PHP_EOL;
            $response .= '<a class="colorN" href="'.route('raffle.tickets.available',['raffleId' => $raffle->id]).'">'.$raffle->title.'</a>'.PHP_EOL;
            $response .= '</h4>'.PHP_EOL;
            $response .= '<div class="hidden-lg texto8">'.PHP_EOL;
            $response .= '<span class="sinkinSans300L ">Costo:</span>'.PHP_EOL;
            $response .= '<span class="sinkinSans600SB">'.$raffle->price.'</span>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '<div class="costo hidden-xs">'.PHP_EOL;
            $response .= '<div class="pull-left porcientoCompletado">'.PHP_EOL;
            $response .= '<span class="texto35 sinkinSans600SB colorN">'.round($raffle->getProgress()).' %</span><br>'.PHP_EOL;
            $response .= '<span class="sinkinSans400R">completado</span>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '<div class="pull-left padding-top-20 padding-left30">'.PHP_EOL;
            $response .= '<span class="sinkinSans300L texto10">Costo:</span><br>'.PHP_EOL;
            $response .= '<span class="colorN sinkinSans600SB">$'.$raffle->price.'</span>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '<ul class="list-unstyled list-inline padding-top-20 hidden-xs pull-right">'.PHP_EOL;
            $response .= '<li class=" margin-right-10">'.PHP_EOL;
            $response .= '<a href="'.route('raffles.follow',['raffleId' => $raffle->id]).'">'.PHP_EOL;
            $response .= '<span class="ti-face-smile texto-negrita colorV margin-right-5 texto16" title="Seguir"></span>'.PHP_EOL;
            $response .= '<span class="colorV sinkinSans600SB">Seguir</span>'.PHP_EOL;
            $response .= '</a>'.PHP_EOL;
            $response .= '</li>'.PHP_EOL;
            $response .= '<li class=" margin-right-10">'.PHP_EOL;
            $response .= '<a href="">'.PHP_EOL;
            $response .= '<span class="ti-share texto-negrita colorV margin-right-5 texto16" title="Compartir"></span>'.PHP_EOL;
            $response .= '<span class="colorV sinkinSans600SB">Compartir</span>'.PHP_EOL;
            $response .= '</a>'.PHP_EOL;
            $response .= '</li>'.PHP_EOL;
            $response .= '<li class="">'.PHP_EOL;
            $response .= '<button type="button" class="btn btn-info btnSiguiente"><span class="ti-arrow-right"></span></button>'.PHP_EOL;
            $response .= '</li>'.PHP_EOL;
            $response .= '</ul>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
        }
        $response .= $raffles->links();
        return $this->respond([
            'raffles' => $response
        ])->cookie('azeroth', encrypt($raffles->toArray()), 1);
    }

    public function filterByPercent(Request $request)
    {
        $raffles = null;
        $response = '';
        if ($request->get('category') == 'Todos')
            $raffles = Raffle::where('progress','<',100)->orderBy('progress','DESC')->paginate(10);
        else
            $raffles = $this->raffleRepository->getRafflesByCategory($request->get('category'),$request->get('criteria'));
        foreach ($raffles as $raffle) {
            $response .= '<div class="row padding20 bg-rifas1 center-block '.$raffle->id.'">'.PHP_EOL;
            $response .= '<div class="col-xs-4 col-md-6" style="padding-left: 23px;padding-right: 0">'.PHP_EOL;
            $response .= '<div class="hidden-lg visible-xs padding-top-20 padding-left-0">'.PHP_EOL;
            $response .= '<img src="';
            if(count($raffle->getMedia('raffles')) > 0)
                $response .=$raffle->getMedia('raffles')->first()->getUrl();
            $response .='" class="dimenImgCarouselR" alt="">'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '<div id="myCarousel'.$raffle->id.'" class="carousel carouselRifas slide hidden-xs " data-ride="carousel">'.PHP_EOL;
            $response .= '<div class="carousel-inner" role="listbox">'.PHP_EOL;
            $count = 0;
            foreach ($raffle->getMedia('raffles') as $media) {
                $response .= '<div class="item';
                if($count == 0)
                    $response .= ' active';
                $response .='">'.PHP_EOL;
                $response .= '<img src="'.$media->getUrl().'" class="dimenImgCarouselR" alt="First slide"></div>'.PHP_EOL;
                $count ++;
            }
            $response .= '</div>'.PHP_EOL;
            $count = 0;
            $response .= '<ol class="carousel-indicators">'.PHP_EOL;
            while($count < count($raffle->getMedia('raffles'))) {
                $response .= '<li data-target="#myCarousel'.$raffle->id.'" data-slide-to="'.$count.'" class="';
                if($count == 0)
                    $response .= 'active';
                $response .= '"></li>'.PHP_EOL;
                $count++;
            }
            $response .= '</ol>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '<div class="col-xs-8 col-md-6 padding-top10R" style="padding-left: 5px">'.PHP_EOL;
            $response .= '<span class="texto16 colorV hidden-lg visible-xs pull-left margin-right-10 sinkinSans600SB">'.round($raffle->progress).' %</span>'.PHP_EOL;
            $response .= '<span class="texto14 colorN pull-left sinkinSans600SB texto14">'.$raffle->getOwner->name.'</span>'.PHP_EOL;
            $response .= '<span class="ti-location-pin texto16 colorN"></span>'.PHP_EOL;
            $response .= '<span class="texto14 sinkinSans600SB texto14 colorN"><img class="flag-country" src="'.asset('pics/countries/png100px/'.$raffle->getLocation->code.'.png').'"></span>'.PHP_EOL;
            $response .= '<h4 class=" text-uppercase sinkinSans400R textoR">'.PHP_EOL;
            $response .= '<a class="colorN" href="'.route('raffle.tickets.available',['raffleId' => $raffle->id]).'">'.$raffle->title.'</a>'.PHP_EOL;
            $response .= '</h4>'.PHP_EOL;
            $response .= '<div class="hidden-lg texto8">'.PHP_EOL;
            $response .= '<span class="sinkinSans300L ">Costo:</span>'.PHP_EOL;
            $response .= '<span class="sinkinSans600SB">'.$raffle->price.'</span>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '<div class="costo hidden-xs">'.PHP_EOL;
            $response .= '<div class="pull-left porcientoCompletado">'.PHP_EOL;
            $response .= '<span class="texto35 sinkinSans600SB colorN">'.round($raffle->getProgress()).' %</span><br>'.PHP_EOL;
            $response .= '<span class="sinkinSans400R">completado</span>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '<div class="pull-left padding-top-20 padding-left30">'.PHP_EOL;
            $response .= '<span class="sinkinSans300L texto10">Costo:</span><br>'.PHP_EOL;
            $response .= '<span class="colorN sinkinSans600SB">$'.$raffle->price.'</span>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '<ul class="list-unstyled list-inline padding-top-20 hidden-xs pull-right">'.PHP_EOL;
            $response .= '<li class=" margin-right-10">'.PHP_EOL;
            $response .= '<a href="'.route('raffles.follow',['raffleId' => $raffle->id]).'">'.PHP_EOL;
            $response .= '<span class="ti-face-smile texto-negrita colorV margin-right-5 texto16" title="Seguir"></span>'.PHP_EOL;
            $response .= '<span class="colorV sinkinSans600SB">Seguir</span>'.PHP_EOL;
            $response .= '</a>'.PHP_EOL;
            $response .= '</li>'.PHP_EOL;
            $response .= '<li class=" margin-right-10">'.PHP_EOL;
            $response .= '<a href="">'.PHP_EOL;
            $response .= '<span class="ti-share texto-negrita colorV margin-right-5 texto16" title="Compartir"></span>'.PHP_EOL;
            $response .= '<span class="colorV sinkinSans600SB">Compartir</span>'.PHP_EOL;
            $response .= '</a>'.PHP_EOL;
            $response .= '</li>'.PHP_EOL;
            $response .= '<li class="">'.PHP_EOL;
            $response .= '<button type="button" class="btn btn-info btnSiguiente"><span class="ti-arrow-right"></span></button>'.PHP_EOL;
            $response .= '</li>'.PHP_EOL;
            $response .= '</ul>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
        }
        $response .= $raffles->links();
        return $this->respond([
            'raffles' => $response
        ])->cookie('azeroth', encrypt($raffles->toArray()), 1);
    }

    public function filterByPrice(Request $request)
    {
        $raffles = null;
        $response = '';
        if ($request->get('category') == 'Todos')
            $raffles = Raffle::where('progress','<',100)->orderBy('price','DESC')->paginate(10);
        else
            $raffles = $this->raffleRepository->getRaflesByCategory($request->get('category'));
        foreach ($raffles as $raffle) {
            $response .= '<div class="row padding20 bg-rifas1 center-block '.$raffle->id.'">'.PHP_EOL;
            $response .= '<div class="col-xs-4 col-md-6" style="padding-left: 23px;padding-right: 0">'.PHP_EOL;
            $response .= '<div class="hidden-lg visible-xs padding-top-20 padding-left-0">'.PHP_EOL;
            $response .= '<img src="';
            if(count($raffle->getMedia('raffles')) > 0)
                $response .=$raffle->getMedia('raffles')->first()->getUrl();
            $response .='" class="dimenImgCarouselR" alt="">'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '<div id="myCarousel'.$raffle->id.'" class="carousel carouselRifas slide hidden-xs " data-ride="carousel">'.PHP_EOL;
            $response .= '<div class="carousel-inner" role="listbox">'.PHP_EOL;
            $count = 0;
            foreach ($raffle->getMedia('raffles') as $media) {
                $response .= '<div class="item';
                if($count == 0)
                    $response .= ' active';
                $response .='">'.PHP_EOL;
                $response .= '<img src="'.$media->getUrl().'" class="dimenImgCarouselR" alt="First slide"></div>'.PHP_EOL;
                $count ++;
            }
            $response .= '</div>'.PHP_EOL;
            $count = 0;
            $response .= '<ol class="carousel-indicators">'.PHP_EOL;
            while($count < count($raffle->getMedia('raffles'))) {
                $response .= '<li data-target="#myCarousel'.$raffle->id.'" data-slide-to="'.$count.'" class="';
                if($count == 0)
                    $response .= 'active';
                $response .= '"></li>'.PHP_EOL;
                $count++;
            }
            $response .= '</ol>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '<div class="col-xs-8 col-md-6 padding-top10R" style="padding-left: 5px">'.PHP_EOL;
            $response .= '<span class="texto16 colorV hidden-lg visible-xs pull-left margin-right-10 sinkinSans600SB">'.round($raffle->progress).' %</span>'.PHP_EOL;
            $response .= '<span class="texto14 colorN pull-left sinkinSans600SB texto14">'.$raffle->getOwner->name.'</span>'.PHP_EOL;
            $response .= '<span class="ti-location-pin texto16 colorN"></span>'.PHP_EOL;
            $response .= '<span class="texto14 sinkinSans600SB texto14 colorN"><img class="flag-country" src="'.asset('pics/countries/png100px/'.$raffle->getLocation->code.'.png').'"></span>'.PHP_EOL;
            $response .= '<h4 class=" text-uppercase sinkinSans400R textoR">'.PHP_EOL;
            $response .= '<a class="colorN" href="'.route('raffle.tickets.available',['raffleId' => $raffle->id]).'">'.$raffle->title.'</a>'.PHP_EOL;
            $response .= '</h4>'.PHP_EOL;
            $response .= '<div class="hidden-lg texto8">'.PHP_EOL;
            $response .= '<span class="sinkinSans300L ">Costo:</span>'.PHP_EOL;
            $response .= '<span class="sinkinSans600SB">'.$raffle->price.'</span>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '<div class="costo hidden-xs">'.PHP_EOL;
            $response .= '<div class="pull-left porcientoCompletado">'.PHP_EOL;
            $response .= '<span class="texto35 sinkinSans600SB colorN">'.round($raffle->getProgress()).' %</span><br>'.PHP_EOL;
            $response .= '<span class="sinkinSans400R">completado</span>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '<div class="pull-left padding-top-20 padding-left30">'.PHP_EOL;
            $response .= '<span class="sinkinSans300L texto10">Costo:</span><br>'.PHP_EOL;
            $response .= '<span class="colorN sinkinSans600SB">$'.$raffle->price.'</span>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '<ul class="list-unstyled list-inline padding-top-20 hidden-xs pull-right">'.PHP_EOL;
            $response .= '<li class=" margin-right-10">'.PHP_EOL;
            $response .= '<a href="'.route('raffles.follow',['raffleId' => $raffle->id]).'">'.PHP_EOL;
            $response .= '<span class="ti-face-smile texto-negrita colorV margin-right-5 texto16" title="Seguir"></span>'.PHP_EOL;
            $response .= '<span class="colorV sinkinSans600SB">Seguir</span>'.PHP_EOL;
            $response .= '</a>'.PHP_EOL;
            $response .= '</li>'.PHP_EOL;
            $response .= '<li class=" margin-right-10">'.PHP_EOL;
            $response .= '<a href="">'.PHP_EOL;
            $response .= '<span class="ti-share texto-negrita colorV margin-right-5 texto16" title="Compartir"></span>'.PHP_EOL;
            $response .= '<span class="colorV sinkinSans600SB">Compartir</span>'.PHP_EOL;
            $response .= '</a>'.PHP_EOL;
            $response .= '</li>'.PHP_EOL;
            $response .= '<li class="">'.PHP_EOL;
            $response .= '<button type="button" class="btn btn-info btnSiguiente"><span class="ti-arrow-right"></span></button>'.PHP_EOL;
            $response .= '</li>'.PHP_EOL;
            $response .= '</ul>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
            $response .= '</div>'.PHP_EOL;
        }
        $response .= $raffles->links();
        return $this->respond([
            'raffles' => $response
        ])->cookie('azeroth', encrypt($raffles->toArray()), 1);
    }
}
