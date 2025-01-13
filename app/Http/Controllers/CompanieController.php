<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanieRequest;
use App\Http\Requests\UpdateCompanieRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Companie;
use Illuminate\Http\Request;
use Flash;
use Response;

class CompanieController extends AppBaseController
{
    /**
     * Display a listing of the Companie.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Companie $companies */
        $companies = Companie::paginate(10);

        return view('companies.index')
            ->with('companies', $companies);
    }

    /**
     * Show the form for creating a new Companie.
     *
     * @return Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created Companie in storage.
     *
     * @param CreateCompanieRequest $request
     *
     * @return Response
     */
    public function store(CreateCompanieRequest $request)
    {
        $input = $request->all();

        /** @var Companie $companie */
        $companie = Companie::create($input);

        Flash::success('Companie saved successfully.');

        return redirect(route('companies.index'));
    }

    /**
     * Display the specified Companie.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Companie $companie */
        $companie = Companie::find($id);

        if (empty($companie)) {
            Flash::error('Companie not found');

            return redirect(route('companies.index'));
        }

        return view('companies.show')->with('companie', $companie);
    }

    /**
     * Show the form for editing the specified Companie.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Companie $companie */
        $companie = Companie::find($id);

        if (empty($companie)) {
            Flash::error('Companie not found');

            return redirect(route('companies.index'));
        }

        return view('companies.edit')->with('companie', $companie);
    }

    /**
     * Update the specified Companie in storage.
     *
     * @param int $id
     * @param UpdateCompanieRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompanieRequest $request)
    {
        /** @var Companie $companie */
        $companie = Companie::find($id);

        if (empty($companie)) {
            Flash::error('Companie not found');

            return redirect(route('companies.index'));
        }

        $companie->fill($request->all());
        $companie->save();

        Flash::success('Companie updated successfully.');

        return redirect(route('companies.index'));
    }

    /**
     * Remove the specified Companie from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Companie $companie */
        $companie = Companie::find($id);

        if (empty($companie)) {
            Flash::error('Companie not found');

            return redirect(route('companies.index'));
        }

        $companie->delete();

        Flash::success('Companie deleted successfully.');

        return redirect(route('companies.index'));
    }
}
