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
        $celebrities = $this->celebrityRepository->model->with(['thumbnail'=>function($q){
            $q->addSelect(['id','name','imageable_id']);
        }])->has('thumbnail')->orderBy(DB::raw('RAND()'))->limit(10)->get(['id','name']);

        if ($celebrities) {
            return response()->json($celebrities->toArray());
        }

        return null;
    }

//    public function index()
//    {
//        // Get a Random Celeb from DB
//        $celebrityA = $this->celebrityRepository->model->with('thumbnail')->has('thumbnail')->orderBy(DB::raw('RAND()'))->first();
//
//        if ($celebrityA) {
//            // Get another Random Celeb from DB
//
//            $celebrityB = $this->celebrityRepository->model->with('thumbnail')->has('thumbnail')->whereNotIn('id',
//                [$celebrityA->id])->orderBy(DB::raw('RAND()'))->first();
//
//
//            if ($celebrityB) {
//                $data = response()->json([$celebrityA, $celebrityB]);
//
//                return $data;
//
//            }
//            // Preprare JSON Response
//            return null;
//
//        }
//
//        return null;
//    }

    /**
     * Get Rankings
     * @return mixed
     */
    public function getRankings()
    {
        $rankings = $this->celebrityRepository->model->getRankings(10);

        $rankings->load('thumbnail');

        return $rankings;
    }

}
