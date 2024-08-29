<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetById;
use App\Http\Requests\ItemCreateOrUpdateRequest;
use App\Http\Requests\ItemTransactionCreateorUpdateRequest;
use App\Models\Item;
use App\Models\ItemTransaction;
use DB;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        //$items = Item::with('users')->get();
        $items=DB::select('SELECT
        items.id,
        items.name,
        COALESCE((SELECT SUM(quantity) FROM item_transactions WHERE type=1 AND item_id=items.id),0)-
        COALESCE((SELECT SUM(quantity) FROM item_transactions WHERE type=2 AND item_id=items.id),0) quantity,
        (SELECT price FROM item_transactions WHERE type=1 AND item_id=items.id ORDER BY created_at DESC LIMIT 1) last_purchase_price,
        (SELECT price FROM item_transactions WHERE type=2 AND item_id=items.id ORDER BY created_at DESC LIMIT 1) last_sales_price,
        (SELECT price FROM item_transactions WHERE type = 2 AND item_id = items.id ORDER BY created_at DESC LIMIT 1) -
        (SELECT price FROM item_transactions WHERE type = 1 AND item_id = items.id ORDER BY created_at DESC LIMIT 1) AS profit,  -- Karlılık hesaplaması
        users.name user_name
        FROM items LEFT JOIN users ON items.user_id=users.id');
        return view('modules.items.index.index', compact('items'));
    }

    public function store(ItemCreateOrUpdateRequest $request)
    {
        if ($request->id) {
            $item = Item::find($request->id);
            $item->name = $request->name;
            $item->description = $request->description;
            $item->note = $request->note;
            $item->user_id = auth()->user()->id;
            $item->save();
            return response()->json(['success' => 'Item updated successfully.']);
        } else {
            $item = new Item();
            $item->name = $request->name;
            $item->description = $request->description;
            $item->note = $request->note;
            $item->user_id = auth()->user()->id;
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
        $itemTransactions = ItemTransaction::with('users')->where('item_id', $id)->get();
        return view('modules.transactions.index.index', compact('item', 'itemTransactions'));
    }


    public function transactionStore(ItemTransactionCreateorUpdateRequest $request)
    {
        //dd($request->all());
        if ($request->id) {
            $itemTransaction = ItemTransaction::find($request->id);
            $itemTransaction->item_id = $request->item_id;
            $itemTransaction->type = $request->type;
            $itemTransaction->price = $request->price;
            $itemTransaction->quantity = $request->quantity;
            $itemTransaction->user_id = auth()->user()->id;;
            $itemTransaction->save();
            return response()->json(['success' => 'ItemTransaction updated successfully.']);
        } else {
            $itemTransaction = new ItemTransaction();
            $itemTransaction->item_id = $request->item_id;
            $itemTransaction->type = $request->type;
            $itemTransaction->price = $request->price;
            $itemTransaction->quantity = $request->quantity;
            $itemTransaction->user_id = auth()->user()->id;
            $itemTransaction->save();
            return response()->json(['success' => 'ItemTransaction created successfully.']);
        }
    }
    public function editTransaction(Request $request)
    {
        return ItemTransaction::find($request->id);
    }
}
