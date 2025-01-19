<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTermAndConditionRequest;
use App\Http\Requests\UpdateTermAndConditionRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\TermAndCondition;
use Illuminate\Http\Request;
use Flash;
use Response;

class TermAndConditionController extends AppBaseController
{
    /**
     * Display a listing of the TermAndCondition.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var TermAndCondition $termAndConditions */
        $termAndConditions = TermAndCondition::paginate(10);

        return view('term_and_conditions.index')
            ->with('termAndConditions', $termAndConditions);
    }

    /**
     * Show the form for creating a new TermAndCondition.
     *
     * @return Response
     */
    public function create()
    {
        return view('term_and_conditions.create');
    }

    /**
     * Store a newly created TermAndCondition in storage.
     *
     * @param CreateTermAndConditionRequest $request
     *
     * @return Response
     */
    public function store(CreateTermAndConditionRequest $request)
    {
        $input = $request->all();

        /** @var TermAndCondition $termAndCondition */
        $termAndCondition = TermAndCondition::create($input);

        Flash::success('Term And Condition saved successfully.');

        return redirect(route('termAndConditions.index'));
    }

    /**
     * Display the specified TermAndCondition.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var TermAndCondition $termAndCondition */
        $termAndCondition = TermAndCondition::find($id);

        if (empty($termAndCondition)) {
            Flash::error('Term And Condition not found');

            return redirect(route('termAndConditions.index'));
        }

        return view('term_and_conditions.show')->with('termAndCondition', $termAndCondition);
    }

    /**
     * Show the form for editing the specified TermAndCondition.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var TermAndCondition $termAndCondition */
        $termAndCondition = TermAndCondition::find($id);

        if (empty($termAndCondition)) {
            Flash::error('Term And Condition not found');

            return redirect(route('termAndConditions.index'));
        }

        return view('term_and_conditions.edit')->with('termAndCondition', $termAndCondition);
    }

    /**
     * Update the specified TermAndCondition in storage.
     *
     * @param int $id
     * @param UpdateTermAndConditionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTermAndConditionRequest $request)
    {
        /** @var TermAndCondition $termAndCondition */
        $termAndCondition = TermAndCondition::find($id);

        if (empty($termAndCondition)) {
            Flash::error('Term And Condition not found');

            return redirect(route('termAndConditions.index'));
        }

        $termAndCondition->fill($request->all());
        $termAndCondition->save();

        Flash::success('Term And Condition updated successfully.');

        return redirect(route('termAndConditions.index'));
    }

    /**
     * Remove the specified TermAndCondition from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var TermAndCondition $termAndCondition */
        $termAndCondition = TermAndCondition::find($id);

        if (empty($termAndCondition)) {
            Flash::error('Term And Condition not found');

            return redirect(route('termAndConditions.index'));
        }

        $termAndCondition->delete();

        Flash::success('Term And Condition deleted successfully.');

        return redirect(route('termAndConditions.index'));
    }
}
