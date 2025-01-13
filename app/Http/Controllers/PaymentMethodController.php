<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Flash;
use Response;

class PaymentMethodController extends AppBaseController
{
    /**
     * Display a listing of the PaymentMethod.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var PaymentMethod $paymentMethods */
        $paymentMethods = PaymentMethod::orderBy('id', 'DESC')->paginate(10);

        return view('payment_methods.index')
            ->with('paymentMethods', $paymentMethods);
    }

    /**
     * Show the form for creating a new PaymentMethod.
     *
     * @return Response
     */
    public function create()
    {
        return view('payment_methods.create');
    }

    /**
     * Store a newly created PaymentMethod in storage.
     *
     * @param CreatePaymentMethodRequest $request
     *
     * @return Response
     */
    public function store(CreatePaymentMethodRequest $request)
    {
        $input = $request->all();

        /** @var PaymentMethod $paymentMethod */
        $paymentMethod = PaymentMethod::create($input);

        Flash::success('Payment Method saved successfully.');

        return redirect(route('paymentMethods.index'));
    }

    /**
     * Display the specified PaymentMethod.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PaymentMethod $paymentMethod */
        $paymentMethod = PaymentMethod::find($id);

        if (empty($paymentMethod)) {
            Flash::error('Payment Method not found');

            return redirect(route('paymentMethods.index'));
        }

        return view('payment_methods.show')->with('paymentMethod', $paymentMethod);
    }

    /**
     * Show the form for editing the specified PaymentMethod.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var PaymentMethod $paymentMethod */
        $paymentMethod = PaymentMethod::find($id);

        if (empty($paymentMethod)) {
            Flash::error('Payment Method not found');

            return redirect(route('paymentMethods.index'));
        }

        return view('payment_methods.edit')->with('paymentMethod', $paymentMethod);
    }

    /**
     * Update the specified PaymentMethod in storage.
     *
     * @param int $id
     * @param UpdatePaymentMethodRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaymentMethodRequest $request)
    {
        /** @var PaymentMethod $paymentMethod */
        $paymentMethod = PaymentMethod::find($id);

        if (empty($paymentMethod)) {
            Flash::error('Payment Method not found');

            return redirect(route('paymentMethods.index'));
        }

        $paymentMethod->fill($request->all());
        $paymentMethod->save();

        Flash::success('Payment Method updated successfully.');

        return redirect(route('paymentMethods.index'));
    }

    /**
     * Remove the specified PaymentMethod from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PaymentMethod $paymentMethod */
        $paymentMethod = PaymentMethod::find($id);

        if (empty($paymentMethod)) {
            Flash::error('Payment Method not found');

            return redirect(route('paymentMethods.index'));
        }

        $paymentMethod->delete();

        Flash::success('Payment Method deleted successfully.');

        return redirect(route('paymentMethods.index'));
    }
}
