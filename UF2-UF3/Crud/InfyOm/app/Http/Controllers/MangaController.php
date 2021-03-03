<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMangaRequest;
use App\Http\Requests\UpdateMangaRequest;
use App\Repositories\MangaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class MangaController extends AppBaseController
{
    /** @var  MangaRepository */
    private $mangaRepository;

    public function __construct(MangaRepository $mangaRepo)
    {
        $this->mangaRepository = $mangaRepo;
    }

    /**
     * Display a listing of the Manga.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $mangas = $this->mangaRepository->all();

        return view('mangas.index')
            ->with('mangas', $mangas);
    }

    /**
     * Show the form for creating a new Manga.
     *
     * @return Response
     */
    public function create()
    {
        return view('mangas.create');
    }

    /**
     * Store a newly created Manga in storage.
     *
     * @param CreateMangaRequest $request
     *
     * @return Response
     */
    public function store(CreateMangaRequest $request)
    {
        $input = $request->all();

        $manga = $this->mangaRepository->create($input);

        Flash::success('Manga saved successfully.');

        return redirect(route('mangas.index'));
    }

    /**
     * Display the specified Manga.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $manga = $this->mangaRepository->find($id);

        if (empty($manga)) {
            Flash::error('Manga not found');

            return redirect(route('mangas.index'));
        }

        return view('mangas.show')->with('manga', $manga);
    }

    /**
     * Show the form for editing the specified Manga.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $manga = $this->mangaRepository->find($id);

        if (empty($manga)) {
            Flash::error('Manga not found');

            return redirect(route('mangas.index'));
        }

        return view('mangas.edit')->with('manga', $manga);
    }

    /**
     * Update the specified Manga in storage.
     *
     * @param int $id
     * @param UpdateMangaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMangaRequest $request)
    {
        $manga = $this->mangaRepository->find($id);

        if (empty($manga)) {
            Flash::error('Manga not found');

            return redirect(route('mangas.index'));
        }

        $manga = $this->mangaRepository->update($request->all(), $id);

        Flash::success('Manga updated successfully.');

        return redirect(route('mangas.index'));
    }

    /**
     * Remove the specified Manga from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $manga = $this->mangaRepository->find($id);

        if (empty($manga)) {
            Flash::error('Manga not found');

            return redirect(route('mangas.index'));
        }

        $this->mangaRepository->delete($id);

        Flash::success('Manga deleted successfully.');

        return redirect(route('mangas.index'));
    }
}
