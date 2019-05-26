
<section class="rifasporculminar padding-top-60 padding-bottom20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="borderBotDis dimenBorderBotDisc">
                    <h3 class="text-uppercase sinkinSans600SB texto24 text-center colorVC">@lang('views.almost_finished_raffle')</h3>
                </div>
            </div>
            <div class="col-md-12">
                <div class="slicklanding dimenBorderBotDisc">
                    @foreach($raffles as $raffle)
                        <div class="paddingImgCarousel itemImg margin-left5">
                            <div>
                                <img src="{{ $raffle->getMedia('raffles')->first()->getUrl() }}"
                                     class="dimenImgCarousel"
                                     alt="Owl Image"/>
                            </div>
                            <a class="valign-center"
                               href="{{ route('raffle.tickets.available',['raffleId' => $raffle->id]) }}">
                                <div class="imginline"
                                     style="position: absolute">
                                    <strong class="sinkinSans600SB text-center"><span
                                                class="tile-percent-text">{{ round($raffle->progress) }}
                                            %</span><br>{{ $raffle->title }}
                                        <h5 class="text-center">
                                            <img class="align-content-center flag-country"
                                                 src="{{ asset('pics/countries/png100px/'.$raffle->getLocation->code.'.png') }}"/>
                                            <span class="tile-owner-name">{{ $raffle->getOwner->name }}</span>
                                        </h5>
                                    </strong>
                                </div>
                            </a>
                            <div class="porciento">
                                <div class=" text-center">
                                <span class="chartB chart-porcientoB" data-percent="{{ round($raffle->progress) }}" style="color: #0e76a8">
                                    <span class="percentB" style="color: #61316e !important;">{{ round($raffle->progress) }}%</span>
                                </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

