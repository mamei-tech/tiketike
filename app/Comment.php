<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Comment extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $fillable = ['text'];

    /**
     * Comment constructor.
     *
     * @param string $text
     */
    /*public function __construct(string $text)
    {
        $this->text = $text;
        parent::__construct();
    }*/

    /**
     * Retrieve childs comments.
     *
     * @return HasMany
     */
    public function getChilds()
    {
        return $this->hasMany('App\Comment', 'parent');
    }

    /**
     * Retrieve parent comment.
     *
     * @return BelongsTo
     */
    public function getParent()
    {
        return $this->belongsTo('App\Comment', 'parent');
    }

    /**
     * Comment raffle.
     *
     * @return BelongsTo
     */
    public function getRaffle()
    {
        return $this->belongsTo('App\Raffle', 'raffle');
    }

    /**
     * User which comment.
     *
     * @return BelongsTo
     */
    public function getUser()
    {
        return $this->belongsTo('App\User', 'user');
    }
}
