<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create Admin
        $user = User::create([
            'name'          => 'Admin',
            'email'         => 'admin@admin.com',
            'phone'         => '8888888888',
            'password'      => Hash::make('123456'),
            'email_verified_at' => now(),
        ]);
    }
}
