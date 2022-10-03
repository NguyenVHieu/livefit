<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Storage;
use App\Models\Exercise;
use App\Models\Type;
use Illuminate\Support\Facades\File;


class ExerciseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::disk('local')->get('/json/exercises.json');
        $exercises = json_decode($json, true);
        foreach($exercises as $exercise){
            $data = Exercise::query()->updateOrcreate([
                'title' => $exercise['title'],
                'cover_male' => $exercise['img']['male'],
                'cover_female' => $exercise['img']['female'],
            ]);
            $id = Type::select('id')->where('title', $exercise['type'])->get();
            $data = Exercise::find($exercise->id);
            $data->fhbEquipment()->attach([$id]);
            return $this->response(200);
        }
    }
}
