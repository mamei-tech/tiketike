<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRaffleRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:comments_store')       ->  only(['store']);
        $this->middleware('permission:comments_delete')      ->  only(['delete']);
        $this->middleware('permission:comments_edit')        ->  only(['edit']);
    }

    /**
     * Display the comments of a raffle
     *
     * @param CommentRaffleRequest $request
     * @param $raffle
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

        Log::log('INFO', trans('aLogs.comment_created'), [
            'user'              => Auth::user()->id,
            'comment_id'        => $comment->id,
        ]);

        return redirect()->route('raffle.tickets.buy', $raffle);
    }

    public function delete($id){
        $raffle = Comment::find($id)->getRaffle->id;
        Comment::destroy($id);

        Log::log('INFO', trans('aLogs.comment_del'), [
            'user'              => Auth::user()->id,
        ]);

        return redirect()->route('raffle.tickets.buy', $raffle);
    }

    public function edit(CommentRaffleRequest $request, $id)
    {
        $raffle = Comment::find($id)->getRaffle->id;
        $comment = Comment::find($id);

        $comment->text = $request->get('text');
        $comment->save();

        Log::log('INFO', trans('aLogs.comment_edited'), [
            'user'              => Auth::user()->id,
            'comment'           => $comment->id,
        ]);

        return redirect()->route('raffle.tickets.buy', $raffle);
    }
}
