<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->delete();

        User::create([
            'name' => "Admin Admin",
            'email' => "admin@mail.com",
            'password' => bcrypt('Admin@123'),
        ]);
    }
}
