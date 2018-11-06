<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PlaylistRepository;
use App\Http\Requests\PlaylistRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PlaylistController extends Controller
{
    protected $repository;

    public function __construct(PlaylistRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($username)
    {
        if (Auth::check() && Auth::user()->username == $username) {
            $playlists = $this->repository->findByField('user_id', Auth::id(), $columns = ['id','user_id', 'name', 'slug', 'image']);
        
            return view('list_playlist', compact('playlists'));    
        }else {
            Toastr::info('Please login to view', 'Info');
            return redirect()->back();
        }
        
    }

    public function show($username, $slug)
    {
        if (Auth::check() && Auth::user()->username == $username) {
            $playlist = $this->repository->findByField('slug', $slug, $columns = ['id', 'user_id', 'name', 'slug', 'image', 'count_listen', 'count_like'])->first();
            /**
            * listen_count
            */
            $playlistKey = 'playlist_' . $playlist->id;

            if(!Session::has($playlistKey)) {
                $playlist->increment('count_listen');
                Session::put($playlistKey, 1);
            }

            return view('playlist', compact('playlist'));
        }else {
            Toastr::info('Please login to view', 'Info');
            return redirect()->back();
        }
    }

    public function store(PlaylistRequest $request, $id)
    {
        $playlist = $this->repository->create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'slug' => str_slug($request->name)
        ]);

        $playlist->songs()->attach($id);

        Toastr::success('Song successfully added to new playlist', 'Success');
        return redirect()->back();
    }

    public function storeSong(Request $request, $id)
    {
        $playlist = $this->repository->find($request->playlist);
        foreach ($playlist->songs as $key => $song) {
            if ($song->id == $id) {
                Toastr::error('Song was in playlist', 'Error');
                return redirect()->back();
            }else{
                $playlist->songs()->attach($id);

                Toastr::success('Song successfully added to new playlist', 'Success');
                return redirect()->back();
            }
        };
    }

    public function storeNewPlaylist(PlaylistRequest $request)
    {
        $playlist = $this->repository->create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'slug' => str_slug($request->name)
        ]);

        Toastr::success('Playlist successfully created', 'Success');
        return redirect()->back();
    }

}
