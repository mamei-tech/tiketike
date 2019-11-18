<div class="modal fade" id="notificaciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header form-signin padding-left-0 padding-bottom20">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="ti-angle-left"></span>
                </button>

            </div>

            <div class="modal-body">
                @if(Auth::user()!= null)
                    <div class="text-center">
                        <img src="{{ Auth::user()->getMedia('avatars')->first()->getUrl() }}" alt="Ringo"
                             class="imgUsuario sombraImgUser2"><br>
                        <div class="padding-top-10">
                            <span class="sinkinSans300L colorN padding-top5">{{Auth::user()->name}}</span><br>
                            <span class="sinkinSans200LI texto10">{{Auth::user()->getProfile->getCity->country->name}}</span>
                        </div>
                    </div>
                @endif
                <div class="borderBottomG padding-top-40">
                    <span class="text-uppercase sinkinSans400R">notificaciones</span>
                    <div>
                        <strong></strong>
                    </div>
                </div>
                <div class="padding-top-10" id="notifications_wrapper">
                    <ul id="notifications-list">
                        @if(\Auth::user() != null)
                            @foreach(\Auth::user()->unreadNotifications as $notification)
                                <li id="notif-{{ $notification->id }}">
                                    <a class="" href="{{ $notification['data']['url'] }}">{!! $notification['data']['data'] !!}</a>
                                    <button type="button" id="mark" data-target="{{ $notification->id }}" class="btn btn-link"><i class="ti-brush"></i> </button>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="row text-center">
                    <button id="markAsRead" class="btn btn-primary"><i
                                class="ti-brush"></i> @lang('views.clean_notifications')</button>
                </div>
            </div>

        </div>
    </div>

</div>
