<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Like;
use App\Entities\Song;
use App\Entities\Album;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class LikeController extends Controller
{
    public function createLikeSong(Song $song)
    {
        Like::create([
            'user_id' => Auth::id(),
            'song_id' => $song->id
        ]);
        $song->increment('count_like');

        return redirect()->back();
    }

    public function destroyLikeSong(Song $song)
    {
        $like = $song->likes()->where(['song_id' => $song->id, 'user_id' => Auth::id()])->first();
        $song->decrement('count_like');
        $like->delete();

        return redirect()->back();
    }

    public function createLikeAlbum(Album $album)
    {
        Like::create([
            'user_id' => Auth::id(),
            'album_id' => $album->id
        ]);
        $album->increment('count_like');

        return redirect()->back();
    }

    public function destroyLikeAlbum(Album $album)
    {
        $like = $album->likes()->where(['album_id' => $album->id, 'user_id' => Auth::id()])->first();
        $album->decrement('count_like');
        $like->delete();

        return redirect()->back();
    }

}
