<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SongRepository;
use App\Repositories\AlbumRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    protected $songRepository;
    protected $albumRepository;
    protected $userRepository;

    public function __construct(SongRepository $songRepository, AlbumRepository $albumRepository, UserRepository $userRepository)
    {
        $this->songRepository = $songRepository;
        $this->albumRepository = $albumRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slideTopSongs = $this->songRepository->orderBy('count_listen', 'desc')->paginate($limit = '5', $columns = ['id', 'name', 'image', 'slug']);
        $albumsHot = $this->albumRepository->with(array('user'=>function($query){
            $query->select('id','name', 'username');
        }))->orderBy('count_listen', 'desc')->paginate($limit = '12', $columns = ['id','user_id', 'name', 'slug', 'image']);
        $songs = $this->songRepository->orderBy('count_listen', 'desc')->paginate($limit = '10', $columns = ['id', 'name', 'normal_url']);
        $singers = $this->userRepository->getSinger()->orderBy('count_followers', 'desc')->paginate($limit = '12', $columns = ['id', 'name', 'username', 'image']);
        $newSongs = $this->songRepository->orderBy('created_at', 'desc')->paginate($limit = '10', $columns = ['name', 'slug', 'image', 'created_at']);
        return view('home', compact('slideTopSongs','albumsHot', 'songs', 'singers', 'newSongs'));
    }

    public function download($slug)
    {
        $song = $this->songRepository->findByField('slug', $slug)->first();
        dd($song);
        return Storage::download('file.jpg');
    }

    public function pageError()
    {
        return view('errors.404');
    }

}
