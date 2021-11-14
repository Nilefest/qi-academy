<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'name' => 'Admin',
          'login' => 'admin',
          'password' => bcrypt('admin'),
          'email' => 'admin@gmail.com',
          'email_verified_at' => date('Y-m-d H:i:s'),
          'access' => '-1',
          'updated_at' => date('Y-m-d H:i:s'),
          'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
