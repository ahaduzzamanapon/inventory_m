<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parties = Party::all();
        return view('ledger.parties.index', compact('parties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ledger.parties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:customer,supplier,both',
            'opening_balance' => 'nullable|numeric',
            'image' => 'nullable|image',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $folder = 'images/party/image';
            $customName = 'image-'.time();
            $data['image'] = uploadFile($file, $folder, $customName);
        }

        Party::create($data);

        return redirect()->route('parties.index')->with('success', 'Party created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Party $party)
    {
        $transactions = $party->ledger_transactions;
        return view('ledger.parties.show', compact('party', 'transactions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Party $party)
    {
        return view('ledger.parties.edit', compact('party'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Party $party)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:customer,supplier,both',
            'opening_balance' => 'nullable|numeric',
            'image' => 'nullable|image',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip' => 'nullable|string',
        ]);

        $data = $request->all();

       
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $folder = 'images/party/image';
            $customName = 'image-'.time();
            $data['image'] = uploadFile($file, $folder, $customName);
        }


        $party->update($data);

        return redirect()->route('parties.index')->with('success', 'Party updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Party $party)
    {
        $party->delete();

        return redirect()->route('parties.index')->with('success', 'Party deleted successfully.');
    }
}
