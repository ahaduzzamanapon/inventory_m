<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLogisticBillRequest;
use App\Http\Requests\UpdateLogisticBillRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\LogisticBill;
use Illuminate\Http\Request;
use Flash;
use Response;

class LogisticBillController extends AppBaseController
{
    /**
     * Display a listing of the LogisticBill.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var LogisticBill $logisticBills */
        $logisticBills = LogisticBill::paginate(10);

        return view('logistic_bills.index')
            ->with('logisticBills', $logisticBills);
    }

    /**
     * Show the form for creating a new LogisticBill.
     *
     * @return Response
     */
    public function create()
    {
        return view('logistic_bills.create');
    }

    /**
     * Store a newly created LogisticBill in storage.
     *
     * @param CreateLogisticBillRequest $request
     *
     * @return Response
     */
    public function store(CreateLogisticBillRequest $request)
    {
        $input = $request->all();

        /** @var LogisticBill $logisticBill */
        $logisticBill = LogisticBill::create($input);

        Flash::success('Logistic Bill saved successfully.');

        return redirect(route('logisticBills.index'));
    }

    /**
     * Display the specified LogisticBill.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var LogisticBill $logisticBill */
        $logisticBill = LogisticBill::find($id);

        if (empty($logisticBill)) {
            Flash::error('Logistic Bill not found');

            return redirect(route('logisticBills.index'));
        }

        return view('logistic_bills.show')->with('logisticBill', $logisticBill);
    }

    /**
     * Show the form for editing the specified LogisticBill.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var LogisticBill $logisticBill */
        $logisticBill = LogisticBill::find($id);

        if (empty($logisticBill)) {
            Flash::error('Logistic Bill not found');

            return redirect(route('logisticBills.index'));
        }

        return view('logistic_bills.edit')->with('logisticBill', $logisticBill);
    }

    /**
     * Update the specified LogisticBill in storage.
     *
     * @param int $id
     * @param UpdateLogisticBillRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLogisticBillRequest $request)
    {
        /** @var LogisticBill $logisticBill */
        $logisticBill = LogisticBill::find($id);

        if (empty($logisticBill)) {
            Flash::error('Logistic Bill not found');

            return redirect(route('logisticBills.index'));
        }

        $logisticBill->fill($request->all());
        $logisticBill->save();

        Flash::success('Logistic Bill updated successfully.');

        return redirect(route('logisticBills.index'));
    }

    /**
     * Remove the specified LogisticBill from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var LogisticBill $logisticBill */
        $logisticBill = LogisticBill::find($id);

        if (empty($logisticBill)) {
            Flash::error('Logistic Bill not found');

            return redirect(route('logisticBills.index'));
        }

        $logisticBill->delete();

        Flash::success('Logistic Bill deleted successfully.');

        return redirect(route('logisticBills.index'));
    }
}
