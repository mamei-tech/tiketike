<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLang" data-toggle="dropdown" aria-haspopup="true"
   aria-expanded="false">

    {{--<i class="now-ui-icons location_world"></i>--}}
    <img src="{{ asset('pics/common/'. \App\Facades\Loc::current() . '.png') }}">
    <p>
        <span class="d-lg-none d-md-block">@lang('aNavbar.lengSW')</span>
    </p>
</a>

<div class="dropdown-menu dropdown-menu-right" id="langOptns" aria-labelledby="navbarDropdownLang">
    <button class="dropdown-item {{ \App\Facades\Loc::current() == 'es' ? 'disabled' : '' }}" id="langOpt_spa">
        <span>
            <img src="{{ asset('pics/common/es.png') }}">
        </span>
        &ensp;&ensp;@lang('languajes.spa')
    </button>
    <button class="dropdown-item {{ \App\Facades\Loc::current() == 'en' ? 'disabled' : '' }}" id="langOpt_eng">
        <span>
            <img src="{{ asset('pics/common/en.png') }}">
        </span>
        &ensp;&ensp;@lang('languajes.eng')
    </button>
</div>

{{-- Languaje Swithcer Tweek Form --}}
@include('admin.partials.forms.langswitcher')
