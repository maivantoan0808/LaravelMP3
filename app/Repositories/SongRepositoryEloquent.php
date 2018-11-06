<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SongRepository;
use App\Entities\Song;
use App\Validators\SongValidator;
use App\Entities\User;

/**
 * Class SongRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SongRepositoryEloquent extends BaseRepository implements SongRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Song::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getSongOfSinger($id)
    {
        $userOfSong = User::with('songs')->where('id', '=', $id)->firstOrFail();
        $data = $userOfSong->songs;

        return $data;
    }

}
