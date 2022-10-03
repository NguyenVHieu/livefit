<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Helpers\Helper;

class PlanController extends Controller
{
  public function listPlan()
  {
    $plan = Plan::with('fhbEquipment')
      ->with('fhbLevel')
      ->get();
    return $this->response(200, $plan);
  }

  public function detailPlan(Request $request)
  {
    $slug = $request->slug;
    $plan = Plan::where('slug', $slug)->first();
    if (!$plan) return $this->response(400, "Not Found");
    return $this->response(200, $plan);
  }

  public function getWorkout($id)
  {
    $workout = Plan::find($id)->workout()->get();
    return $this->response(200, $workout);
  }

  public function fhbFilterPlan(Request $request)
  {
    $query = Plan::query()
      ->join('plan_equipments', 'plan_equipments.plan_id', '=', 'plans.id')
      ->join('equipments', function ($join) {
        $join->on('equipments.id', '=', 'plan_equipments.equipment_id');
      })
      ->join('plan_levels', 'plan_levels.plan_id', '=', 'plans.id')
      ->join('levels', function ($join) {
        $join->on('levels.id', '=', 'plan_levels.level_id');
      })
      ->join('plan_goals', 'plan_goals.plan_id', '=', 'plans.id')
      ->join('goals', function ($join) {
        $join->on('goals.id', '=', 'plan_goals.goal_id');
      });

    if ($request->goal_id) $query->whereIn('goals.id', $request->get('goal_id'));
    if ($request->level_id) $query->where('levels.id', $request->level_id);
    if ($request->equipment_id) $query->whereIn('equipments.id', $request->get('equipment_id'));

    $data = $query->select('plans.*')->with('fhbLevel', 'fhbEquipment')->distinct()->get();

    return $this->response(200, $data);
  }

  public function fhbSearchPlan(Request $request)
  {
    $keyword = $request->keyword;
    $plan = Plan::with('fhbEquipment')
      ->with('fhbLevel')
      ->where('name', 'LIKE', '%' . $keyword . '%')
      ->get();
    return $this->response(200, $plan);
  }

  public function fhbRelatedPlan(Request $request)
  {
    if ($request->type == 'slide') {
      $data = Plan::with('fhbEquipment', 'fhbLevel')->orderBy('id', 'desc')->take(6)->get();
    } else {
      $data = Plan::with('fhbEquipment', 'fhbLevel')->orderBy('id', 'desc')->take(4)->get();
    }
    return $this->response(200, $data);
  }

  public function fhbGetScheduleTrainer($id)
  {
    $workout = Plan::find($id)->workout()->with('schedule')->get();
    return $this->response(200, $workout);
  }
}
