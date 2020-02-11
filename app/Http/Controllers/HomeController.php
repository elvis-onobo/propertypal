<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Upload;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $upload = DB::table('users')->join('uploads', 'users.id', '=' , 'uploads.user_id')
                    ->select('users.*', 'uploads.*')
                    ->where(['uploads.user_id' => $user_id])
                    ->get();
        return view('home', ['upload' => $upload, 'user_id'=>$user_id]);
    }

}
