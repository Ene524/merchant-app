<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetById;
use App\Http\Requests\ItemCreateOrUpdateRequest;
use App\Models\Item;
use App\Models\ItemTransaction;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('user')->get();
        return view('modules.items.index.index', compact('items'));
    }

    public function store(ItemCreateOrUpdateRequest $request)
    {
        if ($request->id) {
            $item = Item::find($request->id);
            $item->name = $request->name;
            $item->description = $request->description;
            $item->note = $request->note;
            $item->user_id = 1;
            $item->save();
            return response()->json(['success' => 'Item updated successfully.']);
        } else {
            $item = new Item();
            $item->name = $request->name;
            $item->description = $request->description;
            $item->note = $request->note;
            $item->user_id = 1;
            $item->save();
            return response()->json(['success' => 'Item created successfully.']);
        }
    }

    public function edit(Request $request)
    {
        return Item::find($request->id);
    }

    public function delete(Request $request)
    {
        Item::find($request->id)->delete();
        return response()->json(['success' => 'Item deleted successfully.']);
    }

    public function itemTransactions($id)
    {
        $item = Item::find($id);
        $itemTransactions = ItemTransaction::with('user')->where('item_id', $id)->get();
        return view('modules.transactions.index.index', compact('item', 'itemTransactions'));
    }
}
