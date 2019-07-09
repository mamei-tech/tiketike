@extends('layouts.base')
@section('additional_styles')
    <link href="{{ asset('css/front/dropzone.min.css') }}" rel="stylesheet" />
@stop
@section('content')
    @include('partials.front_modals.notification_modal')
    @include('partials.front_modals.terminos_y_condiciones_modal')
    <section class="bienvenidos">
        <div class="container ">
            <div class="row">
                <div class="col-sm-7 col-md-4 col-lg-9">
                    <div class="logo padding-left65">
                        <img src="{{ asset('pics/front/logonv.png') }}" class="img-responsive" alt="Logo tikeTike">
                    </div>
                </div>
                <div class="col-sm-5 col-md-4 col-lg-3">
                    <ul class="list-inline padding-top-20 padding-left20">
                        <li class="margin-left-20 padding-left30">

                            @if(!Auth::check())
                                <a data-toggle="modal" href="#loginModal" title="Autenticarse"
                                   class="texto24 colorB padding10">
                                <span class="margin-right-15 sinkinSans300L">@lang('views.login')</span>
                                <i aria-hidden="true" class="ti-angle-right styleFlechaD"></i>
                            </a>
                                @include('partials.front_modals.login_modal')
                                @include('partials.front_modals.register_modal')
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row padding-left65">
                <div class="col-md-9 padding-top-20 center-textR">
                    <p class="colorB textoBienv ">Texto de bienvenida del sitio
                        y de orientación al usuario</p>
                    <span class="colorB texto24 sinkinSans300LI">Texto de bienvenida del sitio y de orientación al usuario</span>
                </div>
                <div class="col-md-3 padding-top-20 center-textR">
                    <a href="@if(Auth::check())#createRaffleModal @else #loginModal @endif" data-toggle="modal"
                       class="btn btn-primary btn-lg texto24 bg_green padding10">
                        <span class="margin-right-15 padding-left10 sinkinSans300L">@lang('views.create_raffle')</span>
                        <span aria-hidden="true" class="ti-angle-right styleFlechaD"></span>
                    </a>
                    @include('partials.front_modals.create_raffle_modal')
                    <div class="padding-top50 margin-left15">
                        <a href="{{ route('raffles.index') }}" class="texto24 colorB padding10">
                            <span class="margin-right-15 sinkinSans300L">@lang('views.take_part')</span>
                            <i aria-hidden="true" class="ti-angle-right styleFlechaD"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 margin-bottom-30 padding-top-10">
                <div class="flecha-bajar text-center">
                    <a data-scroll="" href="#menu"><img src="{{ asset('pics/front/flecha-bajar.png') }}"
                                                        class="dimenFlechaBajar"
                                                        alt=""></a>
                </div>
            </div>
        </div>
    </section>

    <div class="promo-block" id="promo-block">
        <div class="tp-banner-container">
            <div class="tp-banner">
                <ul>
                    @foreach($promos as $promo)
                        <li data-transition="fade" data-slotamount="5" data-masterspeed="700" data-delay="9400"
                            class="slider-item-1">
                            <img src="{{ $promo->getMedia('promos')->first()->getUrl() }}" alt="" data-bgfit="cover"
                                 style="opacity:0.4 !important;"
                                 data-bgposition="center center" data-bgrepeat="no-repeat">
                            <div class="tp-caption large_text customin customout start"
                                 data-x="center"
                                 data-hoffset="0"
                                 data-y="center"
                                 data-voffset="140"
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
                                 data-voffset="-10"
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

    <div id="menu" class="navbar-inverse bg_menu header ">
        <div class="container">
            @include('partials.frontend.content_menu')
        </div>
        <div class="morado-bottom"></div>
    </div>


    @include('partials.frontend.views.landing.almost_finished_raffles_section')

    @include('partials.frontend.views.landing.top_users_section')
@stop
@section('additional_scripts')
    <script src="{{ asset('js/front/dropzone.min.js') }}"></script>
    <script src="//js.pusher.com/3.1/pusher.min.js"></script>
    {{--<script src='https://www.google.com/recaptcha/api.js'></script>--}}
    <script src="{{ asset('js/main.min.js') }}"></script>
    <script type="text/javascript">
        var notifications_wrapper = $('#notifications_wrapper');
        var notifications = notifications_wrapper.find('ul#notifications-list');
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            forceTLS: true,
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });
        @if(\Auth::user() != null)
            var channel = pusher.subscribe('chanel-{{ \Auth::user()->id }}');
            channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function (data) {
                var existingNotifications = notifications.html();
                var newNotification = "<li><a href='" + data.url + "'>" + data.data + "</a></li>";
                notifications.html(newNotification + existingNotifications);
                var notif_count = $('span#notifications_count');
                var new_count = parseInt(notif_count.html()) + 1;
                notif_count.html(new_count);
            });
        @endif
    </script>
    <script>
        var uploadedDocumentMap = {};
        Dropzone.options.documentDropzone = {
            url: '{{ route('upload.images') }}',
            maxFilesize: 0.4, // MB
            maxFiles: 3,
            addRemoveLinks: true,
            acceptedFiles: ['image/*'],
            clickable: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (file, response) {
                $('form').append('<input type="hidden" name="files[]" value="' + response.name + '">');
                uploadedDocumentMap[file.name] = response.name;
            },
            removedfile: function (file) {
                file.previewElement.remove();
                var name = '';
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name;
                } else {
                    name = uploadedDocumentMap[file.name];
                }
                $('form').find('input[name="files[]"][value="' + name + '"]').remove();
            },
            init: function () {
            }
        }
    </script>
@stop
