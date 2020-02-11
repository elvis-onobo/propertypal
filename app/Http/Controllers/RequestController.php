<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\PropertyRequest;

class RequestController extends Controller
{
    public function makeRequest(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'required',
            'type' => 'required',
        ]);
        $requests = new PropertyRequest;
        $requests->name = $request->input('name');
        $requests->phone_number = $request->input('phone_number');
        $requests->email = $request->input('email');
        $requests->type = $request->input('type');
        $requests->location = $request->input('location');
        $requests->budget = $request->input('budget');
        $requests->request = $request->input('request');
        $requests->save();
        return redirect('/')->with('response', 'Request successful, we will get back to you in a few hours!');
    }


    public function showRequests()
    {
        $requests = DB::table('property_requests')
                ->select('property_requests.*')
                ->simplePaginate(20);
            return view('post.requests', compact('requests'));
    }
}
