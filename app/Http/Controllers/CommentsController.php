<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRaffleRequest;
use App\Raffle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Display the comments of a raffle
     *
     * @param $raffleId     Raffle id
     * @param $commentId
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function store(CommentRaffleRequest $request, $raffle)
    {


        $comment = new Comment();
        $comment->raffle = $raffle;
        $comment->text = $request->text;
        $comment->parent = $request->parent_id;
        $comment->user = \auth()->id();
        $comment->created_at = date('Y-m-d H:i:s');

        Auth::user()->getComments()->save($comment);

        return \redirect()->route('raffle.tickets.buy', $raffle);
    }
}
