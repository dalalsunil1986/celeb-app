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

    public function index()
    {
        $celebrities = $this->celebrityRepository->model->with('thumbnail')->paginate(100);

        return view('admin.celebrity.index', compact('celebrities'));
    }

    public function  create()
    {
        return view('admin.celebrity.create');
    }

    /**
     * Add a Celeb to DB
     * @param Request $request
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|unique:celebrities,name',
            'thumbnail' => 'required | image'
        ]);

        $celebrity = $this->celebrityRepository->model->create([
            'name' => $request->name
        ]);

        if ($request->hasFile('thumbnail')) {

            $this->photoRepository->attach($request->file('thumbnail'), $celebrity, ['thumbnail' => 1]);

        }

        return redirect('/admin/celebrity/create')->with('success', 'Celebrity Added');
    }

    public function edit($id)
    {
        $celebrity = $this->celebrityRepository->model->find($id);

        return view('admin.celebrity.edit', compact('celebrity'));

    }

    public function update(Request $request, $id)
    {
        $celebrity = $this->celebrityRepository->model->find($id);
        $this->validate($request, [
            'name'      => 'required|unique:celebrities,name,'.$id,
            'thumbnail' => 'image'
        ]);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $this->photoRepository->replace($file, $celebrity, ['thumbnail' => 1], $id);
        }
        return redirect('/admin/celebrity/')->with('success', 'Celebrity Updated');
    }

    public function delete($id)
    {
        $celebrity = $this->celebrityRepository->model->find($id);
        $celebrity->delete();

        return redirect('/admin/celebrity/')->with('success', 'Celebrity Deleted');
    }

    public function destroy($id)
    {


    }


}
