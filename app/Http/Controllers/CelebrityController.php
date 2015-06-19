<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Src\Celebrity\CelebrityRepository;
use App\Src\Vote\VoteRepository;
use Illuminate\Support\Facades\DB;

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

    /**
     * Get Celeb For Main Screen
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Get a Random Celeb from DB
        $celebrityA = $this->celebrityRepository->model->with('thumbnail')->has('thumbnail')->orderBy(DB::raw('RAND()'))->first();

        // Get another Random Celeb from DB
        $celebrityB = $this->celebrityRepository->model->with('thumbnail')->has('thumbnail')->whereNotIn('id',
            [$celebrityA->id])->orderBy(DB::raw('RAND()'))->first();

        // Preprare JSON Response


        $data = response()->json([$celebrityA,$celebrityB]);


        return $data;

// Example Response
//  [
//    {
//        "celebrityA": {
//        "id": 100,
//            "name": "Dessie Robel",
//            "url": "asdad.jpg",
//            "created_at": "2015-06-13 12:11:46",
//            "updated_at": "2015-06-13 12:11:46",
//            "thumbnail": {
//            "id": 95,
//                "name": "saepe.jpg",
//                "imageable_id": 100,
//                "imageable_type": "App\\Src\\Celebrity\\Celebrity",
//                "thumbnail": 1,
//                "created_at": "2015-06-13 12:11:52",
//                "updated_at": "2015-06-13 12:11:52"
//            }
//        },
//        "celebrityB": {
//        "id": 30,
//            "name": "Dr. Roberto Nikolaus",
//            "url": "asdad.jpg",
//            "created_at": "2015-06-13 12:11:46",
//            "updated_at": "2015-06-13 12:11:46",
//            "thumbnail": {
//            "id": 3,
//                "name": "sint.jpg",
//                "imageable_id": 30,
//                "imageable_type": "App\\Src\\Celebrity\\Celebrity",
//                "thumbnail": 1,
//                "created_at": "2015-06-13 12:11:52",
//                "updated_at": "2015-06-13 12:11:52"
//            }
//        }
//    }
//  ]

    }

    /**
     * Get Rankings
     * @return mixed
     */
    public function getRankings()
    {
        $rankings = $this->celebrityRepository->model->getRankings();

        $rankings->load('thumbnail');

        return $rankings;
    }

}
