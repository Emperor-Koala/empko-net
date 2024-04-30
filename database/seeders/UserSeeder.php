<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (config('admin.admin_email') && config('admin.admin_password') && config('admin.admin_name')){
            \App\Models\User::factory()->create([
                'name' => config('admin.admin_name'),
                'email' => config('admin.admin_email'),
                'password' => Hash::make(config('admin.admin_password')),
            ]);
        }
    }
}
