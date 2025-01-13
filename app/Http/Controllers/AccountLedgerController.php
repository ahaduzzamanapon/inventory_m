<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountLedgerRequest;
use App\Http\Requests\UpdateAccountLedgerRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\AccountLedger;
use Illuminate\Http\Request;
use Flash;
use Response;

class AccountLedgerController extends AppBaseController
{
    /**
     * Display a listing of the AccountLedger.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var AccountLedger $accountLedgers */
        $accountLedgers = AccountLedger::orderBy('id', 'DESC')->get();

        return view('account_ledgers.index')
            ->with('accountLedgers', $accountLedgers);
    }

    /**
     * Show the form for creating a new AccountLedger.
     *
     * @return Response
     */
    public function create()
    {
        return view('account_ledgers.create');
    }

    /**
     * Store a newly created AccountLedger in storage.
     *
     * @param CreateAccountLedgerRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountLedgerRequest $request)
    {
        $input = $request->all();

        /** @var AccountLedger $accountLedger */
        $accountLedger = AccountLedger::create($input);

        Flash::success('Account Ledger saved successfully.');

        return redirect(route('accountLedgers.index'));
    }

    /**
     * Display the specified AccountLedger.
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
            Flash::error('Account Ledger not found');

            return redirect(route('accountLedgers.index'));
        }

        return view('account_ledgers.show')->with('accountLedger', $accountLedger);
    }

    /**
     * Show the form for editing the specified AccountLedger.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var AccountLedger $accountLedger */
        $accountLedger = AccountLedger::find($id);

        if (empty($accountLedger)) {
            Flash::error('Account Ledger not found');

            return redirect(route('accountLedgers.index'));
        }

        return view('account_ledgers.edit')->with('accountLedger', $accountLedger);
    }

    /**
     * Update the specified AccountLedger in storage.
     *
     * @param int $id
     * @param UpdateAccountLedgerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountLedgerRequest $request)
    {
        /** @var AccountLedger $accountLedger */
        $accountLedger = AccountLedger::find($id);

        if (empty($accountLedger)) {
            Flash::error('Account Ledger not found');

            return redirect(route('accountLedgers.index'));
        }

        $accountLedger->fill($request->all());
        $accountLedger->save();

        Flash::success('Account Ledger updated successfully.');

        return redirect(route('accountLedgers.index'));
    }

    /**
     * Remove the specified AccountLedger from storage.
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
            Flash::error('Account Ledger not found');

            return redirect(route('accountLedgers.index'));
        }

        $accountLedger->delete();

        Flash::success('Account Ledger deleted successfully.');

        return redirect(route('accountLedgers.index'));
    }
}
