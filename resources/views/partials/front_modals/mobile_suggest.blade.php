<div class="visible-xs padding-top-70">
    <div class="text-center "><span class="text-uppercase colorV sinkinSans600SB">@lang('views.suggested')</span></div>
    <div id="owl-demo2" class="bg-blancoR" style="padding:0 25px">
        <?php $count = 0; ?>
        @foreach($suggested as $item)
            <a href="{{ route('raffle.tickets.available',['raffleId' => $item->id]) }}">
                <div class="item">
                    <div class="paddingImgCarousel">
                        <img src="@if (count($item->getMedia('raffles')) > 0){{ $item->getMedia('raffles')->first()->getUrl() }} @endif"
                             class="dimenImgCarouselR" alt="Owl Image"/>
                        <div class="porciento">
                            <div class=" text-center">
                         <span class="chartB chart-porcientoS" data-percent="{{ round($item->progress) }}">
                         <span class="percentS">{{ round($item->progress) }}%</span>
                     </span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <?php $count++; ?>
        @endforeach
    </div>
</div>

<div class="visible-xs">
    <div class="promo-block" id="promo-block">
        <div class="tp-banner-container">
            <div class="tp-banner">
                <ul>
                    @foreach($mainPromos as $promo)
                        <li data-transition="fade" data-slotamount="5" data-masterspeed="700" data-delay="9400"
                            class="slider-item-1">
                            <img src="{{ $promo->getMedia('promos')->first()->getUrl() }}" alt="" data-bgfit="cover"
                                 style="opacity:0.4 !important;"
                                 data-bgposition="center center" data-bgrepeat="no-repeat">
                            <div class="tp-caption large_text customin customout start"
                                 data-x="center"
                                 data-hoffset="0"
                                 data-y="center"
                                 data-voffset="0"
                                 data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                                 data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                 data-speed="1000"
                                 data-start="500"
                                 data-easing="Back.easeInOut"
                                 data-endspeed="300">
                            </div>
                            <div class="tp-caption large_bold_white fade"
                                 data-x="center"
                                 data-y="center"
                                 data-voffset="0"
                                 data-speed="300"
                                 data-start="1700"
                                 data-easing="Power4.easeOut"
                                 data-endspeed="500"
                                 data-endeasing="Power1.easeIn"
                                 data-captionhidden="off"
                                 style="z-index: 6">
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
