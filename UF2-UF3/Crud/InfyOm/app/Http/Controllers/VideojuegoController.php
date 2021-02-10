<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVideojuegoRequest;
use App\Http\Requests\UpdateVideojuegoRequest;
use App\Repositories\VideojuegoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class VideojuegoController extends AppBaseController
{
    /** @var  VideojuegoRepository */
    private $videojuegoRepository;

    public function __construct(VideojuegoRepository $videojuegoRepo)
    {
        $this->videojuegoRepository = $videojuegoRepo;
    }

    /**
     * Display a listing of the Videojuego.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $videojuegos = $this->videojuegoRepository->all();

        return view('videojuegos.index')
            ->with('videojuegos', $videojuegos);
    }

    /**
     * Show the form for creating a new Videojuego.
     *
     * @return Response
     */
    public function create()
    {
        return view('videojuegos.create');
    }

    /**
     * Store a newly created Videojuego in storage.
     *
     * @param CreateVideojuegoRequest $request
     *
     * @return Response
     */
    public function store(CreateVideojuegoRequest $request)
    {
        $input = $request->all();

        $videojuego = $this->videojuegoRepository->create($input);

        Flash::success('Videojuego saved successfully.');

        return redirect(route('videojuegos.index'));
    }

    /**
     * Display the specified Videojuego.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $videojuego = $this->videojuegoRepository->find($id);

        if (empty($videojuego)) {
            Flash::error('Videojuego not found');

            return redirect(route('videojuegos.index'));
        }

        return view('videojuegos.show')->with('videojuego', $videojuego);
    }

    /**
     * Show the form for editing the specified Videojuego.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $videojuego = $this->videojuegoRepository->find($id);

        if (empty($videojuego)) {
            Flash::error('Videojuego not found');

            return redirect(route('videojuegos.index'));
        }

        return view('videojuegos.edit')->with('videojuego', $videojuego);
    }

    /**
     * Update the specified Videojuego in storage.
     *
     * @param int $id
     * @param UpdateVideojuegoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVideojuegoRequest $request)
    {
        $videojuego = $this->videojuegoRepository->find($id);

        if (empty($videojuego)) {
            Flash::error('Videojuego not found');

            return redirect(route('videojuegos.index'));
        }

        $videojuego = $this->videojuegoRepository->update($request->all(), $id);

        Flash::success('Videojuego updated successfully.');

        return redirect(route('videojuegos.index'));
    }

    /**
     * Remove the specified Videojuego from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $videojuego = $this->videojuegoRepository->find($id);

        if (empty($videojuego)) {
            Flash::error('Videojuego not found');

            return redirect(route('videojuegos.index'));
        }

        $this->videojuegoRepository->delete($id);

        Flash::success('Videojuego deleted successfully.');

        return redirect(route('videojuegos.index'));
    }
}
