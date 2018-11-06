<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id', 'song_id', 'album_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Entities\User');
    }

    public function song()
    {
        return $this->belongsTo('App\Entities\Song');
    }

    public function album()
    {
        return $this->belongsTo('App\Entities\Album');
    }

}
