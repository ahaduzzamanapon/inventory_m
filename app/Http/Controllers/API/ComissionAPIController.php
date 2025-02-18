<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateComissionAPIRequest;
use App\Http\Requests\API\UpdateComissionAPIRequest;
use App\Models\Comission;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ComissionResource;
use Response;

/**
 * Class ComissionController
 * @package App\Http\Controllers\API
 */

class ComissionAPIController extends AppBaseController
{
    /**
     * Display a listing of the Comission.
     * GET|HEAD /comissions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Comission::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $comissions = $query->get();

        return $this->sendResponse(ComissionResource::collection($comissions), 'Comissions retrieved successfully');
    }

    /**
     * Store a newly created Comission in storage.
     * POST /comissions
     *
     * @param CreateComissionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateComissionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Comission $comission */
        $comission = Comission::create($input);

        return $this->sendResponse(new ComissionResource($comission), 'Comission saved successfully');
    }

    /**
     * Display the specified Comission.
     * GET|HEAD /comissions/{id}
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
            return $this->sendError('Comission not found');
        }

        return $this->sendResponse(new ComissionResource($comission), 'Comission retrieved successfully');
    }

    /**
     * Update the specified Comission in storage.
     * PUT/PATCH /comissions/{id}
     *
     * @param int $id
     * @param UpdateComissionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateComissionAPIRequest $request)
    {
        /** @var Comission $comission */
        $comission = Comission::find($id);

        if (empty($comission)) {
            return $this->sendError('Comission not found');
        }

        $comission->fill($request->all());
        $comission->save();

        return $this->sendResponse(new ComissionResource($comission), 'Comission updated successfully');
    }

    /**
     * Remove the specified Comission from storage.
     * DELETE /comissions/{id}
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
            return $this->sendError('Comission not found');
        }

        $comission->delete();

        return $this->sendSuccess('Comission deleted successfully');
    }
}
