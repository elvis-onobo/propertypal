<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\Review;
use App\Admin;
use App\User;
use Auth;

class ReviewController extends Controller
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


    public function reviews()
    {
        $admin = Admin::all();
        $adminRank = Auth::user()->rank;
        return view('admin.reviews', ['admin' => $admin, 'adminRank' => $adminRank]);
    }

    public function reviewAgent(Request $request)
    {
        $admin = Admin::all();
        $keyword = $request->input('reviewEmail');
        $user = User::where('email', 'LIKE', '%'.$keyword.'%')
                    ->select('users.*')->first();
        return view('admin.reviews-entry', ['user' => $user, 'admin' => $admin]);
    }

    public function updateReview(Request $request, $id)
    {
        //recieves the data from the form and inputes to the database
        $this->validate($request, [
            'transaction_amount' => 'required|max:15',
        ]);
        $review = new Review;
        $review->user_id = $id;
        $review->transaction_amount = $request->input('transaction_amount');
        $review->save();
        return redirect('/admin')->with('response', 'Reviewed successfuly');
    }

    public function transactions()
    {
        $admin = Admin::all();
        $adminRank = Auth::user()->rank;
        $review  = DB::table('reviews')->orderBy('reviews.id', 'desc')
                    ->join('users','reviews.user_id', '=' , 'users.id')
                    ->select('reviews.*', 'users.*')
                    ->get();
        $paginate = Review::paginate(20);
        return view('admin.transactions', ['review' => $review, 'paginate' => $paginate, 'admin' => $admin, 'adminRank' => $adminRank]);
    }

}