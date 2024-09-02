<?php

namespace App\Models;

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

    public function scopeServer($query, $server_id)
    {
        if ($server_id != null) {
            return $query->where("server_id", $server_id);
        }
    }


}
