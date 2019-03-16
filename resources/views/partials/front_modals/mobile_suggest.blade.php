<!--INICIO Sugerencias y publicidad en la vista movil-->
<div class="visible-xs padding-top-70">
    <div class="text-center "><span class="text-uppercase colorV sinkinSans600SB">sugerencias</span></div>
    <div id="owl-demo2" class="bg-blancoR" style="padding:0 25px">
        <?php $count = 0; ?>
        @foreach($suggested as $item)
            <div class="item">
                <div class="paddingImgCarousel">
                    <img src="@if (count($item->getMedia('raffles')) > 0){{ $item->getMedia('raffles')->first()->getUrl() }} @endif" class="dimenImgCarouselR" alt="Owl Image"/>
                    <div class="porciento">
                        <div class=" text-center">
                         <span class="chartB chart-porcientoS" data-percent="{{ round($item->progress) }}">
                         <span class="percentS">{{ round($item->progress) }}%</span>
                     </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php $count++; ?>
        @endforeach
    </div>
</div>
<div class="visible-xs">
    <img src="{{ asset('pics/front/slide1.jpg') }}" class="margin-top-70" alt="">
    <div class="borderPublicidad"></div>
    <div class="text-center "><span class="text-uppercase colorV sinkinSans600SB">Rifas</span></div>
    <!--FIN Sugerencias y publicidad en text-center la vista movil-->
</div>