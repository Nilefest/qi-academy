<?php

use Illuminate\Database\Seeder;

use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Support\Str;

class CourseLectureSeeder extends Seeder
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

        $lecture_id = 0;
        $course_id = 0;
        foreach($total_courses as $course_type => $total){
            for($course_n = 1; $course_n <= $total; $course_n++){
                $course_id++;
                $total_child = rand(5, 10);
                for($lecture_n = 0; $lecture_n < $total_child; $lecture_n++){
                    $lecture_id++;
                    DB::table('course_lectures')->insert([
                        'id' => $lecture_id,
                        'course_id' => $course_id,
                        'name' => $faker->sentence(rand(2, 5)),
                        'info_short' => implode($faker->sentences(rand(5, 7))),
                        'info_full' => implode($faker->sentences(rand(7, 12))),
                        'video' => '',
                        'file' => '',
                        'homework' => implode($faker->sentences(rand(3, 7))),
                    ]);
                }
            }
        }
    }
}
