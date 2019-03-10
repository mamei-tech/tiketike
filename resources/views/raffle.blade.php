@extends('layouts.base')
@section('content')
    @include('partials.frontend.header')
    @include('partials.front_modals.filters')
    @include('partials.front_modals.mobile_suggest')
    @include('partials.front_modals.login_modal')
    <div class="container margin-top60">
        <div class="row">
            <!--Contenido ticket-->
            <div class="col-xs-12 col-sm-7 col-sm-push-5 col-lg-7 col-lg-push-3 padding-top-20 paddingLeft0 padding-rigth-0">
                <div class="contenidoTicket" id="scrollContent">
                    <div class="col-xs-12 ">
                        <div class="col-xs-4 col-md-3">
                            <img src="{{ $raffle->getOwner->getMedia('avatars')->first()->getUrl() }}" alt="Ringo"
                                 class="imgUsuario sombraImgUser2">
                        </div>
                        <div class="col-xs-8 col-md-9 texto14 sinkinSans600SB padding0">
                            <span class="colorN">{{ $raffle->getOwner->name }} {{ $raffle->getOwner->lastname }}</span>
                            <span class="ti-location-pin"></span>
                            <span class=""><img src="{{ asset('pics/countries/'.$raffle->getLocation->name.'.png') }}">{{ $raffle->getLocation->name }}</span>
                            <p class="texto18 text-uppercase texto-negrita colorN padding-top-10"
                               style="font-family: sinkinSans700Bold">{{ $raffle->title }}</p>
                        </div>
                    </div>
                    <div class="col-xs-12 padding-top-20">
                        <div id="myCarousel" class="carousel carouselTicket slide" data-ride="carousel">
                            <!-- Indicators -->
                            <div class="carousel-inner" role="listbox">
                                <?php $count = 0; ?>
                                @foreach($raffle->getMedia('raffles') as $media)
                                    <div class="item @if($count == 0) active @endif">
                                        <img src="{{ $media->getUrl() }}" class="dimenImgCarouselTicket"
                                             alt="First slide">
                                    </div>
                                    <?php $count++; ?>
                                @endforeach
                            </div>
                            <?php $count = 0;?>
                            <ol class="carousel-indicators carousel-indicatorsTicket">
                                @while($count < count($raffle->getmedia('raffles')))
                                    <li data-target="#myCarousel" data-slide-to="{{ $count }}"
                                        class="@if($count == 0) active @endif"></li>
                                    <?php $count++; ?>
                                @endwhile
                            </ol>
                        </div>
                    </div>
                    <div class="col-xs-12 paddingR-5">
                        <span class="italic margin-right5">Articulos:</span>
                        <strong class="colorN">1</strong>
                        <p class="colorN">{{ $raffle->description }}</p>
                    </div>
                    <div class="col-xs-12">
                        <div class="pull-left padding-top-20 links">
                            <!-- Button trigger modal Mis compras de Ticket-->
                            <a class="icon" data-toggle="modal" href="#misCompras" title="Mis Tickets">
                                <span class="ti-ticket colorV dimenIconos"></span>
                                <span class="badge badge-default">@if(Auth::user() != null){{ count(Auth::user()->getTicketsByRaffle($raffle->id)) }} @else
                                        0 @endif</span>
                            </a>
                            <!-- Modal -->
                            <div class="modal fullscreen-modal fade" id="misCompras" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header padding-top-30">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                &times;
                                            </button>
                                            <h6 class="modal-title textoCenter text-uppercase sinkinSans600SB colorN">
                                                Mis
                                                Tickets
                                                comprados</h6>
                                        </div>
                                        <div class="modal-body">
                                            <div class="listadoTickets padding-left50">
                                                <ul class="nav sinkinSans400R">
                                                    @if(Auth::user() != null)
                                                        @foreach(Auth::user()->getTicketsByRaffle($raffle->id) as $ticket)
                                                            <li class="padding-top-15 margin-top5 bg-prueba">
                                                    <span
                                                            class="padding-top-20 padding-left20 text-uppercase colorB margin-right-10">{{ $ticket->code }}</span>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </div>
                        <ul class="list-unstyled pull-right list-inline padding-top-20 ">
                            <li class="margin-right-10">
                                <a href="" title="Comentarios" id="comenta">
                                    <span class="ti-comment colorV margin-right-5 dimenIconos"></span>
                                </a>
                            </li>
                            <li class="margin-right-10">
                                <a href="" title="Seguir">
                                    <span class="ti-face-smile colorV margin-right-5 dimenIconos"></span>
                                </a>
                            </li>
                            <li class="margin-right-10">
                                <a href="" title="Compartir">
                                    <span class="ti-share colorV margin-right-5 dimenIconos"></span>
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div id="comentarios" style=" display:none" class="col-xs-12">
                        <strong class="colorN text-uppercase sinkinSans600SB">comentarios</strong>
                        <div class="comments">
                            @foreach($raffle->getComments as $comment)
                                @if($comment->parent == null)
                                    <div class="media">
                                        <a href="#" class="pull-left  margin-right-20">
                                            <img src="{{ $comment->getUser->getMedia('avatars')->first()->getUrl() }}" alt="Ringo"
                                                 class="imgUsuario sombraImgUser2">
                                        </a>
                                        <div class="media-body">
                                            <div class="margin-bottom-20 sinkinSans400R texto10 ">
                                    <span class="media-heading"><span
                                                class="colorN">{{ $comment->getUser->name }} {{ $comment->getUser->lastname }}</span>

                                          @if(\Auth::User()->id == 1)
                                            <a data-toggle="modal" data-target="#comment-{{$comment->id}}" href="#" class="">
                                                    <span class="ti-alert"></span>
                                            </a>
                                            @include('partials.front_modals.bad_comment_modal',['commentario'=>$comment])
                                          @endif


                                        <a data-toggle="collapse" data-target="#reply-{{$comment->id}}"
                                           aria-expanded="false" aria-controls="reply-{{$comment->id}}"
                                           id="answer_comment" href="#"
                                           class="colorV texto8 sinkinSans400I pull-right margin-right-15">responder...</a>
                                    </span>
                                                <p class="texto10 sinkinSans300L">
                                                    {{ $comment->text }}
                                                </p>
                                            </div>

                                        @include('partials.frontend.form_comments',['isSon' => false,'answer_text'=>$comment])


                                        @foreach($comment->getChilds as $child)
                                            <!-- Nested media object -->
                                                <div class="media">
                                                    <a href="#" class="pull-left margin-right-20">
                                                        <img src="{{ $child->getUser->getMedia('avatars')->first()->getUrl() }}" alt="Ringo"
                                                             class="imgUsuario2 sombraImgUser2">
                                                    </a>
                                                    <div class="media-body">
                                                        <div class="margin-bottom-20 sinkinSans400R texto10">
                                             <span class="media-heading"><span
                                                         class="colorN">{{ $child->getUser->name }} {{ $child->getUser->lastname }}</span>

                                                @if(\Auth::User()->id == 1)
                                                     <a data-toggle="modal" data-target="#comment-{{$child->id}}" href="#" class="">
                                                    <span class="ti-alert"></span>
                                                     </a>
                                                     @include('partials.front_modals.bad_comment_modal',['commentario'=>$child])
                                                 @endif

                                                 <a data-toggle="collapse" data-target="#reply-{{$child->id}}"
                                                    aria-expanded="false" aria-controls="reply-{{$child->id}}"
                                                    id="answer_comment" href="#"
                                                    class="colorV texto8 sinkinSans400I pull-right margin-right-15">responder...</a>
                                              </span>
                                                            <p class="texto10 sinkinSans300L">
                                                                {{ $child->text }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    @include('partials.frontend.form_comments',['isSon' => true,'answer_text'=>$child])
                                                </div>

                                                <!--end media-->
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="post-comment padding-top-30">
                            <strong class="colorN sinkinSans600SB text-uppercase">comenta</strong>
                            <form action="{{route('raffle.comment', $raffleId)}}" method="POST" role="form">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <textarea class="form-control bg-gris" rows="5" name="text" id="text"></textarea>
                                </div>
                                <button class="btn btn-primary bg_green extraer sinkinSans700B text-uppercase"
                                        type="submit">Enviar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--FIN Contenido ticket-->
            <div class="col-xs-12 visible-xs publicidad padding-top-20 padding-bottom20">
                <img src="{{ asset('pics/front/proyecto1.jpg') }}" class="imgPublicidadR" alt="">
            </div>
            <div class="col-xs-12 col-sm-5 col-sm-pull-7 col-lg-3 col-lg-pull-7 paddingLeft0 padding-rigth-0">
                <div class="bg-gris paddingLateralGris">
                    <div class="borderTopDashed padding-bottom20 ">
                        <div class="pull-left padding-top-10 margin-bottom-20">
                            <span class="text-uppercase dashedDerecho colorV sinkinSans700B">venta de tickets</span>
                        </div>
                        <div class="pull-left padding-left10 texto10 colorV padding-top-10">
                            <span class="sinkinSans200LI">Costo:</span>
                            <span class="sinkinSans700B colorV" id="raffleprice">{{ $raffle->tickets_price }}</span>
                        </div>
                    </div>
                    <div class="col-xs-12 borderBottomDashed"></div>
                    <div class="row padding-top-20 padding-left30">
                        <div class="centerM slickVertical sinkinSans400R text-uppercase  ">
                            @foreach($raffle->getTicketsAvailable as $ticket)
                                <div>
                                    <div class="padding-top-15  bg-prueba pull-left">
                                        <span class="padding-top-20 padding-left25 text-uppercase colorB margin-right-10">{{ $ticket->code }}</span>
                                    </div>
                                    <div class="padding-top-30">
                                        <input name="tickets" id="tickets" class="margin-left15 tickets"
                                               value="{{ $ticket->code }}" type="checkbox">
                                    </div>
                                </div>
                            @endforeach
                            <input type="hidden" id="raffle" value="{{ $raffle->id }}">
                        </div>
                    </div>
                    <div class="btn btn-info btnShufle center-block "><span class="ti-control-shuffle"></span>
                    </div>
                    <div class="borderTopDashed padding-bottom20">
                        <div class="pull-left">
                            <strong class="sinkinSans600SB colorV texto24 pull-left margin-right-10"
                                    id="countTickets">0</strong>
                            <div class="pull-left colorV texto8 sinkinSans300LI padding-top5">
                                <span>Tikects</span><br>
                                <span> Seleccionados</span>
                            </div>
                        </div>
                        <div class="pull-right colorV padding-top-10">
                            <a @if(Auth::user() == null)  data-toggle="modal" href="#loginModal" @else id="buyTickets"
                               @endif type="button"
                               class="btn btn-primary bg_green extraer sinkinSans700B text-uppercase">Comprar
                            </a>
                        </div>
                        <form method="post" action="{{ route('raffle.tickets.buy',['raffleId' => $raffle->id]) }}"
                              id="payform">
                            {{ csrf_field() }}
                            <input type="hidden" id="stripeToken" name="stripeToken"/>
                            <input type="hidden" id="stripeEmail" name="stripeEmail"/>
                            <input type="hidden" id="amountInCents" name="amountInCents"/>
                            <input type="hidden" id="ticketsarray" name="tickets[]">
                        </form>
                    </div>
                </div>
                <div class="bottomLIzquierdo"></div>
            </div>

            @include('partials.frontend.promotions')

        </div>
    </div>
@stop
@section('additional_scripts')
    <script src="{{ asset('js/raffle.min.js') }}"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var handler = StripeCheckout.configure({
                key: '{{ config('services.stripe.key') }}',
                image: '{{ asset('pics/front/logonv.png') }}',
                token: function (token) {
                    $("#stripeToken").val(token.id);
                    $("#stripeEmail").val(token.email);
                    $("#amountInCents").val({{$raffle->tickets_price}});
                    $("#payform").submit();
                }
            });

            $('#buyTickets').on('click', function (e) {
                var siChequeados = $('input:checkbox:checked').map(function () {
                    return this.value;
                }).get();
                $('#ticketsarray').val(siChequeados);
                var price = $('#raffleprice').html();
                var amountInCents = parseFloat(price).toFixed(2) * siChequeados.length * 100;
                var displayAmount = parseFloat(amountInCents / 100).toFixed(2);
                var handler = StripeCheckout.configure({
                    key: '{{ config('services.stripe.key') }}',
                    image: '{{ asset('pics/front/logonv.png') }}',
                    token: function (token) {
                        $("#stripeToken").val(token.id);
                        $("#stripeEmail").val(token.email);
                        $("#amountInCents").val(amountInCents);
                        $("#payform").submit();
                    }
                });
                $('input#amountInCents').val(amountInCents);

                // Open Checkout with further options
                handler.open({
                    name: 'TikeTikes tickets buy',
                    description: 'Tickets price ($' + displayAmount + ')',
                    amount: amountInCents,
                });
                e.preventDefault();
            });

// Close Checkout on page navigation
            $(window).on('popstate', function () {
                handler.close();
            });
        });
        $('#comenta').click(function (e) {
            e.preventDefault();
            $('#comentarios').fadeIn("300");
        });

        $('.slickVertical').slick({
            autoplay: true,
            vertical: true,
            verticalSwiping: true,
            slidesToShow: 2,
            slidesToScroll: 4,
            arrows: false,
            swipeToSlide: true,
            infinite: true,
            draggable: true,
            centerMode: true,
            centerPadding: '50%',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 3
                    }
                }
            ]
        });


    </script>
@stop
