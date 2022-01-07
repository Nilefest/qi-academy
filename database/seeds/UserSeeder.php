<?php

use Illuminate\Database\Seeder;

<<<<<<< HEAD
=======
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Support\Str;

>>>>>>> dev
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        DB::table('users')->insert([
          'name' => 'Admin',
          'login' => 'admin',
          'password' => bcrypt('admin'),
          'email' => 'admin@gmail.com',
=======
        $faker = Container::getInstance()->make(Generator::class);

        DB::table('users')->insert([
          'name' => 'Admin',
          'lastname' => 'Super',
          'password' => bcrypt('admin'),
          'email' => 'admin@mail.com',
>>>>>>> dev
          'email_verified_at' => date('Y-m-d H:i:s'),
          'access' => '-1',
          'updated_at' => date('Y-m-d H:i:s'),
          'created_at' => date('Y-m-d H:i:s'),
        ]);
<<<<<<< HEAD
=======
        for($i = 0; $i < 10; $i++){
          DB::table('users')->insert([
            'name' => $faker->firstName(),
            'lastname' => $faker->lastName,
            'password' => bcrypt("user$i"),
            'email' => "user$i@mail.com",
            'email_verified_at' => date('Y-m-d H:i:s'),
            'access' => '1',
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
          ]);
        }
>>>>>>> dev
    }
}
