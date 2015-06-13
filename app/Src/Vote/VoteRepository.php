<?php namespace App\Src\Vote;

use App\Core\BaseRepository;

class VoteRepository extends BaseRepository
{

    public $model;

    /**
     * Construct
     * @param Vote $model
     */
    public function __construct(Vote $model)
    {
        $this->model = $model;
    }

}