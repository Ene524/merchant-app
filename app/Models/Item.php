<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Item extends Model
{
    use HasFactory, SoftDeletes;

    public function transactions()
    {
        return $this->hasMany(ItemTransaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function server()
    {
        return $this->belongsTo(Server::class);
    }
    public function scopeWithDetails(Builder $query, $search = null)
    {
        $query->select('items.id', 'items.name', 'servers.name as server_name', 'users.name as user_name', 'items.created_at')
            ->leftJoin('users', 'items.user_id', '=', 'users.id')
            ->leftJoin('servers', 'items.server_id', '=', 'servers.id')
            ->selectRaw('COALESCE((SELECT SUM(quantity) FROM item_transactions WHERE type=1 AND item_id=items.id),0)-
                COALESCE((SELECT SUM(quantity) FROM item_transactions WHERE type=2 AND item_id=items.id),0) as quantity')
            ->selectRaw('(SELECT price FROM item_transactions WHERE type=1 AND item_id=items.id ORDER BY created_at DESC LIMIT 1) as last_purchase_price')
            ->selectRaw('(SELECT price FROM item_transactions WHERE type=2 AND item_id=items.id ORDER BY created_at DESC LIMIT 1) as last_sales_price')
            ->selectRaw('(SELECT price FROM item_transactions WHERE type = 2 AND item_id = items.id ORDER BY created_at DESC LIMIT 1) -
                (SELECT price FROM item_transactions WHERE type = 1 AND item_id = items.id ORDER BY created_at DESC LIMIT 1) AS profit');

        if ($search) {
            $query->where('items.name', 'LIKE', "%{$search}%")
                ->orWhere('servers.name', 'LIKE', "%{$search}%")
                ->orWhere('users.name', 'LIKE', "%{$search}%");
        }

        return $query;
    }


}
