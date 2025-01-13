<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePettyCashAPIRequest;
use App\Http\Requests\API\UpdatePettyCashAPIRequest;
use App\Models\PettyCash;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PettyCashResource;
use Response;

/**
 * Class PettyCashController
 * @package App\Http\Controllers\API
 */

class PettyCashAPIController extends AppBaseController
{
    /**
     * Display a listing of the PettyCash.
     * GET|HEAD /pettyCashes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = PettyCash::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $pettyCashes = $query->get();

        return $this->sendResponse(PettyCashResource::collection($pettyCashes), 'Petty Cash retrieved successfully');
    }

    /**
     * Store a newly created PettyCash in storage.
     * POST /pettyCashes
     *
     * @param CreatePettyCashAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePettyCashAPIRequest $request)
    {
        $input = $request->all();

        /** @var PettyCash $pettyCash */
        $pettyCash = PettyCash::create($input);

        return $this->sendResponse(new PettyCashResource($pettyCash), 'Petty Cash saved successfully');
    }

    /**
     * Display the specified PettyCash.
     * GET|HEAD /pettyCashes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PettyCash $pettyCash */
        $pettyCash = PettyCash::find($id);

        if (empty($pettyCash)) {
            return $this->sendError('Petty Cash not found');
        }

        return $this->sendResponse(new PettyCashResource($pettyCash), 'Petty Cash retrieved successfully');
    }

    /**
     * Update the specified PettyCash in storage.
     * PUT/PATCH /pettyCashes/{id}
     *
     * @param int $id
     * @param UpdatePettyCashAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePettyCashAPIRequest $request)
    {
        /** @var PettyCash $pettyCash */
        $pettyCash = PettyCash::find($id);

        if (empty($pettyCash)) {
            return $this->sendError('Petty Cash not found');
        }

        $pettyCash->fill($request->all());
        $pettyCash->save();

        return $this->sendResponse(new PettyCashResource($pettyCash), 'PettyCash updated successfully');
    }

    /**
     * Remove the specified PettyCash from storage.
     * DELETE /pettyCashes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PettyCash $pettyCash */
        $pettyCash = PettyCash::find($id);

        if (empty($pettyCash)) {
            return $this->sendError('Petty Cash not found');
        }

        $pettyCash->delete();

        return $this->sendSuccess('Petty Cash deleted successfully');
    }
}
