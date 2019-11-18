@extends('layouts.base')
@section('additional_styles')
    <link href="{{ asset('css/front/dropzone.min.css') }}" rel="stylesheet" />
@stop
@section('title',trans('views.raffles'))
@section('content')
    @include('partials.frontend.header')
    @include('partials.front_modals.filters')
    @include('partials.front_modals.login_modal')
    @include('partials.front_modals.mobile_suggest')
    @include('partials.front_modals.notification_modal')
    @include('partials.front_modals.create_raffle_modal')
    <div class="container contenido" style="width: 100%">
        <div class="row">

            <div class="col-sm-4 col-lg-3 hidden-xs padding-rigth-0">
                <div class="categoria">
                    <div class="listadoCategoriaN">
                        <h4 class="text-uppercase sinkinSans600SB colorV">@lang('views.categories')</h4>
                        <ul class="nav list-unstyled sinkinSans400R">
                            <li class="active"><a href="#" class="colorN text-uppercase" id="all">@lang('views.all')</a>
                            </li>
                            @foreach($categories as $category)
                                <li><a href="#" id="{{ $category->category }}"
                                       class="colorN text-uppercase filters"><span class="{{ $category->icon }}"></span> {{$category->category}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="filtrarpor">
                    <h4 class="text-uppercase sinkinSans600SB colorV">@lang('views.filter_by')</h4>
                    <div class="bg_V text-uppercase">
                        <label class="colorB styleEncabezado sinkinSans300L">@lang('views.countries')</label>
                    </div>
                    <div class="paddingFiltrar">
                        @foreach($continents as $continent)
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <button class="btn btn-default text-left" style="width: 100%"
                                                    data-toggle="collapse"
                                                    data-target="#collapse{{ $continent->id }}">{{ $continent->name }}
                                                <i class="fa fa-angle-down right"></i></button>
                                        </h4>
                                    </div>
                                    <div id="collapse{{ $continent->id }}" class="panel-collapse collapse">
                                        @foreach($continent->countries as $country)
                                            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-{{strlen($country->name) > 20?'12':'6'}}"
                                                 style="padding: 5px 5px 5px 0">
                                                <label for="countries">{{ $country->name }}</label>
                                                <input class="right" type="checkbox" name="countries" id="countries"
                                                       value="{{ $country->id }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        @endforeach
                    </div>
                    <div class="bg_V text-uppercase">
                        <label class="colorB styleEncabezado sinkinSans300L">@lang('views.price')</label>
                    </div>
                    <div class="paddingFiltrar sinkinSans300L">
                        <div class="subtPais checkbox padding-top-15">
                            <label>
                                <input class="letra-naranja" type="checkbox">
                                @lang('views.from') 0 @lang('views.to') 19 usd
                            </label>
                        </div>
                        <div class="subtPais checkbox padding-top-15">
                            <label>
                                <input class="letra-naranja" type="checkbox">
                                @lang('views.from') 20 @lang('views.to') 39 usd
                            </label>
                        </div>
                        <div class="subtPais checkbox padding-top-15">
                            <label>
                                <input class="letra-naranja" type="checkbox">
                                @lang('views.from') 40 @lang('views.more_than')
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-8 col-lg-7 paddingRifas">
                <div class="col-lg-12">
                    <div class="row padding-bottom20 ">
                        <div class="col-lg-6 sinkinSans600SB">
                        <a href="@if(Auth::check())#createRaffleModal @else #loginModal @endif" data-toggle="modal"
                           class=" texto14 ">
                            <span class=" colorV sinkinSans600SB">@lang('views.create_raffle')</span>
                            <span aria-hidden="true" class="ti-angle-right colorV "></span>
                        </a>

                        </div>

                        <div class="col-lg-6  floatRight padding-left150 sinkinSans600SB hidden-xs">

                            <span class=" text-uppercase pull-left margin-right-15">@lang('views.order_by'):</span>
                            <button id="percent" type="button" class="btn btn-info padding0 pull-left margin-right-15">
                                <span>%</span>
                            </button>
                            <button id="pricefilter" type="button" class="btn btn-info padding0 pull-left"><span
                                        class="ti-money"></span>
                            </button>
                        </div>
                    </div>
                    <div class="row rafflescontent" style="overflow-y: scroll; overflow-x: hidden;max-height: 800px">
                        @if (count($raffles) > 0)
                            @foreach($raffles as $raffle)
                                <div class="row padding20 bg-rifas1 center-block {{$raffle->id}}">
                                    <div class="col-xs-4 col-md-6 raffle_carousel text-right" style="padding-left: 0;padding-right: 0">
                                        <div class="hidden-lg visible-xs padding-top-10 padding-left-0 padding-top-percentual">
                                            <a href="{{ route('raffle.tickets.available',['raffleId' => $raffle->id]) }}"><img src="@if(count($raffle->getMedia('raffles')) > 0){{ $raffle->getMedia('raffles')->first()->getUrl('thumb') }} @endif"
                                                 class="dimenImgCarouselR" alt=""></a>
                                        </div>
                                        <div id="myCarousel{{ $raffle->id }}"
                                             class="carousel carouselRifas slide hidden-xs " data-ride="carousel">

                                            <div class="carousel-inner" role="listbox">
                                                <?php $count = 0;?>
                                                @foreach($raffle->getMedia('raffles') as $media)
                                                    <div class="item @if($count == 0) active @endif">
                                                        <a href="{{ route('raffle.tickets.available',['raffleId' => $raffle->id]) }}"><img src="{{ $media->getUrl('thumb') }}" class="dimenImgCarouselR"
                                                                         alt="First slide"></a>
                                                    </div>
                                                    <?php $count++; ?>
                                                @endforeach
                                            </div>
                                            <?php $count = 0; ?>
                                            <ol class="carousel-indicators">
                                                @while($count < count($raffle->getMedia('raffles')))
                                                    <li data-target="#myCarousel{{ $raffle->id }}"
                                                        data-slide-to="{{ $count }}"
                                                        class="@if($count == 0) active @endif"></li>
                                                    <?php $count++; ?>
                                                @endwhile
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="col-xs-8 col-md-6 padding-top10R padding-top-percentual-desc padding-left20">
                                        <span class="texto16 colorV hidden-lg visible-xs pull-left margin-right-10 sinkinSans600SB">{{ round($raffle->progress) }}%</span>
                                        <span class="texto14 colorN pull-left sinkinSans600SB texto14">{{ $raffle->getOwner->name }}</span>
                                        <span class="ti-location-pin texto16 colorN"></span>
                                        <span class="texto14 sinkinSans600SB texto14 colorN"><img class="flag-country"
                                                                                                  src="{{ asset('pics/countries/png100px/'.$raffle->getLocation->code.'.png') }}"></span>
                                        <h4 class=" text-uppercase sinkinSans400R textoR">
                                            <a class="colorN"
                                               href="{{ route('raffle.tickets.available',['raffleId' => $raffle->id]) }}">{{ str_limit($raffle->title,13,'') }}</a>
                                        </h4>

                                        <div class="hidden-lg texto8"><span
                                                    class="texto16 colorN hidden-lg visible-xs pull-left margin-right-10 sinkinSans600SB ">@lang('views.cost'):</span><span
                                                    class="texto16 colorV hidden-lg visible-xs pull-left margin-right-10 sinkinSans600SB">{{ $raffle->tickets_price ? $raffle->tickets_price : 0  }}</span>
                                        </div>

                                        <div class="costo hidden-xs">
                                            <div class="pull-left porcientoCompletado"><span
                                                        class="texto35 sinkinSans600SB colorN">{{ round($raffle->progress) }}%</span><br>
                                                <span class="sinkinSans400R">@lang('views.completed')</span></div>
                                            <div class="pull-left padding-top-20 padding-left30">
                                                <span class="sinkinSans300L texto10">@lang('views.cost'):</span><br><span
                                                        class="colorN sinkinSans600SB">${{ $raffle->tickets_price ? $raffle->tickets_price : 0 }}</span>
                                            </div>
                                        </div>
                                        <div class="row links" style="margin-top: 25px;">
                                            <ul class="list-unstyled list-inline padding-top-20 hidden-xs pull-right" style="padding-right: 40px;">
                                                <li class="margin-right-10">
                                                    <a class="icon badge-container"
                                                       href="{{ route('raffles.follow',['raffleId' => $raffle->id]) }}">
                                                    <span class="ti-face-smile texto-negrita colorV margin-right-5 texto16"
                                                          title="Seguir"></span>
                                                        @php($rFallowers = count($raffle->getFollowers))
                                                        @if($rFallowers > 0)
                                                            <span class="badge">{{ $rFallowers }}</span>
                                                        @endif
                                                        <span class="colorV sinkinSans600SB">Seguir</span>
                                                    </a></li>
                                                <li class=" margin-right-10"><a data-toggle="modal"
                                                                                data-target="@if(\Auth::check())#{{$raffle->id}}-share_modal @else #loginModal @endif"
                                                                                href="" title="Compartir">
                                                        <span class="ti-share texto-negrita colorV margin-right-5 texto16"></span><span
                                                                class="colorV sinkinSans600SB"
                                                                id="share_buttom">Compartir</span>
                                                    </a>
                                                </li>
                                                @include('partials.front_modals.share_modal')
                                                <li class="">
                                                    <a  href="{{ route('raffle.tickets.available',['raffleId' => $raffle->id]) }}" class="btn btn-info btnSiguiente"><span
                                                                class="ti-arrow-right"></span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-md-12 text-center">
                        {{----}}
                        {{ $raffles->links() }}
                    </div>
                </div>
            </div>

            @include('partials.frontend.promotions',['suggested' => $suggested])
        </div>
    </div>
@stop

@section('footerScripts')
    @parent
    <script src="{{ asset('js/front/dropzone.js') }}"></script>
    <script src="{{ asset('js/raffles.min.js') }}" defer></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
    <script>
        var uploadedDocumentMap = {};
        Dropzone.options.documentDropzone = {
            url: '{{ route('upload.images') }}',
            maxFilesize: 5, // MB
            maxFiles: 3,
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            uploadMultiple: true,
            parallelUploads: 1,
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
@endsection
