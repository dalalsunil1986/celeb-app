<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Src\Celebrity\CelebrityRepository;
use App\Src\Photo\PhotoRepository;
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
     * @var PhotoRepository
     */
    private $photoRepository;

    /**
     * @param CelebrityRepository $celebrityRepository
     * @param VoteRepository $voteRepository
     * @param PhotoRepository $photoRepository
     */
    public function __construct(
        CelebrityRepository $celebrityRepository,
        VoteRepository $voteRepository,
        PhotoRepository $photoRepository
    ) {
        $this->celebrityRepository = $celebrityRepository;
        $this->voteRepository = $voteRepository;
        $this->photoRepository = $photoRepository;
    }

    /**
     * Add a Celeb to DB
     * @param Request $request
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'      => 'required|unique:celebrities,name',
            'thumbnail' => 'required | image'
        ]);

        $celebrity = $this->celebrityRepository->model->create([
            'name' => $request->name
        ]);

        if ($request->hasFile('thumbnail')) {

            $this->photoRepository->attach($request->file('thumbnail'), $celebrity, ['thumbnail' => 1]);

        }

    }


}
