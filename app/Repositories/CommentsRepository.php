<?php

namespace App\Repositories;

use App\Comment;


class CommentsRepository
{


    /**
     * Retrieve all the Published raffles
     *
     * @return mixed
     */
    public function getComments()
    {
        $comments = Comment::orderBy('created_at','DESC')->get();
        return $comments;
    }


}
