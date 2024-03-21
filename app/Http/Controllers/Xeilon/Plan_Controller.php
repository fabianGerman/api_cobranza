<?php

namespace App\Http\Controllers\Xeilon;

use App\Http\Controllers\Controller;
use App\Models\Xeilon\Plan_Xeilon;
use Illuminate\Http\Request;

class Plan_Controller extends Controller
{
    public function list_planes(){
        $planes = Plan_Xeilon::get_all_planes();
        return response()->json($planes);
    }

    public function get_plan(){
        $plan = Plan_Xeilon::get_plan(101);
        return response()->json($plan);
    }
}
