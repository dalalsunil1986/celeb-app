<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Src\Celebrity\CelebrityRepository;
use App\Src\Vote\VoteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
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
     * Case a Vote
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate The Post Values
        $this->validate($request, [
            'celebrityA' => 'required|integer',
            'celebrityB' => 'required|integer',
            'vote'       => 'required|integer|exists:celebrities,id',
        ]);

        // Create a Record IN DB
        $vote = $this->voteRepository->model->create([
            'celebrity_id' => $request->vote
        ]);

        // Return Response
        $data = response()->json([
            'message' => 'Success.',
            'data'    => $vote
        ], 200);

        return $data;
    }

}
