<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateComissionRequest;
use App\Http\Requests\UpdateComissionRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Comission;
use Illuminate\Http\Request;
use Flash;
use Response;

class ComissionController extends AppBaseController
{
    /**
     * Display a listing of the Comission.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Comission $comissions */
        $comissions = Comission::leftJoin('users', 'comissions.employee', '=', 'users.id')
            ->leftJoin('customers', 'comissions.customer', '=', 'customers.id')
            ->select('comissions.*', 'users.name as employee_name', 'customers.customer_name')
            ->paginate(10);

        return view('comissions.index')
            ->with('comissions', $comissions);
    }

    /**
     * Show the form for creating a new Comission.
     *
     * @return Response
     */
    public function create()
    {
        return view('comissions.create');
    }

    /**
     * Store a newly created Comission in storage.
     *
     * @param CreateComissionRequest $request
     *
     * @return Response
     */
    public function store(CreateComissionRequest $request)
    {
        $input = $request->all();

        /** @var Comission $comission */
        $comission = Comission::create($input);

        Flash::success('Comission saved successfully.');

        return redirect(route('comissions.index'));
    }

    /**
     * Display the specified Comission.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Comission $comission */
        $comission = Comission::find($id);

        if (empty($comission)) {
            Flash::error('Comission not found');

            return redirect(route('comissions.index'));
        }

        return view('comissions.show')->with('comission', $comission);
    }

    /**
     * Show the form for editing the specified Comission.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Comission $comission */
        $comission = Comission::find($id);

        if (empty($comission)) {
            Flash::error('Comission not found');

            return redirect(route('comissions.index'));
        }

        return view('comissions.edit')->with('comission', $comission);
    }

    /**
     * Update the specified Comission in storage.
     *
     * @param int $id
     * @param UpdateComissionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateComissionRequest $request)
    {
        /** @var Comission $comission */
        $comission = Comission::find($id);

        if (empty($comission)) {
            Flash::error('Comission not found');

            return redirect(route('comissions.index'));
        }

        $comission->fill($request->all());
        $comission->save();

        Flash::success('Comission updated successfully.');

        return redirect(route('comissions.index'));
    }

    /**
     * Remove the specified Comission from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Comission $comission */
        $comission = Comission::find($id);

        if (empty($comission)) {
            Flash::error('Comission not found');

            return redirect(route('comissions.index'));
        }

        $comission->delete();

        Flash::success('Comission deleted successfully.');

        return redirect(route('comissions.index'));
    }
}
