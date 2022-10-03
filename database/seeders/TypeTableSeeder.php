<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Storage;
use App\Models\Type;


class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::disk('local')->get('/json/exercises.json');
        $types = json_decode($json, true);
        foreach($types as $type){
            $title = explode(",", $type['type']);
            Type::query()->updateOrcreate([
                'title' => $title
            ]);
        }
    }
}
