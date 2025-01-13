<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePettyCashRequest;
use App\Http\Requests\UpdatePettyCashRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\PettyCash;
use Illuminate\Http\Request;
use Flash;
use Response;

class PettyCashController extends AppBaseController
{
    /**
     * Display a listing of the PettyCash.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var PettyCash $pettyCashes */
        $pettyCashes = PettyCash::select('pettycash.*', 'accountledgers.name as account_ledger_name')
            ->join('accountledgers', 'pettycash.account_ledgers', '=', 'accountledgers.id')
            ->orderBy('pettycash.id', 'DESC')
            ->get();

        return view('petty_cashes.index')
            ->with('pettyCashes', $pettyCashes);
    }

    /**
     * Show the form for creating a new PettyCash.
     *
     * @return Response
     */
    public function create()
    {
        return view('petty_cashes.create');
    }

    /**
     * Store a newly created PettyCash in storage.
     *
     * @param CreatePettyCashRequest $request
     *
     * @return Response
     */
    public function store(CreatePettyCashRequest $request)
    {
        $input = $request->all();
        if ($request->hasFile('attachment')) {
            $path = storage_path('app/public/images/attachment');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0775, true, true);
            }
            $file = $request->file('attachment');
            $input['attachment'] = $file->store('images/attachment', 'public');
        }else{
            $input['attachment'] = null;
        }


        /** @var PettyCash $pettyCash */
        $pettyCash = PettyCash::create($input);

        Flash::success('Petty Cash saved successfully.');

        return redirect(route('pettyCashes.index'));
    }

    /**
     * Display the specified PettyCash.
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
            Flash::error('Petty Cash not found');

            return redirect(route('pettyCashes.index'));
        }

        return view('petty_cashes.show')->with('pettyCash', $pettyCash);
    }

    /**
     * Show the form for editing the specified PettyCash.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var PettyCash $pettyCash */
        $pettyCash = PettyCash::find($id);

        if (empty($pettyCash)) {
            Flash::error('Petty Cash not found');

            return redirect(route('pettyCashes.index'));
        }

        return view('petty_cashes.edit')->with('pettyCash', $pettyCash);
    }

    /**
     * Update the specified PettyCash in storage.
     *
     * @param int $id
     * @param UpdatePettyCashRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePettyCashRequest $request)
    {
        /** @var PettyCash $pettyCash */
        $pettyCash = PettyCash::find($id);

        if (empty($pettyCash)) {
            Flash::error('Petty Cash not found');

            return redirect(route('pettyCashes.index'));
        }

        $input = $request->all();
        if ($request->hasFile('attachment')) {
            $path = storage_path('app/public/images/attachment');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0775, true, true);
            }
            $file = $request->file('attachment');
            $input['attachment'] = $file->store('images/attachment', 'public');
        }else{
            unset($input['attachment']);
        }

        $pettyCash->fill($input);
        $pettyCash->save();

        Flash::success('Petty Cash updated successfully.');

        return redirect(route('pettyCashes.index'));
    }

    /**
     * Remove the specified PettyCash from storage.
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
            Flash::error('Petty Cash not found');

            return redirect(route('pettyCashes.index'));
        }

        $pettyCash->delete();

        Flash::success('Petty Cash deleted successfully.');

        return redirect(route('pettyCashes.index'));
    }
}
