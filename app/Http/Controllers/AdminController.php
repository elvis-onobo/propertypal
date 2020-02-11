<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Nopicture;
use App\Upload;
use App\Admin;
use App\Advert;
use App\Blog;
use App\Rank;
use App\User;
use Auth;

class AdminController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Admin::all();
        $adminRank = Auth::user()->rank;
        $user = User::count();
        $upload = Upload::count()+Nopicture::count();
        $countAdmins = Admin::count();
        $countAdverts = Advert::count();
        return view('admin', ['admin' => $admin, 'adminRank' => $adminRank, 'user' => $user, 'upload' => $upload, 'countAdmins' => $countAdmins, 'countAdverts'=> $countAdverts]);
    }

    public function showRegistrationForm()
    {
        $admin = Admin::all();
        $rank = Rank::all();
        $adminRank = Auth::user()->rank;
        return view('admin.create-admin', ['rank' => $rank, 'admin'=>$admin, 'adminRank' => $adminRank]);
    }

    public function registerAdmin(Request $request)
    {
        //recieves the data from the form and inputes to the database
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $admins = new Admin;
        $admins->name = $request->input('name');
        $admins->email = $request->input('email');
        $admins->rank = $request->input('rank');
        $password = Input::get('password');
        // $admins->password = $request->input('password');
        $admins->password = Hash::make($password);
        $admins->save();
        return redirect('admin')->with('response', 'Admin Registered');
    }



    public function blogpost(Request $request)
    {
        //recieves the data from the form and inputes to the database
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);
        $blogs = new Blog;
        $blogs->admin_id = Auth::user()->id;
        $blogs->title = $request->input('title');
        $blogs->slugline = str_slug($request->input('title'));
        $blogs->body = $request->input('body');
        $blogs->save();
        return redirect('/admin')->with('response', 'Posted Successfully');
    }

}


