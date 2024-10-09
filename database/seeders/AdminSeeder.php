<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin=Admin::create([
            'firstname' => 'Admin',
            'lastname' => '',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'status' => 1,
            'type' => 'super',
            'avatar' => '/avatar/default-avatar.png',

            'password' => Hash::make('12345678'),
       ]);
       return $admin;
    }
}
