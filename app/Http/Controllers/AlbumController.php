<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AlbumRepository;
use App\Repositories\UserRepository;
use App\Repositories\SongRepository;
use App\Entities\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AlbumController extends Controller
{
    protected $albumRepository;
    protected $userRepository;
    protected $songRepository;

    public function __construct(AlbumRepository $albumRepository, UserRepository $userRepository, SongRepository $songRepository)
    {
        $this->albumRepository = $albumRepository;
        $this->userRepository = $userRepository;
        $this->songRepository = $songRepository;
    }

    public function index()
    {
        $albums = $this->albumRepository->with(array('user'=>function($query){
            $query->select('id','name', 'username');
        }))->orderBy('count_listen', 'desc')->paginate($limit = '30', $columns = ['id','user_id', 'name', 'slug', 'image']);

        return view('list_album', compact('albums'));
    }

    public function getAlbumDetails($slug)
    {
        $album = $this->albumRepository->with(array('user'=>function($query){
            $query->select('id','name', 'username');
        }))->findByField('slug', $slug, $columns = ['id','user_id', 'name', 'slug', 'image', 'description', 'count_listen', 'count_like'])->first();
        $songs = $album->songs()->get();
        $comments = $album->comments()->with(array('user'=>function($query){
            $query->select('id', 'name', 'role_id', 'username', 'image');
        }))->orderBy('created_at', 'desc')->paginate($limit = '10', $columns = ['id', 'user_id', 'song_id', 'comment', 'created_at']);
        $albums = $this->albumRepository->with(array('user'=>function($query){
            $query->select('id', 'name', 'username');
        }))->orderBy('count_listen', 'desc')->paginate($limit = '16', $columns = ['id', 'user_id', 'name', 'slug','image']);
        /**
         * listen_count
         */
        $albumKey = 'song_' . $album->id;

        if(!Session::has($albumKey)) {
            $album->increment('count_listen');
            Session::put($albumKey, 1);
        }

        return view('album', compact('album', 'songs', 'comments', 'albums'));
    }

    public function storeComment(Request $request, $id)
    {
        $comment = Comment::create([
            'user_id' => Auth::id(),
            'album_id' => $id,
            'comment' => $request->comment
        ]);

        return [
            'html' => view('frontend.layouts.partials.comment.comment', compact('comment'))->render()
        ];
    }

}
