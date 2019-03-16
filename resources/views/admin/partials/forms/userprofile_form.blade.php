<form id="ftm_profileUpdate" class="form-horizontal" method="post" action="{{ route('users.update', Auth::id()) }}"
      accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input name="_method" type="hidden" value="PUT">
    <?php $count = 1; ?>
    <input type="hidden" name="roles[]" id="roles[]" value="@foreach($user->roles as $role) {{ $role->name }} @if($count < count($user->roles)),@endif <?php $count++; ?> @endforeach">

    {{-- EMAIL ¦ USERNAME ¦ AVATAR --}}
    <div class="row">
        <div class="col-md-3">
            <div class="form-group basic">
                <label>@lang('aUserprofile.username')</label>
                <input type="text" name="username" class="form-control" disabled placeholder="Username"
                       value="{{ $user->getProfile->username }}">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group basic">
                <label for="exampleInputEmail1">Email</label>
                <input name="email" type="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group basic">
                <label for="Avatar">Avatar</label>
                <br>
                <span class="btn btn-simple btn-round">
                    <input id="avatar" type="file" class="form-control" name="avatar">
                    <i class="now-ui-icons users_circle-08"></i>
                    Avatar
                </span>
            </div>
        </div>
    </div>

    {{-- PASSWORD ¦ PASSWORD CONFIRMATION --}}
    <div class="row">
        <div class="col-md-12">
            <li style="list-style: none;">

                <a class="" data-toggle="collapse" href="#changepasscont" aria-expanded="false">
                    <p> @lang('aUserprofile.chngpass')
                        <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse" id="changepasscont">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group basic">
                                <label for="password">@lang('aUserprofile.newpass')</label>
                                <input id="password" name="password" type="password" class="form-control" placeholder="" value="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group basic">
                                <label for="pwrdconfrm">@lang('aUserprofile.confrmpass')</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="" value="">
                            </div>
                        </div>

                    </div>
                </div>

            </li>
        </div>
    </div>

    {{-- BIRTHDATE ¦ GENDER ¦ LANG --}}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group basic">
                <label>@lang('aUserprofile.brdate')</label>
                <input name="birthdate" type="text" placeholder="" class="form-control datepicker"
                       value="{{ date('d-m-Y', strtotime($user->getProfile->birthdate)) }}">
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="form-group basic">
                <label>@lang('aUserprofile.gender')</label>
                <div class="btn-group bootstrap-select">
                    <select name="gender" class="selectpicker" data-style="btn btn-neutral btn-round"
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

        <div class="col-md-4">
            <div class="form-group basic">
                <label>@lang('aUserprofile.interlang')</label>
                <div class="btn-group bootstrap-select">
                    <select name="languaje" class="selectpicker" data-style="btn btn-neutral btn-round"
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
    </div>

    {{-- FIRST NAME ¦ LASTNAME --}}
    <div class="row">
        <div class="col-md-4 pr-1">
            <div class="form-group basic">
                <label>@lang('aUserprofile.firstname')</label>
                <input name="firstname" type="text" class="form-control" placeholder="Company" value="{{$user->name}}">
            </div>
        </div>
        <div class="col-md-8 ">
            <div class="form-group basic">
                <label>@lang('aUserprofile.lastname')</label>
                <input name="lastname" type="text" class="form-control" placeholder="Last Name"
                       value="{{$user->lastname}}">
            </div>
        </div>
    </div>

    {{-- ADDRESS --}}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group basic">
                <label>@lang('aUserprofile.address')</label>
                <input name="address" type="text" class="form-control" placeholder="Home Address"
                       value="{{ $user->getProfile->addrss }}">
            </div>
        </div>
    </div>

    {{-- CITY ¦ COUNTRY ¦ POSTAL CODE --}}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group basic">
                <label>@lang('aDashboard.country')</label>
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
        <div class="col-md-4">
            <div class="form-group basic">
                <label>@lang('aDashboard.city')</label>
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
        <div class="col-md-4">
            <div class="form-group basic">
                <label>@lang('aUserprofile.zipcode')</label>
                <input name="zipcode" type="number" class="form-control" placeholder="10100"
                       value="{{ $user->getProfile->zipcode }}">
            </div>
        </div>
    </div>

    {{-- BIO --}}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group basic">
                <label>Bio</label>
                <input name="bio" type="text" class="form-control" placeholder="Bio" value="{{ $user->getProfile->bio }} ">
            </div>
        </div>
    </div>

    <br>

    {{-- BUTTONS --}}
    <div class="row">
        <div class="col-md-9">
            <div class="form-group basic">
                <button id="btn-submit" class="btn btn-success btn-round" type="submit" value="add">
                    <i class="now-ui-icons ui-1_simple-add"></i>
                    @lang('buttons.update')
                </button>
            </div>
        </div>
    </div>

</form>