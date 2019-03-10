@extends('layouts.base')

@section('title', 'Raffles')

{{--Current Raffles--}}

@section('content')

    @if (count($raffles) > 0)
        <strong>Raffles</strong>
        <ul>
            @foreach($raffles as $raffle)
                <li>Name: {{ $raffle->name }} <br>
                    Descr: {{ $raffle->description }} <br>
                    Categ: {{ $raffle->getCategory->category }} <br>
                    Statu: {{ $raffle->getStatus->status }} <br>
                    Image: <img src="{{ asset($raffle->image) }}"> <br>
                    Followers: {{ count($raffle->getFollowers) }} <br>
                    Location: <img src="{{ asset('pics/countries/'. $raffle->getLocation->name .'.png') }}"> <br>
                    <a href="{{ route('raffles.follow',['raffleId' => $raffle->id]) }}">Follow</a>
                    @if(\Auth::user() !== null)
                        @if(\Auth::user()->id == $raffle->owner)
                            <a href="{{ route('raffles.edit',['raffleId' => $raffle->id]) }}">Edit raffle</a>
                        @endif
                    @endif
                </li>
            @endforeach
        </ul>
    @endif

    {{ $raffles->links() }}

@endsection

