@extends('layouts.base')
@extends('layouts.base')
@section('content')
    @include('partials.frontend.header')
    @include('partials.front_modals.filters')
    @include('partials.front_modals.mobile_suggest')
    <div class=" container margin-top-70">
        <form class="col-md-12 margin-top60" action="register" method="POST">
            <div class="col-md-4">
                {{-- FIRST NAME ¦ LASTNAME --}}

                <div class="col-md-6 pr-1">
                    <div class="form-group basic">
                        <label>@lang('aUserprofile.firstname')</label>
                        <input name="firstname" type="text" class="form-control" placeholder="Name"
                               value="{{$user->name}}">
                    </div>
                </div>
                <div class="col-md-6 ">

                    <div class="form-group basic">
                        <label>@lang('aUserprofile.lastname')</label>
                        <input name="lastname" type="text" class="form-control" placeholder="Last Name"
                               value="{{$user->lastname}}">
                    </div>
                </div>

                <div class="col-md-8">
                    <label for="selector"
                           class="colorN italic padding-top-20">Email</label>
                    <input type="email" class="form-control form-control-new " id="inputEm"
                           name="email" value="{{ $user->email }}">
                </div>

                <div class="col-md-8">
                    <label for="selector"
                           class="colorN italic padding-top-20">Contraseña</label>
                    <input type="password" class="form-control form-control-new "
                           id="inputPassword" name="password">
                </div>

                <div class="col-md-8">
                    <label for="selector"
                           class="colorN italic padding-top-20">Repita la contraseña</label>
                    <input type="password" class="form-control form-control-new "
                           id="inputPassword" name="password">
                </div>

            </div>


            <div class="col-md-4" style="text-align: center">
                <label for="selector" class="colorN italic padding-top-20">Avatar</label>
                <br>

                @if($user->getProfile->avatarname == 'default')
                    <img id="profile-pic-card" class="img-circle"
                         src={{ asset('pics/common/default-avatar.png') }}>
                @else
                    <img id="profile-pic-card" class="img-circle"
                         src="{{ $user->getProfile->getMedia('avatars')->first()->getUrl() }}">
                @endif

                <input id="avatar" type="file" class="padding-top-20" name="avatar">


            </div>


            <div class="col-md-4">
                {{-- BIRTHDATE ¦ GENDER ¦ LANG --}}

                <div class="col-md-6 ">
                    <div class="form-group basic">
                        <label>@lang('aUserprofile.brdate')</label>
                        <input name="birthdate" type="date" placeholder="" class="form-control datepicker"
                               value="{{ date('d-m-Y', strtotime($user->getProfile->birthdate)) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group basic">
                        <label>Phone</label>
                        <input class="form-control "
                               id="inputPhone" name="phone">
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group basic">
                        <label>@lang('aUserprofile.gender')</label>
                        <br>
                        <div class="btn-group bootstrap-select">
                            <select name="gender" class="selectpicker"
                                    data-style="btn btn-neutral btn-round"
                                    title="Gender" tabindex="-98">
                                <option class="bs-title-option" value="">Gender</option>
                                <option value="Female" {{ $user->getProfile->gender == 'Female' ? 'selected' : '' }}>
                                    Female
                                </option>
                                <option value="Male" {{ $user->getProfile->gender == 'Male' ? 'selected' : '' }}>
                                    Male
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group basic">
                        <label>@lang('aUserprofile.interlang')</label>
                        <br>
                        <div class="btn-group bootstrap-select">
                            <select name="languaje" class="selectpicker"
                                    data-style="btn btn-neutral btn-round"
                                    title="Languaje" tabindex="-98">
                                <option class="bs-title-option" value="">Languaje</option>

                                @foreach (\App\Facades\Loc::supported() as $lang)
                                    <option value="{{ $lang }}" {{ $user->getProfile->langcode == $lang ? 'selected' : '' }}>
                                        {{ \App\Facades\Loc::nameFor($lang) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group basic">
                        <label>@lang('aDashboard.country')</label>
                        {{--TODO internazionalization for countries names--}}
                        <br>
                        <select name="country" class="selectpicker" data-style="btn btn-neutral btn-round"
                                title="Country" tabindex="-98">
                            <option class="bs-title-option" value="">Country</option>

                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ $country->name == $user->getProfile->getCity->getCountry->name ? 'selected' : '' }}>
                                    {{ $country->name }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group basic">
                        <label>@lang('aDashboard.city')</label>
                        <br>
                        <select name="city" class="selectpicker" data-style="btn btn-neutral btn-round"
                                title="City" tabindex="-98">
                            <option class="bs-title-option" value="">City</option>

                            @foreach($countrycities as $city)
                                <option value="{{ $city->id }}" {{ $city->name == $user->getProfile->getCity->name ? 'selected' : '' }}>
                                    {{ $city->name }}</option>
                            @endforeach

                        </select>

                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-group basic">
                        <label for="selector"
                               class="colorN italic padding-top-20">@lang('aUserprofile.zipcode')</label>
                        <input name="zipcode" type="number" class="form-control" placeholder="10100"
                               value="{{ $user->getProfile->zipcode }}">
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-8">
                    <div class="form-group basic">
                        <label for="selector"
                               class="colorN italic padding-top-40"> @lang('aUserprofile.address')</label>

                        <input name="address" type="text" class="form-control" placeholder="Home Address"
                               value="{{ $user->getProfile->addrss }}">
                    </div>
                </div>

                {{-- BIO --}}
                <div class="col-md-8">
                    <div class="form-group basic">
                        <label for="selector"
                               class="colorN italic padding-top-20">Bio</label>

                        <input name="bio" type="text" class="form-control" placeholder="Bio"
                               value="{{ $user->getProfile->bio }}">
                    </div>


                </div>
            </div>


            <div class="col-md-2 floatRight">
                <div class="row padding-top-20">
                    <div class="col-md-5">
                        <button type="submit" class="btn btn-sm btn-primary btn-block">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
@section('additional_scripts')

@stop