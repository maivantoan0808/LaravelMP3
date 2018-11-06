<?php

namespace App\Http\Controllers\Singer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SongRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SongRequest;
use App\Entities\Song;
use App\Entities\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Http\File;

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
        $songs = $this->repository->getSongOfSinger(Auth::id());
        return view('backend.singer.song.index', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category_repository->findWhereNotIn('id', [1]);
        $singers = $this->singer_repository->findByField('role_id', '3');
        return view('backend.singer.song.create', compact('categories', 'singers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SongRequest $request)
    {
        $image = $request->file('image');
        $normal_url = $request->file('normal_url');
        $vip_url = $request->file('vip_url');
        $slug = str_slug($request->name);

        if(isset($image))
        {
            //Make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('song/image/'))
            {
                Storage::disk('public')->makeDirectory('song/image/');
            }
            $postImage = Image::make($image)->resize(1280,600)->save();
            Storage::disk('public')->put('song/image/'.$imageName, $postImage);
        } else {
            $imageName = "default.png";
        }

        if(isset($normal_url))
        {
            //Make unique name for normal url
            $currentDate = Carbon::now()->toDateString();
            $normalName  = $slug.'-'.$currentDate.'-'.'normal'.'-'.uniqid().'.'.$normal_url->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('song/normal/'))
            {
                Storage::disk('public')->makeDirectory('song/normal/');
            }

            $normal_url->move('storage/song/normal', $normalName);
        } else {
            $normalName = "default.mp3";
        }

        if(isset($vip_url))
        {
            //Make unique name for vip url
            $currentDate = Carbon::now()->toDateString();
            $vipName  = $slug.'-'.$currentDate.'-'.'vip'.'-'.uniqid().'.'.$vip_url->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('song/vip/'))
            {
                Storage::disk('public')->makeDirectory('song/vip/');
            }

            $vip_url->move('storage/song/vip', $vipName);
        } else {
            $vipName = "default.mp3";
        }

        $request->merge([
            'slug' => $slug,
            'image' => $imageName,
            'normal_url' => $normalName,
            'vip_url' => $vipName,
        ]);
        
        $song = $this->repository->create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $slug,
            'image' => $imageName,
            'normal_url' => $normalName,
            'vip_url' => $vipName,
            'lyrics' => $request->lyrics,
        ]);
        $song->users()->attach($request->singers);

        Toastr::success('Song Successfully Created', 'Success');
        return redirect()->route('singer.song.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $song = $this->repository->with('users')->find($id);
        foreach ($song->users as $songUser) {
            if ($songUser->id === Auth::id())
            {
                return view('backend.singer.song.show', compact('song'));
            }
        }

        Toastr::error('You are not authorized to access this post','Error');
        return redirect()->route('singer.song.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->category_repository->findWhereNotIn('id', [1]);
        $singers = $this->singer_repository->findByField('role_id', '3');
        $song = $this->repository->with('users')->find($id);
        foreach ($song->users as $songUser) {
            if ($songUser->id === Auth::id())
            {
                return view('backend.singer.song.edit', compact('categories','singers','song'));
            }
        }
        Toastr::error('You are not authorized to access this post','Error');
        return redirect()->route('singer.song.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Song $song)
    {
        $this->validate($request,[
            'name' => 'bail|min:3|max:100',
            'normal_url' => 'bail|mimes:mpga',
            'vip_url' => 'bail|mimes:mpga',
            'image' => 'bail|image',
            'lyrics' => 'bail|max:65535'
        ]);
        $image = $request->file('image');
        $normal_url = $request->file('normal_url');
        $vip_url = $request->file('vip_url');

        $slug = str_slug($request->name);
        if(isset($image))
        {
            //Make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('song/image/'))
            {
                Storage::disk('public')->makeDirectory('song/image/');
            }

            if(Storage::disk('public')->exists('song/image/'.$song->image))
            {
                Storage::disk('public')->delete('song/image/'.$song->image);
            }

            $postImage = Image::make($image)->resize(1280,600)->save();
            Storage::disk('public')->put('song/image/'.$imageName, $postImage);
        } else {
            $imageName = $song->image;
        }

        if(isset($normal_url))
        {
            //Make unique name for normal url
            $currentDate = Carbon::now()->toDateString();
            $normalName  = $slug.'-'.$currentDate.'-'.'normal'.'-'.uniqid().'.'.$normal_url->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('song/normal/'))
            {
                Storage::disk('public')->makeDirectory('song/normal/');
            }

            if(Storage::disk('public')->exists('song/normal/'.$song->normal_url))
            {
                Storage::disk('public')->delete('song/normal/'.$song->normal_url);
            }

            $normal_url->move('storage/song/normal', $normalName);
        } else {
            $normalName = $song->normal_url;
        }

        if(isset($vip_url))
        {
            //Make unique name for vip url
            $currentDate = Carbon::now()->toDateString();
            $vipName  = $slug.'-'.$currentDate.'-'.'vip'.'-'.uniqid().'.'.$vip_url->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('song/vip/'))
            {
                Storage::disk('public')->makeDirectory('song/vip/');
            }

            if(Storage::disk('public')->exists('song/vip/'.$song->vip_url))
            {
                Storage::disk('public')->delete('song/vip/'.$song->vip_url);
            }

            $vip_url->move('storage/song/vip', $vipName);
        } else {
            $vipName = $song->vip_url;
        }

        $request->merge([
            'slug' => $slug,
            'image' => $imageName,
            'normal_url' => $normalName,
            'vip_url' => $vipName,
        ]);
        
        $this->repository->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $slug,
            'image' => $imageName,
            'normal_url' => $normalName,
            'vip_url' => $vipName,
            'lyrics' => $request->lyrics,
        ], $song->id);
        $song->users()->detach();
        $song->users()->attach($request->singers);

        Toastr::success('Song Successfully Updated', 'Success');
        return redirect()->route('singer.song.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $song = $this->repository->with('users')->find($id);
        foreach ($song->users as $songUser) {
            if ($songUser->id === Auth::id())
            {
                if(Storage::disk('public')->exists('song/image/'.$song->image))
                {
                    Storage::disk('public')->delete('song/image/'.$song->image);
                }

                if(Storage::disk('public')->exists('song/normal/'.$song->normal_url))
                {
                    Storage::disk('public')->delete('song/normal/'.$song->normal_url);
                }
                
                if(Storage::disk('public')->exists('song/vip/'.$song->vip_url))
                {
                    Storage::disk('public')->delete('song/vip/'.$song->vip_url);
                }
                
                $song->users()->detach();
                $this->repository->delete($id);
                Toastr::success('Song successfully deleted', 'Success');
                return redirect()->back();
            }
        }

        Toastr::error('You are not authorized to access this post','Error');
        return redirect()->route('singer.song.index');
    }
}
