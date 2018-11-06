<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        'user_id', 'followed_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Entities\User');
    }

}
