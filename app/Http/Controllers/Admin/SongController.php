<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SongRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Entities\Song;
use App\Entities\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminDeleteSong;

class SongController extends Controller
{
    protected $repository;
    protected $category_repository;
    protected $singer_repository;

    public function __construct(SongRepository $repository, CategoryRepository $category_repository, UserRepository $singer_repository )
    {
        $this->repository = $repository;
        $this->category_repository = $category_repository;
        $this->singer_repository = $singer_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $songs = $this->repository->with('category')->orderBy('created_at', 'desc')->get();
        return view('backend.admin.song.index', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        return view('backend.admin.song.show', compact('song'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Song  $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        if(Storage::disk('public')->exists('song/image/'.$song->image)) {
            Storage::disk('public')->delete('song/image/'.$song->image);
        }

        if(Storage::disk('public')->exists('song/normal/'.$song->normal_url)) {
            Storage::disk('public')->delete('song/normal/'.$song->normal_url);
        }
        
        if(Storage::disk('public')->exists('song/vip/'.$song->vip_url)) {
            Storage::disk('public')->delete('song/vip/'.$song->vip_url);
        }

        foreach ($song->users as $user) {
            Notification::route('mail', $user->email)->notify(new AdminDeleteSong($song));
        }
        $song->users()->detach();
        $this->repository->delete($song->id);
        Toastr::success('Song successfully deleted', 'Success');
        return redirect()->back();
    }
}
