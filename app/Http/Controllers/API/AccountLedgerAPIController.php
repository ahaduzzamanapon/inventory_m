<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAccountLedgerAPIRequest;
use App\Http\Requests\API\UpdateAccountLedgerAPIRequest;
use App\Models\AccountLedger;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AccountLedgerResource;
use Response;

/**
 * Class AccountLedgerController
 * @package App\Http\Controllers\API
 */

class AccountLedgerAPIController extends AppBaseController
{
    /**
     * Display a listing of the AccountLedger.
     * GET|HEAD /accountLedgers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = AccountLedger::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $accountLedgers = $query->get();

        return $this->sendResponse(AccountLedgerResource::collection($accountLedgers), 'Account Ledgers retrieved successfully');
    }

    /**
     * Store a newly created AccountLedger in storage.
     * POST /accountLedgers
     *
     * @param CreateAccountLedgerAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountLedgerAPIRequest $request)
    {
        $input = $request->all();

        /** @var AccountLedger $accountLedger */
        $accountLedger = AccountLedger::create($input);

        return $this->sendResponse(new AccountLedgerResource($accountLedger), 'Account Ledger saved successfully');
    }

    /**
     * Display the specified AccountLedger.
     * GET|HEAD /accountLedgers/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var AccountLedger $accountLedger */
        $accountLedger = AccountLedger::find($id);

        if (empty($accountLedger)) {
            return $this->sendError('Account Ledger not found');
        }

        return $this->sendResponse(new AccountLedgerResource($accountLedger), 'Account Ledger retrieved successfully');
    }

    /**
     * Update the specified AccountLedger in storage.
     * PUT/PATCH /accountLedgers/{id}
     *
     * @param int $id
     * @param UpdateAccountLedgerAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountLedgerAPIRequest $request)
    {
        /** @var AccountLedger $accountLedger */
        $accountLedger = AccountLedger::find($id);

        if (empty($accountLedger)) {
            return $this->sendError('Account Ledger not found');
        }

        $accountLedger->fill($request->all());
        $accountLedger->save();

        return $this->sendResponse(new AccountLedgerResource($accountLedger), 'AccountLedger updated successfully');
    }

    /**
     * Remove the specified AccountLedger from storage.
     * DELETE /accountLedgers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var AccountLedger $accountLedger */
        $accountLedger = AccountLedger::find($id);

        if (empty($accountLedger)) {
            return $this->sendError('Account Ledger not found');
        }

        $accountLedger->delete();

        return $this->sendSuccess('Account Ledger deleted successfully');
    }
}
