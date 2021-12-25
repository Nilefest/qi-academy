<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ContactSeeder::class);
        
        $this->call(TeamSeeder::class);
        $this->call(ReviewSeeder::class);
        
        $this->call(CourseOfflineSeeder::class);
        
        $this->call(CourseSeeder::class);
        $this->call(CourseExpSeeder::class);
        $this->call(CourseLectureSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(UserCourseSeeder::class);
        $this->call(UserLectureSeeder::class);

        $this->call(PaymentSeeder::class);
    }
}
