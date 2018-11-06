<?php

namespace App\Http\Controllers\Singer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Album;
use App\Repositories\AlbumRepository;
use App\Repositories\SongRepository;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{

    protected $repository;

    public function __construct(AlbumRepository $repository, SongRepository $song_repository)
    {
        $this->repository = $repository;
        $this->song_repository = $song_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = $this->repository->getAlbumOfSinger(Auth::id());
        return view('backend.singer.album.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $songs = $this->song_repository->getSongOfSinger(Auth::id());
        return view('backend.singer.album.create', compact('songs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request, [
            'name' => 'bail|required|min:3|max:100|unique:albums',
            'songs' => 'required',
            'image' => 'required|image'
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->name);

        if(isset($image)) {
            //Make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('album/image/'))
            {
                Storage::disk('public')->makeDirectory('album/image/');
            }
            $postImage = Image::make($image)->resize(1280,600)->save();
            Storage::disk('public')->put('album/image/'.$imageName, $postImage);
        } else {
            $imageName = "default.png";
        }

        $singer = Auth::user()->id;

        $album = $this->repository->create([
            'user_id' => $singer,
            'name' => $request->name,
            'slug' => $slug,
            'image' => $imageName,
            'description' => $request->description,
        ]);

        $album->songs()->attach($request->songs);

        Toastr::success('Album Successfully Created', 'Success');
        return redirect()->route('singer.album.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = $this->repository->with('user')->find($id);
        if ($album->user->id === Auth::id()) {
            return view('backend.singer.album.show', compact('album'));
        } else {
            Toastr::error('You are not authorized to access this album','Error');
            return redirect()->route('singer.album.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = $this->repository->with('user')->find($id);
        $songs = $this->song_repository->all();
        if ($album->user->id === Auth::id()) {
            return view('backend.singer.album.edit', compact('album', 'songs'));
        } else {
            Toastr::error('You are not authorized to access this album','Error');
            return redirect()->route('singer.album.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        $this->validate($request, [
            'name' => 'bail|required|min:3|max:100',
            'songs' => 'required',
            'image' => 'image'
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->name);

        if(isset($image))
        {
            //Make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('album/image/'))
            {
                Storage::disk('public')->makeDirectory('album/image/');
            }
            
            if(Storage::disk('public')->exists('album/image/'.$album->image))
            {
                Storage::disk('public')->delete('album/image/'.$album->image);
            }

            $postImage = Image::make($image)->resize(1280,600)->save();
            Storage::disk('public')->put('album/image/'.$imageName, $postImage);
        } else {
            $imageName = $album->image;
        }

        $singer = Auth::user()->id;

        $album = $this->repository->update([
            'user_id' => $singer,
            'name' => $request->name,
            'slug' => $slug,
            'image' => $imageName,
            'description' => $request->description,
        ], $album->id);

        $album->songs()->detach();
        $album->songs()->attach($request->songs);

        Toastr::success('Album Successfully Updated', 'Success');
        return redirect()->route('singer.album.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = $this->repository->with('user')->find($id);
        if (condition) {
            if(Storage::disk('public')->exists('album/image/'.$album->image))
            {
                Storage::disk('public')->delete('album/image/'.$album->image);
            }

            $album->songs()->detach();
            $this->repository->delete($id);
            Toastr::success('Album successfully deleted', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('You are not authorized to access this album','Error');
            return redirect()->route('singer.album.index');
        }
    }
}
