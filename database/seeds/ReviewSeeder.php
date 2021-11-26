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
        $default_data = Storage::disk('local')->get('default_review.json');
        $default_data = json_decode($default_data, true);

        foreach($default_data as $key => $row){
            DB::table('reviews')->insert([
                'user_id' => $row['user_id'],
                'date_of' => $row['date_of'],
                'text' => $row['text'],
                'video' => $row['video'],
                'public' => $row['public'],
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
              ]);
        }
    }
}
