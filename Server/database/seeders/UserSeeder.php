<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        
        $users = [
            ['Admin', '0123456789', 'admin@gmail.com','1'],
            ['TranCongTu', '12345678', 'visaodoncoi9x@gmail.com','3'],
            ['NguyenThiXuan', '12345678', 'nguyenxuan@gmail.com','3'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user[0],
                'password' => Hash::make($user[1]),
                'email' => $user[2],
                'role' => $user[3]
            ]);
        }
        
        Schema::enableForeignKeyConstraints();
    }
}
