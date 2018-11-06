<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Song;
use App\Entities\Album;
use App\Entities\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $songs = Song::search($request->get('search'))->get();
        $albums = Album::search($request->get('search'))->get();
        $singers = User::search($request->get('search'))->where('role_id', '3')->get();
        //dd($albums);

        return view('search',compact('songs', 'albums', 'singers'));
    }
}
