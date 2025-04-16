<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\table;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = DB::table('users')->insertGetId([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456'), // mật khẩu: password
            'address' =>'Hà Nội',
            'dob' => '2003-12-01',
            'status' => 1,
            'captcha' => "",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('role_user')->insert([
            ['user_id' => $admin, 'role_id' => 1],
            ['user_id' => $admin, 'role_id' => 2],
    ]);
    }
}
