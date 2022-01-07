<?php

use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_data = Storage::disk('local')->get('default/video_review.default.json');
        $default_data = json_decode($default_data, true);

        foreach($default_data as $key => $row){
            DB::table('reviews')->insert([
                'text' => '',
                'video' => $row['link'] . '',
                'youtube_code' => $row['code'] . '',
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
              ]);
        }
    }
}
