<?php

use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_data = Storage::disk('local')->get('default/contacts.default.json');
        $default_data = json_decode($default_data, true);

        foreach($default_data as $type_key => $contact_data){
            foreach($contact_data as $title_key => $value){
                DB::table('contacts')->insert([
                    'type' => $type_key . '',
                    'title' => $title_key . '',
                    'link' => $value . '',
                    'updated_at' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
