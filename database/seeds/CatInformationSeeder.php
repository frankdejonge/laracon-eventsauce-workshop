<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatInformationSeeder extends Seeder
{
    public function run()
    {
        $catInformation = json_decode(file_get_contents(__DIR__.'/../../catinformation.json'), true);
        $rows = DB::table('cat_information')->count();

        if ($rows > 0) {
            return;
        }

        foreach ($catInformation as $information) {
            $id = $information['id'];
            DB::table('cat_information')->insert([
                'id' => $id,
                'payload' => json_encode($information),
            ]);
        }
    }
}