{{-- TODO customize the info here --}}
<div class="front">
    <div class="cover">
        <img src="{{ asset('pics/common/rotating_card_thumb.png') }}">
    </div>
    <div class="user">

        @if($user->getProfile->avatarname == 'default')

            <img id="profile-pic-card" class="img-circle" src={{ asset('pics/common/default-avatar.png') }}>
        @else
            <img id="profile-pic-card" class="img-circle" src="{{ $user->getProfile->getMedia('avatars')->first()->getUrl() }}">
        @endif

    </div>

    <div class="card-content">
        <div class="principale">
            <h3 class="name">{{ $user->name }}</h3>
            <p class="username">{{ $user->getProfile->username }}</p>

            <p class="text-center">"{{$user->getProfile->bio}}"</p>
        </div>
        <hr>
        <div class="bootom-rcard">
            <div class="rating">
                <img src="{{ asset('pics/countries/'. $user->getProfile->getCity->getCountry->name .'.png') }}">&emsp;
                {{ $user->getProfile->getCity->getCountry->name }}
            </div>
        </div>
    </div>
</div>