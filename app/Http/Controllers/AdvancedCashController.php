<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdvancedCashRequest;
use App\Http\Requests\UpdateAdvancedCashRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\AdvancedCash;
use App\Models\PettyCash;
use Illuminate\Http\Request;
use Flash;
use Response;

class AdvancedCashController extends AppBaseController
{
    /**
     * Display a listing of the AdvancedCash.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var AdvancedCash $advancedCashes */
        $advancedCashes = AdvancedCash::select('advanced_cash.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', '=', 'advanced_cash.member_id')
            ->paginate(10);

        return view('advanced_cashes.index')
            ->with('advancedCashes', $advancedCashes);
    }

    /**
     * Show the form for creating a new AdvancedCash.
     *
     * @return Response
     */
    public function create()
    {
        return view('advanced_cashes.create');
    }

    /**
     * Store a newly created AdvancedCash in storage.
     *
     * @param CreateAdvancedCashRequest $request
     *
     * @return Response
     */
    public function store(CreateAdvancedCashRequest $request)
    {
        $input = $request->all();
        /** @var AdvancedCash $advancedCash */
        $advancedCash = AdvancedCash::create($input);
        $pettycash = PettyCash::create([
            'date' => date('Y-m-d'),
            'account_ledgers' => 2,
            'account_description' => 'Debit',
            'amount' => $input['amount'],
            'status' => 'Approved',
        ]);

        if($input['settled_status'] == 'Settled'){
            $pettycash = PettyCash::create([
                'date' => date('Y-m-d'),
                'account_ledgers' => 3,
                'account_description' => 'Credit',
                'amount' => $input['settled_amount'],
                'status' => 'Approved',
            ]);
        }


        Flash::success('Advanced Cash saved successfully.');
        return redirect(route('advancedCashes.index'));
    }

    /**
     * Display the specified AdvancedCash.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var AdvancedCash $advancedCash */
        $advancedCash = AdvancedCash::find($id);

        if (empty($advancedCash)) {
            Flash::error('Advanced Cash not found');

            return redirect(route('advancedCashes.index'));
        }

        return view('advanced_cashes.show')->with('advancedCash', $advancedCash);
    }

    /**
     * Show the form for editing the specified AdvancedCash.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var AdvancedCash $advancedCash */
        $advancedCash = AdvancedCash::find($id);

        if (empty($advancedCash)) {
            Flash::error('Advanced Cash not found');

            return redirect(route('advancedCashes.index'));
        }

        return view('advanced_cashes.edit')->with('advancedCash', $advancedCash);
    }

    /**
     * Update the specified AdvancedCash in storage.
     *
     * @param int $id
     * @param UpdateAdvancedCashRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdvancedCashRequest $request)
    {
        /** @var AdvancedCash $advancedCash */
        $advancedCash = AdvancedCash::find($id);

        if (empty($advancedCash)) {
            Flash::error('Advanced Cash not found');

            return redirect(route('advancedCashes.index'));
        }

        $advancedCash->fill($request->all());
        $advancedCash->save();

        $input = $request->all();
        //dd($input);

        if($input['settled_status'] == 'Settled'){
            $pettycash = PettyCash::create([
                'date' => date('Y-m-d'),
                'account_ledgers' => 3,
                'account_description' => 'Credit',
                'amount' => $input['settled_amount'],
                'status' => 'Approved',
            ]);
        }
        Flash::success('Advanced Cash updated successfully.');
        return redirect(route('advancedCashes.index'));
    }

    /**
     * Remove the specified AdvancedCash from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var AdvancedCash $advancedCash */
        $advancedCash = AdvancedCash::find($id);

        if (empty($advancedCash)) {
            Flash::error('Advanced Cash not found');

            return redirect(route('advancedCashes.index'));
        }

        $advancedCash->delete();

        Flash::success('Advanced Cash deleted successfully.');

        return redirect(route('advancedCashes.index'));
    }


}
