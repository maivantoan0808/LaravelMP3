<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Follow;
use App\Entities\User;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class FollowController extends Controller
{
    public function add(User $user)
    {
        if(Auth::id() == $user->id) {
            Toastr::info('You cannot follow yourself!', 'info');
            return redirect()->back();
        }else {
            Follow::create([
                'user_id' => Auth::id(),
                'followed_id' => $user->id
            ]);
            $user->increment('count_followers');

            return redirect()->back();
        }

    }

    public function remove(User $user)
    {
        $follow = Auth::user()->follows()->where('followed_id', $user->id)->first();
        $user->decrement('count_followers');
        $follow->delete();

        return redirect()->back();
    }

}
