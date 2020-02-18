<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Availability;
use App\Evaluation;
use App\Category;
use App\State;

class ApiController extends Controller
{
    /*
    * save the state
    */
    public function state(Request $request){
        $request->validate([
            'state'=>'required'
        ]);

        $state = new State;
        $state->state = $request->input('state');

        if($state->save()){
            return response()->json(['status'=>'State Saved']);
        }
        return response()->json(['status'=>'State Not Saved']);
    }

    /*
    * save the category
    */
    public function category(Request $request){
        $request->validate([
            'category'=>'required'
        ]);

        $category = new Category;
        $category->category = $request->input('category');

        if($category->save()){
            return response()->json(['status'=>'Category Saved']);
        }
        return response()->json(['status'=>'Category Not Saved']);
    }

    /*
    * save the evaluation
    */
    public function evaluation(Request $request){
        $request->validate([
            'evaluation'=>'required'
        ]);

        $evaluation = new Evaluation;
        $evaluation->evaluation = $request->input('evaluation');

        if($evaluation->save()){
            return response()->json(['status'=>'Evaluation Saved']);
        }
        return response()->json(['status'=>'Evaluation Not Saved']);
    }

    /*
    * save the availability
    */
    public function availability(Request $request){
        $request->validate([
            'availability'=>'required'
        ]);

        $availability = new Availability;
        $availability->availability = $request->input('availability');

        if($availability->save()){
            return response()->json(['status'=>'Availability Saved']);
        }
        return response()->json(['status'=>'Availability Not Saved']);
    }
}
