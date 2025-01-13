<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Location;
use Illuminate\Http\Request;
use Flash;
use Response;

class LocationController extends AppBaseController
{
    /**
     * Display a listing of the Location.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Location $locations */
        $locations = Location::orderBy('id', 'desc')->paginate(10);

        return view('locations.index')
            ->with('locations', $locations);
    }

    /**
     * Show the form for creating a new Location.
     *
     * @return Response
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created Location in storage.
     *
     * @param CreateLocationRequest $request
     *
     * @return Response
     */
    public function store(CreateLocationRequest $request)
    {
        $input = $request->all();

        /** @var Location $location */
        $location = Location::create($input);

        Flash::success('Location saved successfully.');

        return redirect(route('locations.index'));
    }

    /**
     * Display the specified Location.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Location $location */
        $location = Location::find($id);

        if (empty($location)) {
            Flash::error('Location not found');

            return redirect(route('locations.index'));
        }

        return view('locations.show')->with('location', $location);
    }

    /**
     * Show the form for editing the specified Location.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Location $location */
        $location = Location::find($id);

        if (empty($location)) {
            Flash::error('Location not found');

            return redirect(route('locations.index'));
        }

        return view('locations.edit')->with('location', $location);
    }

    /**
     * Update the specified Location in storage.
     *
     * @param int $id
     * @param UpdateLocationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLocationRequest $request)
    {
        /** @var Location $location */
        $location = Location::find($id);

        if (empty($location)) {
            Flash::error('Location not found');

            return redirect(route('locations.index'));
        }

        $location->fill($request->all());
        $location->save();

        Flash::success('Location updated successfully.');

        return redirect(route('locations.index'));
    }

    /**
     * Remove the specified Location from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Location $location */
        $location = Location::find($id);

        if (empty($location)) {
            Flash::error('Location not found');

            return redirect(route('locations.index'));
        }

        $location->delete();

        Flash::success('Location deleted successfully.');

        return redirect(route('locations.index'));
    }
}
