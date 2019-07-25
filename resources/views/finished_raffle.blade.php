@extends('layouts.base')
@section('title',trans('views.raffles'))
@section('content')
    @include('partials.frontend.header')
    @include('partials.front_modals.mobile_suggest')
    @include('partials.front_modals.confirmation_modal')
    @include('partials.front_modals.notification_modal')
    @include('partials.front_modals.error_notification')
    <div class="container margin-top60">
        <div class="row">

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
                            <span class=""><img
                                        src="{{ asset('pics/countries/'.$raffle->getLocation->name.'.png') }}">{{ $raffle->getLocation->name }}</span>
                            <p class="texto18 text-uppercase texto-negrita colorN padding-top-10"
                               style="font-family: sinkinSans700Bold">{{ $raffle->title }} @if(\Auth::user()->id == $raffle->getOwner->id and $raffle->status < 2)
                                    <a href="#editRaffleModal" data-toggle="modal"><i class="fa fa-edit"></i> Editar
                                        rifa </a>@endif </p>
                            @if(\Auth::user()->id == $confirmation->owner_id or \Auth::user()->id == $confirmation->winner_id)
                                <a href="#confirmation_modal" data-toggle="modal" class="btn btn-success">Confirmar
                                    rifa</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12 padding-top-20">
                        <div id="myCarousel" class="carousel carouselTicket slide" data-ride="carousel">

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

                            <a class="icon" data-toggle="modal" href="#misCompras" title="Mis Tickets">
                                <span class="ti-ticket colorV dimenIconos"></span>
                                <span class="badge badge-default">@if(Auth::user() != null){{ count(Auth::user()->getTicketsByRaffle($raffle->id)) }} @else
                                        0 @endif</span>
                            </a>

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
                                    </div>
                                </div>
                            </div>
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
                                <a data-toggle="modal" data-target="#share_modal" href="" title="Compartir">
                                    <span class="ti-share colorV margin-right-5 dimenIconos"></span>
                                </a>
                            </li>
                            {{--@include('partials.front_modals.share_modal');--}}

                        </ul>
                    </div>
                    <div id="comentarios" style=" display:none" class="col-xs-12">
                        <strong class="colorN text-uppercase sinkinSans600SB">comentarios</strong>
                        <div class="comments">
                            @foreach($raffle->getComments as $comment)
                                @if($comment->parent == null)
                                    <div class="media">
                                        <a href="#" class="pull-left  margin-right-20">
                                            <img src="{{ $comment->getUser->getMedia('avatars')->first()->getUrl() }}"
                                                 alt="Ringo"
                                                 class="imgUsuario sombraImgUser2">
                                        </a>
                                        <div class="media-body">
                                            <div class="margin-bottom-20 sinkinSans400R texto10 ">
                                    <span class="media-heading"><span
                                                class="colorN">{{ $comment->getUser->name }} {{ $comment->getUser->lastname }}</span>

                                        @if(\Auth::User()->id == 1)
                                            <a data-toggle="modal" data-target="#comment-{{$comment->id}}" href="#"
                                               class="">
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

                                                <div class="media">
                                                    <a href="#" class="pull-left margin-right-20">
                                                        <img src="{{ $child->getUser->getMedia('avatars')->first()->getUrl() }}"
                                                             alt="Ringo"
                                                             class="imgUsuario2 sombraImgUser2">
                                                    </a>
                                                    <div class="media-body">
                                                        <div class="margin-bottom-20 sinkinSans400R texto10">
                                             <span class="media-heading"><span
                                                         class="colorN">{{ $child->getUser->name }} {{ $child->getUser->lastname }}</span>

                                                 @if(\Auth::User()->id == 1)
                                                     <a data-toggle="modal" data-target="#comment-{{$child->id}}"
                                                        href="#" class="">
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

            <div class="col-xs-12 visible-xs publicidad padding-top-20 padding-bottom20">
                <img src="{{ asset('pics/front/proyecto1.jpg') }}" class="imgPublicidadR" alt="">
            </div>
            <div class="col-xs-12 col-sm-5 col-sm-pull-7 col-lg-3 col-lg-pull-7 paddingLeft0 padding-rigth-0">
                <div class="bg-gris paddingLateralGris">
                    <div class="borderTopDashed padding-bottom20 ">
                        <div class="pull-left padding-top-10 margin-bottom-20">
                            <span class="text-uppercase colorV sinkinSans700B">ticket ganador</span>
                        </div>
                    </div>
                    <div class="col-xs-12 borderBottomDashed"></div>
                    <div class="row padding-top-20 padding-left30">
                        <div class="centerM slickVertical sinkinSans400R text-uppercase">
                            <div>
                                <div class="padding-top-15  bg-prueba pull-left">
                                    <span class="padding-top-20 padding-left25 text-uppercase colorB margin-right-10">{{ $ticket->code }}</span>
                                </div>
                            </div>
                        </div>
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
    <script type="text/javascript">
        $(document).ready(function () {
// Close Checkout on page navigation
            $(window).on('popstate', function () {
                handler.close();
            });
        });
        // $('#comenta').click(function (e) {
        //     e.preventDefault();
        //     $('#comentarios').fadeIn("300");
        // });

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
            centerPadding: '50% 4%',
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
