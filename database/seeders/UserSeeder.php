<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('users')->insert([
      [
        'name' => 'Murilo Nascimento',
        'username' => 'muriloj99',
        'email' => 'murilojesus659@gmail.com',
        'role' => 'admin',
        'status' => 'active',
        'password' => bcrypt('password')
      ],
      [
        'name' => 'Vendedor Matheus',
        'username' => 'vendor',
        'email' => 'matheus@vendor.com',
        'role' => 'vendor',
        'status' => 'active',
        'password' => bcrypt('password')
      ],
      [
        'name' => 'Cliente Claudia',
        'username' => 'user',
        'email' => 'claudia@user.com',
        'role' => 'user',
        'status' => 'active',
        'password' => bcrypt('password')
      ]
    ]);
  }
}
