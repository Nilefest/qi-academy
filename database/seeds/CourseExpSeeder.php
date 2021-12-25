<?php

use Illuminate\Database\Seeder;

use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Support\Str;

class CourseExpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Container::getInstance()->make(Generator::class);
        
        $total_courses = [
            'paid' => 7,
            'free' => 3,
            'free_for_client' => 5
        ];

        $course_id = 0;
        foreach($total_courses as $course_type => $total){
            for($course_n = 1; $course_n <= $total; $course_n++){
                $course_id++;
                $total_child = rand(5, 10);
                for($j = 0; $j < $total_child;$j++){
                    DB::table('course_exp')->insert([
                        'course_id' => $course_id,
                        'info' => $faker->sentence(rand(1, 3)),
                    ]);
                }
            }
        }
    }
}
