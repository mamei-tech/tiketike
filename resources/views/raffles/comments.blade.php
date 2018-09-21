@extends('layouts.base')

@section('title', 'Raffle comments')


@section('content')

    @forelse ($responses as $comment)
        <p>
            <b>{{$comment->getUser->username}}</b><br>
            {{$comment->text}}<br>
        </p>
        @empty
            No comments for this raffle.
    @endforelse

    <form action="{{ $url }}" method="POST">

        @csrf

        <input name="comment" type="text">

        <button type="submit">Comment</button>

    </form>

@endsection