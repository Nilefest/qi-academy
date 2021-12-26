<?php

use Illuminate\Database\Seeder;

use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Container::getInstance()->make(Generator::class);

        DB::table('users')->insert([
          'name' => 'Admin',
          'lastname' => 'Super',
          'password' => bcrypt('admin'),
          'email' => 'admin@mail.com',
          'email_verified_at' => date('Y-m-d H:i:s'),
          'access' => '-1',
          'updated_at' => date('Y-m-d H:i:s'),
          'created_at' => date('Y-m-d H:i:s'),
        ]);
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
    }
}
