<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Song;

class DownloadController extends Controller
{
    public function downloadNormal($id, $file) {
        $song = Song::find($id);
        $song->increment('count_download');
        $file_path = storage_path($path = 'app/public/song/normal/'.$file);
        return response()->download($file_path);
    }
}
