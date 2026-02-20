<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Organization;
use App\Models\Customer;
use App\Models\Supplier;
use Laracasts\Flash\Flash;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
        return view('organizations.index', compact('organizations'));
    }

    public function create()
    {
        $customers = Customer::pluck('customer_name', 'id');
        $suppliers = Supplier::pluck('supplier_name', 'id');
        return view('organizations.create', compact('customers', 'suppliers'));
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'opening_balance' => 'nullable|numeric',
            'customer_ids' => 'nullable|array',
            'supplier_ids' => 'nullable|array',
        ]);

        $organization = Organization::create($input);

        if (!empty($input['customer_ids'])) {
            Customer::whereIn('id', $input['customer_ids'])->update(['organization_id' => $organization->id]);
        }

        if (!empty($input['supplier_ids'])) {
            Supplier::whereIn('id', $input['supplier_ids'])->update(['organization_id' => $organization->id]);
        }

        Flash::success('Organization saved successfully.');

        return redirect(route('organizations.index'));
    }

    public function edit($id)
    {
        $organization = Organization::find($id);

        if (empty($organization)) {
            Flash::error('Organization not found');
            return redirect(route('organizations.index'));
        }

        $customers = Customer::pluck('customer_name', 'id');
        $suppliers = Supplier::pluck('supplier_name', 'id');

        $selected_customers = $organization->customers->pluck('id')->toArray();
        $selected_suppliers = $organization->suppliers->pluck('id')->toArray();

        return view('organizations.edit', compact('organization', 'customers', 'suppliers', 'selected_customers', 'selected_suppliers'));
    }

    public function update($id, Request $request)
    {
        $organization = Organization::find($id);

        if (empty($organization)) {
            Flash::error('Organization not found');
            return redirect(route('organizations.index'));
        }

        $input = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'opening_balance' => 'nullable|numeric',
            'customer_ids' => 'nullable|array',
            'supplier_ids' => 'nullable|array',
        ]);

        $organization->update($input);

        // Reset existing links for this org and set new ones
        Customer::where('organization_id', $organization->id)->update(['organization_id' => null]);
        Supplier::where('organization_id', $organization->id)->update(['organization_id' => null]);

        if (!empty($input['customer_ids'])) {
            Customer::whereIn('id', $input['customer_ids'])->update(['organization_id' => $organization->id]);
        }

        if (!empty($input['supplier_ids'])) {
            Supplier::whereIn('id', $input['supplier_ids'])->update(['organization_id' => $organization->id]);
        }

        Flash::success('Organization updated successfully.');

        return redirect(route('organizations.index'));
    }

    public function destroy($id)
    {
        $organization = Organization::find($id);

        if (empty($organization)) {
            Flash::error('Organization not found');
            return redirect(route('organizations.index'));
        }

        $organization->delete();

        Flash::success('Organization deleted successfully.');

        return redirect(route('organizations.index'));
    }
}
