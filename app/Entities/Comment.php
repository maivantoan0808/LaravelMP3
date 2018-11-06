<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Comment.
 *
 * @package namespace App\Entities;
 */
class Comment extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'song_id', 'album_id', 'comment'];

    public function song()
    {
        return $this->belongsTo('App\Entities\Song');
    }

    public function user()
    {
        return $this->belongsTo('App\Entities\User');
    }

    public function album()
    {
        return $this->belongsTo('App\Entities\Album');
    }

}
