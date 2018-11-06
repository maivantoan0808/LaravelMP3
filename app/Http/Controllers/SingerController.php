<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Entities\User;
use Illuminate\Support\Facades\Auth;

class SingerController extends Controller
{
    protected $singerRepository;

    public function __construct(UserRepository $singerRepository)
    {
        $this->singerRepository = $singerRepository;
    }

    public function index()
    {
        $singers = $this->singerRepository->getSinger()->paginate($limit = '30', $columns = ['id', 'name', 'username', 'image']);

        return view('list_singer', compact('singers'));
    }

    public function show($username)
    {
        $singer = $this->singerRepository->findByField('username', $username, $columns = ['id', 'name', 'username', 'image', 'about', 'birthday', 'count_followers'])->first();

        $albums = $singer->albums()->paginate($limit = '5', $columns = ['id', 'name', 'slug', 'image', 'created_at']);
        
        $songs = $singer->songs()->paginate($limit = '5', $columns = ['name','slug', 'image', 'songs.created_at']);
        
        $singers = $singer->categories()->first()->users()->paginate($limit = '5', $columns = ['name', 'username','image', 'count_followers']);
        
        return view('singer', compact('singer', 'albums', 'songs', 'singers'));
    }

    public function getSongOfSinger($username)
    {
        $singer = $this->singerRepository->findByField('username', $username, $columns = ['id', 'name', 'username'])->first();
        
        $songs = $singer->songs()->paginate($limit = '12', $columns = ['name','slug', 'image']);
        
        return view('list_song_of_singer', compact('singer', 'songs'));
    }

    public function getAlbumOfSinger($username)
    {
        $singer = $this->singerRepository->findByField('username', $username, $columns = ['id', 'name', 'username'])->first();
        
        $albums = $singer->albums()->paginate($limit = '12', $columns = ['name', 'slug', 'image']);
        
        return view('list_album_of_singer', compact('singer', 'albums'));
    }

}
