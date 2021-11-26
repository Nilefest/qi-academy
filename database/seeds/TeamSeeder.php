<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_data = Storage::disk('local')->get('default_team.json');
        $default_data = json_decode($default_data, true);

        foreach($default_data as $key => $row){
            DB::table('team')->insert([
                'name' => $row['name'],
                'img' => $row['img'],
                'info' => $row['info'],
                'instagram' => $row['instagram'],
                'facebook' => $row['facebook'],
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
              ]);
        }
    }
}
