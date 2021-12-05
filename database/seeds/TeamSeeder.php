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
        $default_data = Storage::disk('local')->get('default/team.default.json');
        $default_data = json_decode($default_data, true);

        foreach($default_data as $key => $row){
            DB::table('team')->insert([
                'name' => $row['name'] . '',
                'img' => $row['img'] . '',
                'info' => $row['info'] . '',
                'instagram' => $row['instagram'] . '',
                'facebook' => $row['facebook'] . '',
                'for_main_page' => $row['for_main_page'] * 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
              ]);
        }
    }
}
