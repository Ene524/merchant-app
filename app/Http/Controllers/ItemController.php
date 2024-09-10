<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetById;
use App\Http\Requests\ItemCreateOrUpdateRequest;
use App\Http\Requests\ItemTransactionCreateorUpdateRequest;
use App\Imports\ItemsImport;
use App\Models\Item;
use App\Models\ItemTransaction;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        //dd($request->all());
        $servers = Server::all();

        $items = Item::with('user', 'server')
            ->withDetails()
            ->Server($request->server_id)
            ->Name($request->name)
            ->orderBy('items.created_at', 'desc')
            ->paginate(5);
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
        $ids = is_array($request->id) ? $request->id : [$request->id];
        Item::whereIn('id', $ids)->delete();
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

    public function transactionDelete(Request $request)
    {
        ItemTransaction::find($request->id)->delete();
        return response()->json(['success' => 'Item deleted successfully.']);
    }

    public function getTransactionForChart(Request $request)
    {
        $transactionForChart = DB::select("SELECT
            i.name AS item_name,
            t.created_at AS transaction_date,
            SUM(CASE WHEN t.type = 1 THEN t.price ELSE 0 END) AS total_purchase_price,
            SUM(CASE WHEN t.type = 2 THEN t.price ELSE 0 END) AS total_sale_price
        FROM
            items i
        JOIN
            item_transactions t ON i.id = t.item_id
        WHERE
            i.deleted_at IS NULL
        GROUP BY
            i.name, t.created_at
        ORDER BY
            t.created_at ASC;");
        return response()->json($transactionForChart);
    }

    public function importItems(Request $request)
    {
        Excel::import(new ItemsImport(), $request->file('file'));
        return response()->json(['success' => 'Items imported successfully.']);
    }
}
