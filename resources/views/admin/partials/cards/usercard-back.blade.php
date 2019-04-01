<div class="back">
    <div class="header-card">
        <h5 class="motto"><b>{{ $user->email }}</b></h5>

    </div>
    <div class="card-content">
        <div class="principale">
            <h4 class="text-center">@lang('aUserprofile.address')</h4>
            <p class="text-center">
                {{ $user->getProfile->addrss }}
            </p>

            <div class="stats-container">
                <div class="stats">
                    <h4>235</h4>
                    <p>
                        @lang('Raffles')
                    </p>
                </div>
                <div class="stats">
                    <h4>114</h4>
                    <p>
                        @lang('Tickets')
                    </p>
                </div>
                <div class="stats">
                    <h4>35</h4>
                    <p>
                        @lang('Comission')
                    </p>
                </div>
            </div>

        </div>
    </div>
    {{--<div class="bootom-rcard">--}}
        {{--<div class="social-links text-center">--}}
            {{--<button href="#" class="btn btn-neutral btn-icon btn-round">--}}
                {{--<i class="fab fa-facebook-square"></i>--}}
            {{--</button>--}}
            {{--<button href="#" class="btn btn-neutral btn-icon btn-round">--}}
                {{--<i class="fab fa-twitter"></i>--}}
            {{--</button>--}}
            {{--<button href="#" class="btn btn-neutral btn-icon btn-round">--}}
                {{--<i class="fab fa-google-plus-square"></i>--}}
            {{--</button>--}}
        {{--</div>--}}
    {{--</div>--}}
</div>