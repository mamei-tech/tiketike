@extends('layouts.base')

@section('title', 'Available Tickets')


    {{--Current  available tickets--}}

@section('content')

    @if(Auth::check())

    <form action="{{ $url }}" method="POST">

        @csrf

        <select name="availabletickets[]" multiple="multiple">

            @foreach($tickets as $t)
                <option value="{{$t->code}}">{{$t->code}}</option>
            @endforeach

        </select>

        {{--Buy Tickets Button--}}
        <button type="submit">Buy Tickets</button>

    </form>

    @else
        <p>Your are not allow to see this form</p>
    @endif

@endsection

