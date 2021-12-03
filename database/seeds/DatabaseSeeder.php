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
        
        $this->call(TeamSeeder::class);
        
        $this->call(CourseOfflineSeeder::class);
        
        $this->call(CourseSeeder::class);
        $this->call(CourseExpSeeder::class);
        $this->call(LectureSeeder::class);

        $this->call(FaqSeeder::class);
    }
}
