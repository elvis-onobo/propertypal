<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\Availability;
use App\Evaluation;
use App\Addpicture;
use App\Category;
use App\Advert;
use App\Upload;
use App\Admin;
use App\State;
use App\Post;
use App\User;
use Auth;

class AdvertController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function advert()
    {
        $admin = Admin::all();
        $states = State::all();
        $adminRank = Auth::user()->rank;
        return view('admin.advert', ['states' => $states, 'admin'=>$admin, 'adminRank' => $adminRank]);
    }

    public function advertise(Request $request)
    {
        //recieves the data from the form and inputes to the database
        $this->validate($request, [
            'picture' => 'required',
            'link' => 'required',
            'state' => 'required',
            'type' => 'required',
            'duration' => 'required',
        ]);
        $adverts = new Advert;
        $adverts->link = $request->input('link');
        $adverts->state = $request->input('state');
        $adverts->type = $request->input('type');
        $adverts->duration = $request->input('duration');
        if(Input::hasFile('picture')){
            $file = Input::file('picture');
            $file->move(public_path(). '/adverts/', $file->getClientOriginalName());
            $url = URL::to('/') . '/adverts/'. $file->getClientOriginalName();
        }
        $adverts->picture = $url;
        $adverts->save();
        return redirect('/admin')->with('response', 'Advertised Successfully');
    }
}
