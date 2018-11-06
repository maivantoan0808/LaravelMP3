<?php

namespace App\Http\Controllers\Singer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;
use App\Entities\Song;
use App\Entities\Album;
use App\Entities\Comment;
use App\Entities\Category;
use App\Entities\Follow;
use App\Entities\Like;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $songs = Auth::user()->songs()->count();
        $views = Auth::user()->songs()->sum('count_listen') + Auth::user()->albums()->sum('count_listen');
        $albums = Auth::user()->albums()->count();
        $followers = Follow::where('followed_id', Auth::id())->count();
        $likeSongs = Auth::user()->songs()->sum('count_like');
        $likeAlbums = Auth::user()->albums()->sum('count_like');

        $newComments = Auth::user()->albums()->where('created_at', '>', Carbon::today())->count();
        $newFollowers = Follow::where('followed_id', Auth::id())->where('created_at', '>', Carbon::today())->count();

        $hotSongs = Auth::user()->songs()
            ->withCount('comments')
            ->orderBy('count_listen', 'DESC')
            ->orderBy('comments_count', 'DESC')
            ->orderBy('count_like', 'DESC')
            ->take(5)->get();
        
        return view('backend.singer.dashboard', compact('songs', 'views', 'albums', 'followers', 'likes', 'likeSongs', 'likeAlbums', 'newComments', 'newFollowers', 'hotSongs'));
    }
}
