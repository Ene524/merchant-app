<?php

namespace App\Imports;

use App\Http\Requests\ItemCreateOrUpdateRequest;
use App\Models\Item;
use App\Models\Server;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemsImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $server = Server::where('name', $row['server'])->first();


            if ($server) {
                $checkItem = Item::where('name', $row['name'])
                    ->where('server_id', $server->id)
                    ->first();

                if (!$checkItem) {
                    Item::create([
                        'name' => $row['name'],
                        'description' => $row['description'],
                        'note' => $row['note'],
                        'user_id' => auth()->user()->id,
                        'server_id' => $server->id
                    ]);
                }
            }
        }
    }

}
