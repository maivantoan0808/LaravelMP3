<?php

namespace App\Http\Controllers\Listener;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PlaylistRepository;
use App\Http\Requests\PlaylistRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Entities\Song;

class PlaylistController extends Controller
{
    protected $repository;

    public function __construct(PlaylistRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $playlists = Auth::user()->playlists;

        return view('backend.listener.playlist.manage', compact('playlists'));
    }

    public function show($id)
    {
        $playlist = $this->repository->find($id);
        $songs = $playlist->songs;

        return view('backend.listener.playlist.detail', compact('songs'));
    }

    public function destroy($id)
    {
        $playlist = $this->repository->find($id);
        $playlist->songs()->detach();
        $playlist->delete();
        Toastr::success('Playlist successfully deleted', 'Success');

        return redirect()->back();
    }

    public function destroySong($id)
    {
        $song = Song::find($id);
        $song->playlists()->detach();

        Toastr::success('Song successfully deleted', 'Success');

        return redirect()->back();
    }

}
