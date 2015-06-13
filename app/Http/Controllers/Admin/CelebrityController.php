<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Src\Celebrity\CelebrityRepository;
use App\Src\Vote\VoteRepository;
use Illuminate\Http\Request;

class CelebrityController extends Controller
{
    /**
     * @var CelebrityRepository
     */
    private $celebrityRepository;
    /**
     * @var VoteRepository
     */
    private $voteRepository;

    /**
     * @param CelebrityRepository $celebrityRepository
     * @param VoteRepository $voteRepository
     */
    public function __construct(CelebrityRepository $celebrityRepository, VoteRepository $voteRepository)
    {
        $this->celebrityRepository = $celebrityRepository;
        $this->voteRepository = $voteRepository;
    }

    // View to Return Celebrity
    public function create()
    {

    }

    /**
     * Add a Celeb to DB
     * @param Request $request
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'thumbnail' => 'required | image'
        ]);
    }

}
