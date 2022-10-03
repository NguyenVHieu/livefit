<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use Illuminate\Support\Facades\Storage;


class ExerciseController extends Controller
{
  public function index()
	{
		$exercise = Exercise::with('fhbMuscle')->get();
		return $this->response(200, $exercise);
	}

	public function fhbDetailExercise($id)
  {
    $exercise = Exercise::where('id', $id)->with('fhbMuscle')->get();
    if (!$exercise) return $this->response(400, "Not Found");
		return $this->response(200, $exercise);
  }

  public function fhbFilterExercise(Request $request)
  {
    $query = Exercise::query()
    ->join('exercise_muscles', 'exercise_muscles.exercise_id', '=', 'exercises.id')
    ->join('muscle_groups',function($join){
      $join->on('muscle_groups.id', '=', 'exercise_muscles.muscle_id');
    })
    ->join('exercise_types', 'exercise_types.exercise_id', '=', 'exercises.id')
    ->join('types', function($join){
      $join->on('types.id', '=', 'exercise_types.type_id');
    })
    ->join('exercise_equipments', 'exercise_equipments.exercise_id', '=', 'exercises.id')
    ->join('equipments', function($join){
      $join->on('equipments.id', '=', 'exercise_equipments.equipment_id');
    });

    if($request->muscle_id) $query->whereIn('muscle_groups.id', $request->get('muscle_id'));
    if($request->type_id) $query->whereIn('types.id', $request->get('type_id'));
    if($request->equipment_id) $query->whereIn('equipments.id', $request->get('equipment_id'));

    $data = $query->select('exercises.*')->distinct()->get();

    return $this->response(200, $data);   
  }

  public function fhbSearchExercise(Request $request)
  {
    $keyword = $request->keyword;
    $exercise = Exercise::with('fhbMuscle')
                          ->where('title', 'LIKE', '%'. $keyword.'%')
                          ->get();
		return $this->response(200, $exercise);
  }

  public function fhbFilter(Request $request)
  {
    $exercise_id = $request->id;

    $data = Exercise::select('exercise_types.type_id')
                      ->join('exercise_types', 'exercise_types.exercise_id', '=', 'exercises.id')
                      ->where('exercises.id', '=', $exercise_id)
                      ->first();

    $type_id = $data->type_id;

    $exercise = Exercise::select('exercises.*')
                ->join('exercise_types', 'exercise_types.exercise_id', '=', 'exercises.id')
                ->join('types',function($join){
                  $join->on('types.id', '=', 'exercise_types.type_id');
                })
                ->where('types.id', '=', $type_id)
                ->limit(3)
                ->distinct()->get();
    return $this->response(200, $exercise);       
  }
}
