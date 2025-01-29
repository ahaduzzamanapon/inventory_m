<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBonusRequest;
use App\Http\Requests\UpdateBonusRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Bonus;
use Illuminate\Http\Request;
use Flash;
use Response;

class BonusController extends AppBaseController
{
    /**
     * Display a listing of the Bonus.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Bonus $bonuses */
        $bonuses = Bonus::paginate(10);

        return view('bonuses.index')
            ->with('bonuses', $bonuses);
    }

    /**
     * Show the form for creating a new Bonus.
     *
     * @return Response
     */
    public function create()
    {
        return view('bonuses.create');
    }

    /**
     * Store a newly created Bonus in storage.
     *
     * @param CreateBonusRequest $request
     *
     * @return Response
     */
    public function store(CreateBonusRequest $request)
    {
        $input = $request->all();

        /** @var Bonus $bonus */
        $bonus = Bonus::create($input);

        Flash::success('Bonus saved successfully.');

        return redirect(route('bonuses.index'));
    }

    /**
     * Display the specified Bonus.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Bonus $bonus */
        $bonus = Bonus::find($id);

        if (empty($bonus)) {
            Flash::error('Bonus not found');

            return redirect(route('bonuses.index'));
        }

        return view('bonuses.show')->with('bonus', $bonus);
    }

    /**
     * Show the form for editing the specified Bonus.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Bonus $bonus */
        $bonus = Bonus::find($id);

        if (empty($bonus)) {
            Flash::error('Bonus not found');

            return redirect(route('bonuses.index'));
        }

        return view('bonuses.edit')->with('bonus', $bonus);
    }

    /**
     * Update the specified Bonus in storage.
     *
     * @param int $id
     * @param UpdateBonusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBonusRequest $request)
    {
        /** @var Bonus $bonus */
        $bonus = Bonus::find($id);

        if (empty($bonus)) {
            Flash::error('Bonus not found');

            return redirect(route('bonuses.index'));
        }

        $bonus->fill($request->all());
        $bonus->save();

        Flash::success('Bonus updated successfully.');

        return redirect(route('bonuses.index'));
    }

    /**
     * Remove the specified Bonus from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Bonus $bonus */
        $bonus = Bonus::find($id);

        if (empty($bonus)) {
            Flash::error('Bonus not found');

            return redirect(route('bonuses.index'));
        }

        $bonus->delete();

        Flash::success('Bonus deleted successfully.');

        return redirect(route('bonuses.index'));
    }
}
