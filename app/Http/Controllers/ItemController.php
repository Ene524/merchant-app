<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetById;
use App\Http\Requests\ItemCreateOrUpdateRequest;
use App\Http\Requests\ItemTransactionCreateorUpdateRequest;
use App\Models\Item;
use App\Models\ItemTransaction;
use App\Models\Server;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $servers = Server::all();
        $search = $request->input('search');

        $items = Item::withDetails($search)->get();
        return view('modules.items.index.index', compact('items', 'servers'));
    }

    public function store(ItemCreateOrUpdateRequest $request)
    {
        if ($request->id) {
            $item = Item::find($request->id);
            $item->name = $request->name;
            $item->description = $request->description;
            $item->note = $request->note;
            $item->user_id = auth()->user()->id;
            $item->server_id = $request->server_id;
            $item->save();
            return response()->json(['success' => 'Item updated successfully.']);
        } else {
            $item = new Item();
            $item->name = $request->name;
            $item->description = $request->description;
            $item->note = $request->note;
            $item->user_id = auth()->user()->id;
            $item->server_id = $request->server_id;
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
