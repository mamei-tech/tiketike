<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Raffle;
use App\Repositories\CommentsRepository;
use App\Repositories\RaffleRepository;


class CommentsController extends Controller
{

    // TODO Identify which methods apply to convert to rest method !!!!
    private $CommenstsRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CommentsRepository $commentsRepository)
    {
        $this->middleware('permission:list_roles')          ->  only(['index']);

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
