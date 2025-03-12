<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Schema;
use Blueprint;
use App\Models\PurchasModel;
use App\Models\PurchasItemModel;
use App\Models\PurchasPaymentModel;
use App\Models\ItemSerial;
use App\Models\Supplier;
use Flash;
use App\Models\Item;





class PurchasController extends Controller
{
    public function index()
    {
        return redirect()->route('purchas.new_purchas');
    }
    public function newPurchas()
    {
        $suppliers = \App\Models\Supplier::all();
       //dd($suppliers);
        $suppliers_list = [];
        $suppliers_list[''] = 'Select Supplier';
        foreach ($suppliers as $key => $supplier) {
            $suppliers_list[$supplier->id] = $supplier->supplier_name.' ('.$supplier->supplier_phone.')';
        }
        $suppliers = $suppliers_list;

        $items = \App\Models\Item::all();
        $items_list = [];
        $items_list['select'] = 'Select Item';
        foreach ($items as $key => $item) {
            $items_list[$item->id] = $item->item_id.' -> '.$item->item_name.' ('.$item->item_model.')->'.$item->item_purchase_price;
        }


        $items_list2 = [];
        $items_list2['select'] = 'Select Item';
        foreach ($items as $key => $item) {
            $items_list2[$item->id] = $item->item_id.' - '.$item->item_name.' ('.$item->item_model.')';
        }
        $items2 = $items_list2;
        $items = $items_list;
        //dd($items);
        //dd($items2);

        $paymentMethods = \App\Models\PaymentMethod::all();
        $categories = \App\Models\Category::all();
        $subCategories = \App\Models\SubCategory::all();
        return view('purchas.new_purchas', compact('suppliers', 'items','items2', 'paymentMethods', 'categories', 'subCategories'));
    }
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'supplier_id' => 'required|integer',
            'purchas_date' => 'required|date',
            'reference_no' => 'nullable|string',
            'purchas_id' => 'required|string|unique:purchas_models,purchas_id',
            'item_id' => 'required|array',
            'item_name' => 'required|array',
            'quantity' => 'required|array',
            'price' => 'required|array',
            'total_price' => 'required|array',
            'tax_type' => 'required|string',
            'tax_per' => 'nullable|numeric',
            'discount_type' => 'required|string',
            'discount_per' => 'nullable|numeric',
            'sub_total_input' => 'required|numeric',
            'tax_input' => 'nullable|numeric',
            'discount_input' => 'nullable|numeric',
            'grand_total_input' => 'required|numeric',
            'payment_id' => 'nullable|array',
            'payment_method_id' => 'nullable|array',
            'cheque_number' => 'nullable|array',
            'payment_date' => 'nullable|array',
            'payment_amount' => 'nullable|array',
            'serial_number' => 'nullable|array',
            'total_payment' => 'required|numeric',
            'due' => 'required|numeric',
            'purchas_note' => '',
        ]);

        DB::beginTransaction();
        try {
            // Insert into PurchasModel
            $purchas = PurchasModel::create([
                'purchas_id' => $validated['purchas_id'],
                'supplier_id' => $validated['supplier_id'],
                'purchas_date' => $validated['purchas_date'],
                'reference_no' => $validated['reference_no'],
                'sub_total' => $validated['sub_total_input'],
                'discount_status' => $validated['discount_type'],
                'discount_per' => $validated['discount_per'] ?? 0,
                'discount_amount' => $validated['discount_input'] ?? 0,
                'tax_status' => $validated['tax_type'],
                'tax_per' => $validated['tax_per'] ?? 0,
                'tax_amount' => $validated['tax_input'] ?? 0,
                'grand_total' => $validated['grand_total_input'],
                'payment_status' => $validated['due'] == 0 ? 'Paid' : ($validated['due'] < $validated['grand_total_input'] ? 'Partial' : 'Pending'),
                'payment_amount' => $validated['total_payment'],
                'due_amount' => $validated['due'],
                'purchas_note' => $request->input('purchas_note'),
            ]);

            // Insert into PurchasItemModel
            foreach ($validated['item_id'] as $index => $itemId) {
                PurchasItemModel::create([
                    'purchas_id' => $purchas->id,
                    'item_id' => $itemId,
                    'item_name' => $validated['item_name'][$index], // Replace with actual item name if available
                    'item_per_price' => $validated['price'][$index],
                    'purchas_qty' => $validated['quantity'][$index],
                    'total_price' => $validated['total_price'][$index],
                ]);
                Item::where('id', $itemId)->increment('item_qty', $validated['quantity'][$index]);

                if(isset($validated['serial_number'][$itemId])){
                    foreach ($validated['serial_number'][$itemId] as $serial) {
                        if (empty($serial)) {
                            continue;
                        }
                        ItemSerial::create([
                            'item_id' => $itemId,
                            'item_serial_number' => $serial,
                            'sale_status' => 1,
                        ]);
                    }
                }
            }

            // Insert into PurchasPaymentModel
            if (!empty($validated['payment_id'])) {
                foreach ($validated['payment_id'] as $index => $paymentId) {
                    PurchasPaymentModel::create([
                        'payment_id' => $paymentId,
                        'supplier_id' => $validated['supplier_id'],
                        'payment_date' => $validated['payment_date'][$index],
                        'purchas_id' => $purchas->id,
                        'payment_method' => $validated['payment_method_id'][$index],
                        'cheque_number' => $validated['cheque_number'][$index],
                        'payment_amount' => $validated['payment_amount'][$index],
                        'payment_status' => $validated['payment_amount'][$index] >= $validated['grand_total_input'] ? 'Completed' : 'Pending',
                    ]);
                }
            }

            DB::commit();
            session()->flash('success', 'Purchas created successfully.');
            session()->flash('purchas_id', $purchas->id);
            return redirect(route('purchas.purchas_list'));
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    static function purchasList()
    {
        $purchas = PurchasModel::all();
        return view('purchas.purchas_list', compact('purchas'));
    }

    static function show($id){

        $purchas = PurchasModel::find($id);
        if (empty($purchas)) {
            Flash::error('Purchas not found');
            return redirect(route('purchas.purchas_list'));
        }
        $supplier = Supplier::find($purchas->supplier_id);
        $PurchasItem = PurchasItemModel::where('purchas_id', $id)->get();
        $PurchasPayment = PurchasPaymentModel::where('purchas_id', $id)->get();






        return view('purchas.show', compact('purchas', 'PurchasItem', 'PurchasPayment','supplier'));
    }

    static function delete($id){
        DB::beginTransaction();
        $purchas = PurchasModel::find($id);
        if (empty($purchas)) {
            Flash::error('Purchas not found');
            return redirect(route('purchas.purchas_list'));
        }
        $purchas->delete();
        $PurchasItem = PurchasItemModel::where('purchas_id', $id)->get();
        foreach ($PurchasItem as $item) {
            $item->delete();
        }
        $PurchasPayment = PurchasPaymentModel::where('purchas_id', $id)->get();
        foreach ($PurchasPayment as $payment) {
            $payment->delete();
        }
        DB::commit();
        Flash::success('Purchas deleted successfully.');
        return redirect(route('purchas.purchas_list'));
    }

    public function make_payment($id){
        $purchas = PurchasModel::find($id);
        if (empty($purchas)) {
            Flash::error('Purchas not found');
            return redirect(route('purchas.purchas_list'));
        }
        $supplier = Supplier::find($purchas->supplier_id);
        $PurchasItem = PurchasItemModel::where('purchas_id', $id)->get();
        $PurchasPayment = PurchasPaymentModel::where('purchas_id', $id)->get();
        $paymentMethods = \App\Models\PaymentMethod::all();
        return view('purchas.make_payment', compact('purchas', 'PurchasItem', 'PurchasPayment','supplier','paymentMethods'));
    }
    public function make_payment_store(Request $request){
        DB::beginTransaction();
        try {
            $purchas = PurchasModel::find($request->purchas_id);
            $purchas->payment_amount += $request->total_payment;
            $purchas->due_amount = $request->due;
            $purchas->payment_status = $request->due == 0 ? 'Paid' : 'Partial';
            $purchas->save();
            foreach ($request->payment_id as $key => $value) {
                $payment = new PurchasPaymentModel();
                $payment->payment_id = $value;
                $payment->supplier_id = $purchas->supplier_id;
                $payment->payment_method = $request->payment_method_id[$key];
                $payment->cheque_number = isset($request->cheque_number[$key]) ? $request->cheque_number[$key] : 0;
                $payment->payment_date = $request->payment_date[$key];
                $payment->payment_amount = $request->payment_amount[$key];
                $payment->purchas_id = $request->purchas_id;
                $payment->save();
            }
            DB::commit();
            Flash::success('Payment added successfully.');
            return redirect(route('purchas.purchas_list'));
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            Flash::error('Something went wrong while adding payment');
            return redirect(route('purchas.purchas_list'));
        }
    }

    public function invoice($id){
        $purchas = PurchasModel::find($id);
        if (empty($purchas)) {
            Flash::error('Purchas not found');
            return redirect(route('purchas.purchas_list'));
        }
        $supplier = Supplier::find($purchas->supplier_id);
        $PurchasItem = PurchasItemModel::where('purchas_id', $id)->get();
        $PurchasPayment = PurchasPaymentModel::where('purchas_id', $id)->get();
        $siteSettings = \App\Models\SiteSetting::first();
        //dd($purchas,$supplier,$PurchasItem,$PurchasPayment);

        // $purchasAttributes = $purchas->toArray();
        // $supplierAttributes = $supplier->toArray();
        // $purchasItemsAttributes = $PurchasItem->toArray();
        // $purchasPaymentsAttributes = $PurchasPayment->toArray();
        // $siteSettingsAttributes = $siteSettings->toArray();
        // $data=[
        //     '$purchas' => $purchasAttributes,
        //     '$supplier' => $supplierAttributes,
        //     '$$PurchasItem' => $purchasItemsAttributes,
        //     '$PurchasPayment' => $purchasPaymentsAttributes,
        //     '$siteSettings' => $siteSettingsAttributes
        // ];



        return view('purchas.invoice', compact('purchas', 'PurchasItem', 'PurchasPayment','supplier','siteSettings'));
    }

    public function edit($id)
    {
        $purchas = PurchasModel::find($id);
        if (empty($purchas)) {
            Flash::error('Purchas not found');
            return redirect(route('purchas.purchas_list'));
        }
        $supplier = Supplier::find($purchas->supplier_id);
        $PurchasItem = PurchasItemModel::where('purchas_id', $id)->get();
        $PurchasPayment = PurchasPaymentModel::where('purchas_id', $id)->get();
        return view('purchas.edit', compact('purchas', 'PurchasItem', 'PurchasPayment','supplier'));
    }
    public function update(Request $request, $id)
    {

        DB::beginTransaction();
        try {
            $purchases = PurchasModel::find($id);
            if (empty($purchases)) {
                Flash::error('Purchas not found');
                return redirect(route('purchas.purchas_list'));
            }
            $purchases->sub_total = (float)$request->sub_total;
            $purchases->grand_total = (float)$request->grand_total;
            $purchases->due_amount = (float) $request->grand_total - (float) $purchases->payment_amount;
            $purchases->save();
            foreach ($request->item_id as $key => $value) {
                $purchasesItem = PurchasItemModel::where('item_id', $value)->where('purchas_id', $id)->first();
                if (!empty($purchasesItem)) {
                    $purchasesItem->item_per_price = $request->item_per_price[$key];
                    $purchasesItem->total_price = $request->total_price[$key];
                    $purchasesItem->save();
                }else{
                    DB::rollBack();
                    Flash::error('Something went wrong while updating Purchas');
                    return redirect(route('purchas.purchas_list'));
                }
            }
            DB::commit();
            Flash::success('Purchas updated successfully.');
            return redirect(route('purchas.purchas_list'));
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            Flash::error('Something went wrong while updating Purchas');
            return redirect(route('purchas.purchas_list'));
        }
          
    }

}
