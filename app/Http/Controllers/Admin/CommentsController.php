<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Raffle;
use App\Repositories\CommentsRepository;
use App\Repositories\RaffleRepository;


class CommentsController extends Controller
{
    private $CommenstsRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CommentsRepository $commentsRepository)
    {
        // I think this is not needed because I have this in the route middleware
        // Authentication
        $this->middleware('auth');
//        $this->middleware('permission:list comments');
//        $this->middleware('permission:edit comments', ['only' => ['edit', 'update']]);
//        $this->middleware('permission:delete comments', ['only' => ['destroy']]);
        $this->CommenstsRepository = $commentsRepository;

    }


    public function index()
    {
        $comments = $this->CommenstsRepository->getComments();


        return view('admin.raffles_comments', [
            'comments' => $comments,

        ]);
    }
}
