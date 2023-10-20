<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'cel' => '300XXXXXXX',
            'tel' => '601XXXXXXX',
            'email' => 'admin@admin.com',
            'password' => bcrypt(env('PASSWORD_ADMIN_USER')),
            'role' => 'Admin',
        ])->assignRole('Admin');
    }
}
