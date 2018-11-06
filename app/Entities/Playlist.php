<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Playlist.
 *
 * @package namespace App\Entities;
 */
class Playlist extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id' ,'name', 'slug', 'image', 'count_listen', 'count_like'];

    public function songs()
    {
        return $this->belongsToMany('App\Entities\Song')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\Entities\User');
    }
    
}
