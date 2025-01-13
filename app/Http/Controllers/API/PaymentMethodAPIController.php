<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePaymentMethodAPIRequest;
use App\Http\Requests\API\UpdatePaymentMethodAPIRequest;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PaymentMethodResource;
use Response;

/**
 * Class PaymentMethodController
 * @package App\Http\Controllers\API
 */

class PaymentMethodAPIController extends AppBaseController
{
    /**
     * Display a listing of the PaymentMethod.
     * GET|HEAD /paymentMethods
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = PaymentMethod::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $paymentMethods = $query->get();

        return $this->sendResponse(PaymentMethodResource::collection($paymentMethods), 'Payment Methods retrieved successfully');
    }

    /**
     * Store a newly created PaymentMethod in storage.
     * POST /paymentMethods
     *
     * @param CreatePaymentMethodAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePaymentMethodAPIRequest $request)
    {
        $input = $request->all();

        /** @var PaymentMethod $paymentMethod */
        $paymentMethod = PaymentMethod::create($input);

        return $this->sendResponse(new PaymentMethodResource($paymentMethod), 'Payment Method saved successfully');
    }

    /**
     * Display the specified PaymentMethod.
     * GET|HEAD /paymentMethods/{id}
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
            return $this->sendError('Payment Method not found');
        }

        return $this->sendResponse(new PaymentMethodResource($paymentMethod), 'Payment Method retrieved successfully');
    }

    /**
     * Update the specified PaymentMethod in storage.
     * PUT/PATCH /paymentMethods/{id}
     *
     * @param int $id
     * @param UpdatePaymentMethodAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaymentMethodAPIRequest $request)
    {
        /** @var PaymentMethod $paymentMethod */
        $paymentMethod = PaymentMethod::find($id);

        if (empty($paymentMethod)) {
            return $this->sendError('Payment Method not found');
        }

        $paymentMethod->fill($request->all());
        $paymentMethod->save();

        return $this->sendResponse(new PaymentMethodResource($paymentMethod), 'PaymentMethod updated successfully');
    }

    /**
     * Remove the specified PaymentMethod from storage.
     * DELETE /paymentMethods/{id}
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
            return $this->sendError('Payment Method not found');
        }

        $paymentMethod->delete();

        return $this->sendSuccess('Payment Method deleted successfully');
    }
}
