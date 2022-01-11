<?php

use Illuminate\Database\Seeder;

use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Support\Str;

class CourseOfflineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Container::getInstance()->make(Generator::class);
        
        $total_courses = rand(2, 7);

        for($course_id = 1; $course_id <= $total_courses; $course_id++){
            DB::table('courses_offline')->insert([
                'id' => $course_id,
                'name' => $faker->sentence(rand(3, 7)),
                'place' => $faker->city,
                'date_of' => date('Y-m-d H:i:s', time() + rand(10000, 9999999)),
                'period' => rand(2, 7),
                'video' => '',
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
              ]);
        }
    }
}
