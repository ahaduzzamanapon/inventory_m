<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLogisticBillRequest;
use App\Http\Requests\UpdateLogisticBillRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\LogisticBill;
use App\Models\PettyCash;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\AdvancedCash;
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
        $logisticBills = LogisticBill::leftJoin('customers', 'logistic_bills.customer', '=', 'customers.id')
            ->select('logistic_bills.*', 'customers.customer_name')
            ->paginate(10);

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


        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $folder = 'images/attachment';
            $customName = 'attachment-'.time();
            $input['attachment'] = uploadFile($file, $folder, $customName);
        }else{
            $input['attachment'] = '';
        }
        if($input['customer'] == null || $input['customer'] == ''){
            $input['Sale'] = null;
        }
        if($input['source_of_payment'] == 'Advance'){
            $input['own_cash_amount'] = null;
        }else{
            $input['advance_id'] = null;
        }







        /** @var LogisticBill $logisticBill */
        $logisticBill = LogisticBill::create($input);

        if($input['status'] == 'Approved' && $input['source_of_payment'] == 'Advance'){
            $AdvancedCash = AdvancedCash::find($input['advance_id']);
            if (empty($AdvancedCash)) {
                Flash::error('Advanced Cash not found');
                return redirect()->back();
            }
            $AdvancedCash->settled_status = 'Approved';
            $AdvancedCash->settled_amount =$AdvancedCash->amount - $input['amount'];
            $AdvancedCash->save();
            if($input['settled_status'] == 'Settled'){
                $pettycash = PettyCash::create([
                    'date' => date('Y-m-d'),
                    'account_ledgers' => 3,
                    'account_description' => 'Credit',
                    'amount' =>$AdvancedCash->amount - $input['settled_amount'],
                    'status' => 'Approved',
                ]);
            }
        }


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
        //dd($logisticBill);

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

        $input = $request->all();


        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $folder = 'images/attachment';
            $customName = 'attachment-'.time();
            $input['attachment'] = uploadFile($file, $folder, $customName);
        }else{
            $input['attachment'] = '';
        }
        if($input['customer'] == null || $input['customer'] == ''){
            $input['Sale'] = null;
        }
        if($input['source_of_payment'] == 'Advance'){
            $input['own_cash_amount'] = null;
        }else{
            $input['advance_id'] = null;
        }
        /** @var LogisticBill $logisticBill */
        $logisticBill->fill($input);
        if($input['status'] == 'Approved' && $input['source_of_payment'] == 'Advance'){

            $AdvancedCash = AdvancedCash::find($input['advance_id']);
            if (empty($AdvancedCash)) {
                Flash::error('Advanced Cash not found');
                return redirect()->back();
            }
            $AdvancedCash->settled_status = 'settled';
            $AdvancedCash->settled_amount =$input['amount'];
            $AdvancedCash->save();
                $pettycash = PettyCash::create([
                    'date' => date('Y-m-d'),
                    'account_ledgers' => 3,
                    'account_description' => 'Credit',
                    'amount' =>$AdvancedCash->amount - $AdvancedCash->settled_amount,
                    'status' => 'Approved',
                ]);

        }
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
