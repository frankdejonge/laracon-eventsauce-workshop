<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdoptableCatsSeeder extends Seeder
{
    public function run()
    {
        $catInformation = json_decode(file_get_contents(__DIR__.'/../../adoptable-cats.json'), true);
        $rows = DB::table('adoptable_cats')->count();

        if ($rows > 0) {
            return;
        }

        foreach ($catInformation as $information) {
            $id = $information['id'];
            DB::table('adoptable_cats')->insert([
                'tag_of_cat' => $id,
                'breed' => $information['breed'],
                'gender' => $information['gender'],
                'color' => $information['color'],
                'payload' => json_encode($information),
            ]);
        }
    }
}