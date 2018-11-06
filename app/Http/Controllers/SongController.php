<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SongRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CommentRepository;
use App\Entities\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class SongController extends Controller
{
    protected $songRepository;
    protected $categoryRepository;
    protected $commentRepository;
    protected $playlistRepository;

    public function __construct(SongRepository $songRepository, CategoryRepository $categoryRepository, CommentRepository $commentRepository)
    {
        $this->songRepository = $songRepository;
        $this->categoryRepository = $categoryRepository;
        $this->commentRepository = $commentRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->findWhereNotIn('id', [1], $columns = ['id', 'name', 'slug']);
        $songs = $this->songRepository->with('users')->orderBy('created_at', 'desc')->paginate($limit = '30', $columns = ['id', 'name', 'slug', 'image']);

        return view('list_song', compact('categories', 'songs'));
    }

    public function getSongByCategory($slug)
    {
        $categories = $this->categoryRepository->findWhereNotIn('id', [1], $columns = ['id' ,'name', 'slug']);
        $category = $this->categoryRepository->findByField('slug', $slug, $columns = ['id', 'name', 'slug'])->first();
        $songs = $category->songs()->orderBy('created_at', 'desc')->paginate($limit = '30', $columns = ['id', 'name', 'slug', 'image']);

        return view('list_song_by_category', compact('categories' ,'songs'));
    }

    public function getSongDetails($slug)
    {
        $song = $this->songRepository->with('users')->findByField('slug', $slug, $columns = ['*'])->first();
        $comments = $song->comments()->with(array('user'=>function($query){
            $query->select('id','name', 'role_id', 'username', 'image');
        }))->orderBy('created_at', 'desc')->paginate($limit = '10', $columns = ['id', 'user_id', 'song_id', 'comment', 'created_at']);
        $songs = $song->category()->first(['id'])->songs()->with('users')->orderBy('count_listen', 'desc')->paginate($limit = '10', $columns = ['id', 'name', 'count_listen', 'slug','image']);
        
        // $songKey = 'song_' . $song->id;

        // if(!Session::has($songKey)) {
        //     $song->increment('count_listen');
        //     Session::put($songKey, 1);
        // }
        $song->addViewWithExpiryDate();
        dd($song->getViews());

        return view('song', compact('song', 'comments', 'songs'));
    }

    public function storeComment(Request $request, $id)
    {
        $comment = Comment::create([
            'user_id' => Auth::id(),
            'song_id' => $id,
            'comment' => $request->comment
        ]);

        return [
            'html' => view('frontend.layouts.partials.comment.comment', compact('comment'))->render()
        ];
    }

}
