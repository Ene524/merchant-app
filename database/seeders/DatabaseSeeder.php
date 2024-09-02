<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Server;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userCount = User::count();
        if ($userCount == 0) {
            User::create([
                'name' => 'Enes Karakuş',
                'email' => 'mail.eneskarakus@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('1'),
                'remember_token' => Str::random(10),
            ]);
        }


        $dataServers = array(
            array('name' => 'OREADS', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'MINARK', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'DESTAN', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'DRYANDS', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'PANDORA', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'FELIS', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'AGARTHA', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'ZERO', 'created_at' => now(), 'updated_at' => now()),
        );

        if (Server::count() == 0) {
            Server::insert($dataServers);
        }
    }
}
