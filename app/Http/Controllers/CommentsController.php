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

        return redirect()->route('raffle.tickets.buy', $raffle);
    }

    public function delete($id){
        $raffle = Comment::find($id)->getRaffle->id;
        Comment::destroy($id);


        return redirect()->route('raffle.tickets.buy', $raffle);
    }

    public function edit(CommentRaffleRequest $request, $id){


        $raffle = Comment::find($id)->getRaffle->id;
        $comment = Comment::find($id);

        $comment->text = $request->get('text');
        $comment->save();
        return \redirect()->route('raffle.tickets.buy', $raffle);
    }

    public function update(Request $request, $id)
    {
        $raffle = Raffle::find($id);
        $raffle->title = $request->get('title');
        $raffle->description = $request->get('description');
        $raffle->price = $request->get('price');
        $raffle->category = $request->get('category');
        $raffle->location = $request->get('location');
        $raffle->save();
        return redirect()->route('unpublished.index',
            [
                'div_showRaffles' => 'show',
                'li_activeURaffles' => 'active',
            ],
            '303')
            ->with('success', 'Raffle updated successfully');
    }

}
