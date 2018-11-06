<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;
use App\Entities\Song;
use App\Entities\Album;
use App\Entities\Comment;
use App\Entities\Category;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $songs = Song::count();
        $views = Song::sum('count_listen') + Album::sum('count_listen');
        $singers = User::where('role_id', '3')->count();
        $users = User::where('role_id', '2')
            ->orWhere('role_id', '4')
            ->count();
        $categories = Category::count();

        $usersRequest = User::where('role_id', '4')->count();
        $newSongs = Song::where('created_at', '>', Carbon::today())->count();
        $newAlbums = Album::where('created_at', '>', Carbon::today())->count();
        $newUsers = User::where('role_id', '2')
            ->orWhere('role_id', '4')
            ->where('created_at', '>', Carbon::today())
            ->count();
        $newComments = Comment::where('created_at', '>', Carbon::today())->count();

        $hotSongs = Song::withCount('comments')
            ->orderBy('count_listen', 'DESC')
            ->orderBy('comments_count', 'DESC')
            ->orderBy('count_like', 'DESC')
            ->take(10)->get();
        
        $topUsers = User::where('role_id', '2')
            ->orWhere('role_id', '4')
            ->withCount('playlists')
            ->withCount('comments')
            ->withCount('likes')
            ->orderBy('comments_count', 'DESC')
            ->orderBy('playlists_count', 'DESC')
            ->orderBy('likes_count', 'DESC')
            ->take(10)->get();

        return view('backend.admin.dashboard', compact('songs', 'categories', 'singers', 'users', 'usersRequest', 'views', 'newSongs', 'newAlbums', 'newUsers', 'hotSongs', 'newComments', 'topUsers'));
    }
}
