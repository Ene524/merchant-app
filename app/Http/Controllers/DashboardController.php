<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemTransaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $itemCount = Item::count();
        $mostUsedServer = Item::select('servers.name')
            ->leftJoin('servers', 'items.server_id', '=', 'servers.id') // LEFT JOIN
            ->whereNull('items.deleted_at')                             // WHERE items.deleted_at IS NULL
            ->groupBy('servers.name')                                   // GROUP BY servers.name
            ->orderByRaw('COUNT(*) DESC')                               // ORDER BY COUNT(*) DESC
            ->limit(1)                                                  // LIMIT 1
            ->first();
        $bestTransactionItem = ItemTransaction::with('item')
            ->select('item_id')
            ->selectRaw('COUNT(*) as transaction_count')
            ->groupBy('item_id')
            ->orderBy('transaction_count', 'desc')
            ->first();


        return view("modules.dashboard.index.index", compact('userCount', 'itemCount', 'bestTransactionItem', 'mostUsedServer'));
    }
}
