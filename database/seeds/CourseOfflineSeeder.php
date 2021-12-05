<?php

use Illuminate\Database\Seeder;

class CourseOfflineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_data = Storage::disk('local')->get('default/course_offline.default.json');
        $default_data = json_decode($default_data, true);

        foreach($default_data as $key => $row){
            DB::table('courses_offline')->insert([
                'name' => $row['name'],
                'place' => $row['place'],
                'date_of' => $row['date_of'],
                'period' => $row['period'],
                'video' => $row['video'],
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
              ]);
        }
    }
}
