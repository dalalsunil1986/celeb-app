<?php namespace App\Src\Celebrity;

use App\Core\BaseRepository;
use Carbon\Carbon;

class CelebrityRepository extends BaseRepository
{

    public $model;

    /**
     * Construct
     * @param Celebrity $model
     */
    public function __construct(Celebrity $model)
    {
        $this->model = $model;
    }

    public function getRankings($paginate = 10)
    {

    }

}