@extends('layouts.base')

@section('title', 'Raffles')


{{--Current Raffles--}}

@section('content')

    @if(Auth::check())
        <form action="{{ route('raffles.update',['raffleId' => $raffle->id]) }}" method="POST">

            @csrf

            {{--Raffle Name--}}
            <label for="raffle-name">Title</label>
            <input type="text" name="title" id="raffle-name" placeholder="raffle name goes here" value="{{ $raffle->title }}">

            {{--Raffle Description--}}
            <label for="raffle-desc">Description</label>
            <textarea type="text" name="description" id="raffle-desc" placeholder="description">{{ $raffle->description }}</textarea>

            {{--Raffle Price--}}
            <label for="raffle-price">Price($)</label>
            <input type="text" name="price" id="raffle-price" placeholder="0.0" value="{{ $raffle->price }}">

            {{--Raffle Categories--}}
            <label for="raffle-category">Category</label>
            <select name="category" id="raffle-category">
                @if (count($rcategories))
                    @foreach($rcategories as $cat)
                        <option @if($cat->id == $raffle->getCategory->id) selected="selected" @endif value="{{$cat->id}}">{{$cat->category}}</option>
                    @endforeach
                @else
                    <option>NO</option>
                @endif
            </select>

            {{--Add Raffle Button--}}
            <button type="submit">Update Raffle</button>

        </form>
    @else
        <p>Your are not allow to see this form</p>
    @endif

@endsection

