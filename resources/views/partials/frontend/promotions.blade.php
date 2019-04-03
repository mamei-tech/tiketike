
<div class="col-lg-2 padding-top-50 visible-lg columnaLDerecha">
    <div class="sugerencias">
        <h6 class="text-uppercase sinkinSans600SB borderBottomV padding-bottom5">Sugerencias</h6>
        <?php $count = 0; ?>
        @foreach($suggested as $item)
        <div class="row @if($count > 0) padding-top-20 @endif">
            <div class="col-md-8">
                <img src="@if (count($item->getMedia('raffles')) > 0){{ $item->getMedia('raffles')->first()->getUrl() }} @endif" class="imgRifas" alt="">
            </div>
            <div class="col-md-4">
                <div class="publicityPercent">
                    <span class="chart chart-porciento" data-percent="{{ round($item->getProgress()) }}">
                        <span class="percent sinkinSans600SB">{{ round($item->getProgress()) }}%</span>
                    </span>
                </div>
                <a href="{{ route('raffle.tickets.available',['raffleId' => $item->id]) }}" type="button" class="btn btn-info btnSiguiente"><span class="ti-arrow-right"></span>
                </a>
            </div>
        </div>
            <?php $count++; ?>
        @endforeach
    </div>
    <div class="publicidad padding-top-20">
        <h6 class="text-uppercase sinkinSans600SB borderBottomV padding-bottom5">publicidad</h6>
        @foreach($promos as $promo)
        <div class="col-md-12 padding-left-0 padding-rigth-0 padding-bottom20">
            <a href="{{ $promo->website }}"><img src="@if(count($promo->getMedia('promos')) > 0){{ $promo->getMedia('promos')->first()->getUrl() }} @endif" class="img-responsive imgPublicidad" alt=""></a>
        </div>
        @endforeach
    </div>

</div>
