<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCocheRequest;
use App\Http\Requests\UpdateCocheRequest;
use App\Repositories\CocheRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CocheController extends AppBaseController
{
    /** @var  CocheRepository */
    private $cocheRepository;

    public function __construct(CocheRepository $cocheRepo)
    {
        $this->cocheRepository = $cocheRepo;
    }

    /**
     * Display a listing of the Coche.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $coches = $this->cocheRepository->all();

        return view('coches.index')
            ->with('coches', $coches);
    }

    /**
     * Show the form for creating a new Coche.
     *
     * @return Response
     */
    public function create()
    {
        return view('coches.create');
    }

    /**
     * Store a newly created Coche in storage.
     *
     * @param CreateCocheRequest $request
     *
     * @return Response
     */
    public function store(CreateCocheRequest $request)
    {
        $input = $request->all();

        $coche = $this->cocheRepository->create($input);

        Flash::success('Coche saved successfully.');

        return redirect(route('coches.index'));
    }

    /**
     * Display the specified Coche.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $coche = $this->cocheRepository->find($id);

        if (empty($coche)) {
            Flash::error('Coche not found');

            return redirect(route('coches.index'));
        }

        return view('coches.show')->with('coche', $coche);
    }

    /**
     * Show the form for editing the specified Coche.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $coche = $this->cocheRepository->find($id);

        if (empty($coche)) {
            Flash::error('Coche not found');

            return redirect(route('coches.index'));
        }

        return view('coches.edit')->with('coche', $coche);
    }

    /**
     * Update the specified Coche in storage.
     *
     * @param int $id
     * @param UpdateCocheRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCocheRequest $request)
    {
        $coche = $this->cocheRepository->find($id);

        if (empty($coche)) {
            Flash::error('Coche not found');

            return redirect(route('coches.index'));
        }

        $coche = $this->cocheRepository->update($request->all(), $id);

        Flash::success('Coche updated successfully.');

        return redirect(route('coches.index'));
    }

    /**
     * Remove the specified Coche from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $coche = $this->cocheRepository->find($id);

        if (empty($coche)) {
            Flash::error('Coche not found');

            return redirect(route('coches.index'));
        }

        $this->cocheRepository->delete($id);

        Flash::success('Coche deleted successfully.');

        return redirect(route('coches.index'));
    }
}
