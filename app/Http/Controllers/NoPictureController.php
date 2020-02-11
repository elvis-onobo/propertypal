<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Availability;
use App\Evaluation;
use App\Addpicture;
use App\NoPicture;
use App\Category;
use App\Upload;
use App\Review;
use App\Admin;
use App\State;
use App\Blog;
use App\Post;
use App\User;
use Auth;

class NoPictureController extends Controller
{
    public function uploadWithoutPicture()
    {
        // controlls views to the upload withot picture page
        $categories = Category::all();
        $states = State::all();
        $evaluation = Evaluation::all();
        return view('post.uploadWithoutPicture', ['categories' => $categories, 'states' => $states, 'evaluation' => $evaluation]);
    }

    public function withoutPictureUpload(Request $request)
    {
        //recieves the data from the form and inputes to the database
        $this->validate($request, [
            'phone' => 'required',
            'type' => 'required',
            'location' => 'required',
            'state' => 'required',
            'price' => 'required',
            'rentorsale' => 'required',
            'water' => 'required',
            'light' => 'required',
            'security' => 'required',
            'road' => 'required',
            'additional_info' => 'required',
        ]);
        $nopicture = new NoPicture;
        $nopicture->user_id = Auth::user()->id;
        $nopicture->phone = $request->input('phone');
        $nopicture->type = $request->input('type');
        $nopicture->location = $request->input('location');
        $nopicture->state = $request->input('state');
        $nopicture->price = $request->input('price');
        $nopicture->rentorsale = $request->input('rentorsale');
        $nopicture->water = $request->input('water');
        $nopicture->light = $request->input('light');
        $nopicture->security = $request->input('security');
        $nopicture->road = $request->input('road');
        $nopicture->additional_info = $request->input('additional_info');
        $nopicture->pid = bin2hex(random_bytes(3));
        $nopicture->availability = 0;
        $nopicture->slugline = str_slug($request->input('type'));
        $nopicture->save();
        return redirect('/uploadWithoutPicture')->with('response', 'Uploaded Successfully, Upload More...');
    }
}
