<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Item;
use App\Models\ItemSerial;
use Illuminate\Http\Request;
use Flash;
use Response;

class ItemController extends AppBaseController
{
    /**
     * Display a listing of the Item.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Item $items */
        $items = Item::select('items.*', 'brands.BrandName', 'categorys.Name as CategoryName', 'subcategorys.SubCategoryName', 'units.Unit_Name', 'companies.companie_name as CompanyName')
            ->leftJoin('brands', 'brands.id', '=', 'items.item_brand_id')
            ->leftJoin('categorys', 'categorys.id', '=', 'items.item_category')
            ->leftJoin('subcategorys', 'subcategorys.id', '=', 'items.item_sub_category')
            ->leftJoin('units', 'units.id', '=', 'items.item_unit')
            ->leftJoin('companies', 'companies.id', '=', 'items.item_company_id')
            ->orderBy('items.id', 'desc')
            ->get();

        return view('items.index')
            ->with('items', $items);
    }

    /**
     * Show the form for creating a new Item.
     *
     * @return Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created Item in storage.
     *
     * @param CreateItemRequest $request
     *
     * @return Response
     */
    public function store(CreateItemRequest $request)
    {
        $input = $request->all();
        if(isset($input['item_serial_number'])){
        $item_serial_number = $input['item_serial_number'];
        }else{
            $item_serial_number=[];
        }
        unset($input['item_serial_number']);
        if ($request->hasFile('item_image')) {
            $file = $request->file('item_image');
            $folder = 'images/item';
            $customName = 'item-'.time();
            $input['item_image'] = uploadFile($file, $folder, $customName);
        }

        $item_id_validate=Item::where('item_id', $input['item_id'])->first();
        if ($item_id_validate) {
            $input['item_id']=create_item_id();
        }
        /** @var Item $item */
        $item = Item::create($input);
        $item_id = $item->id;
        foreach ($item_serial_number as $key => $value) {
            $item_serial = new ItemSerial();
            $item_serial->item_id = $item_id;
            $item_serial->item_serial_number = $value;
            $item_serial->save();
        }

        Flash::success('Item saved successfully.');

        return redirect(route('items.index'));
    }

    /**
     * Display the specified Item.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Item $item */
        $item = Item::find($id);

        if (empty($item)) {
            Flash::error('Item not found');

            return redirect(route('items.index'));
        }

        return view('items.show')->with('item', $item);
    }

    /**
     * Show the form for editing the specified Item.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Item $item */
        $item = Item::find($id);

        if (empty($item)) {
            Flash::error('Item not found');

            return redirect(route('items.index'));
        }

        $edit=true;
        return view('items.edit')->with('item', $item)->with('edit', $edit);
    }

    /**
     * Update the specified Item in storage.
     *
     * @param int $id
     * @param UpdateItemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemRequest $request)
    {
        /** @var Item $item */
        $item = Item::find($id);

        if (empty($item)) {
            Flash::error('Item not found');

            return redirect(route('items.index'));
        }

        $input = $request->all();


        if ($request->hasFile('item_image')) {
            $file = $request->file('item_image');
            $folder = 'images/item';
            $customName = 'item-'.time();
            $input['item_image'] = uploadFile($file, $folder, $customName);
        }else{
            unset($input['item_image']);
        }





        $item->fill($input);
        $item->save();

        Flash::success('Item updated successfully.');

        return redirect(route('items.index'));
    }

    /**
     * Remove the specified Item from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Item $item */
        $item = Item::find($id);

        if (empty($item)) {
            Flash::error('Item not found');

            return redirect(route('items.index'));
        }

        $item->delete();

        Flash::success('Item deleted successfully.');

        return redirect(route('items.index'));
    }

        public function toggleVisibility($id)

        {

            $item = Item::find($id);

    

            if (empty($item)) {

                return response()->json(['success' => false, 'message' => 'Item not found'], 404);

            }

    

            $item->is_hidden = !$item->is_hidden;

            $item->save();

    

            return response()->json(['success' => true, 'is_hidden' => $item->is_hidden]);

        }

    

        public function getHiddenItems()

        {

            $hiddenItems = Item::where('is_hidden', true)->get();

            return response()->json($hiddenItems);

        }

    }

    