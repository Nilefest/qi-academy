<?php

use Illuminate\Database\Seeder;

use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
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
                DB::table('courses')->insert([
                    'id' => $course_id,
                    'main_course' => ($course_id === 1 && $course_type === 'paid') * 1,
                    'free' => ($course_type === 'free') * 1,
                    'free_for_client' => ($course_type === 'bonuse') * 1,
                    'only_paid' => ($course_type === 'paid') * 1,
                    'name' => $faker->sentence(rand(3, 5)),
                    'banner_img' => '',
                    'total_days' => 25 + rand(-5, 5),
                    'total_hours' => 120 + rand(-50, 50),
                    'cost' => ($course_type === 'paid' ? rand(10, 99) : 0),
                    'video_preview' => '',
                    'description' => implode($faker->sentences(rand(5, 7))),
                    'description_for_1' => 'For me',
                    'description_for_2' => 'For you',
                    'team_id' => rand(1, 3),
                    'gallery_img_1' => '',
                    'gallery_img_2' => '',
                    'gallery_img_3' => ''
                  ]);
            }
        }
    }
}
