<?php

namespace App\Http\Controllers;

use App\Comment;
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
    public function commentResponses($raffleId, $commentId, Request $request)
    {
        $responses = null;
        if ($commentId == 'root')
            $responses = Comment::where('raffle', $raffleId)->where('parent', null)->get();
        else {
            $comment = Comment::find($commentId);
            if ($comment == null) {
                //TODO return some error view
                echo 'UNKNOWN COMMENT';
                die;
            }
            $responses = Comment::where('raffle', $raffleId)->where('parent', $commentId)->get();
        }

        return view('raffles.comments', ['url' => $request->fullUrl(), 'responses' => $responses]);
    }

    public function respondComment($raffleId, $commentId, Request $request)
    {
        if (Raffle::find($raffleId) == null) {
            //TODO return some error view
            echo 'UNKNOWN RAFFLE';
            die;
        }
        $commentText = $request->comment;
        $parentId = null;
        if ($commentId != 'root') {
            if (Comment::find($commentId) == null) {
                //TODO return some error view
                echo 'UNKNOWN COMMENT';
                die;
            }
            $parentId = $commentId;
        }
        $comment = new Comment;
        $comment->raffle = $raffleId;
        $comment->parent = $parentId;
        $comment->text = $commentText;
        Auth::user()->getComments()->save($comment);

        $responses = $commentId == 'root' ?
            Comment::where('raffle', $raffleId)->where('parent', null)->get() :
            Comment::where('raffle', $raffleId)->where('parent', $parentId)->get();

        return view('raffles.comments', ['url' => $request->fullUrl(), 'responses' => $responses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $raffle)
    {

//        var_dump($request->id);die();


        $comment = new Comment();
        $comment->raffle = $raffle;
        $comment->text = $request->text;
        $comment->parent = $request->parent_id;
        $comment->user = \auth()->id();
        $comment->created_at = date('Y-m-d H:i:s');

        Auth::user()->getComments()->save($comment);

        return \redirect()->route('raffle.tickets.buy', $raffle);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
