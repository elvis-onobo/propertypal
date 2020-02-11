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
use App\Nopicture;
use App\Category;
use App\Upload;
use App\Review;
use App\Admin;
use App\State;
use App\Blog;
use App\Post;
use App\User;
use Auth;

class PostController extends Controller
{
    public function view($upload_id)
    {
        $user = User::all();
        $upload = DB::table('uploads')
                ->join('users','uploads.user_id', '=' , 'users.id')
                ->join('categories','categories.id', '=' , 'uploads.rentorsale')
                ->join('states','states.id', '=' , 'uploads.state')
                ->join('evaluations','evaluations.id', '=' , 'uploads.water')
                ->select('uploads.*', 'users.*', 'categories.category', 'states.state', 'evaluations.evaluation')
                ->where(['uploads.id' => $upload_id])
                ->get();
        $water = DB::table('uploads')
                ->join('evaluations','evaluations.id', '=' , 'water')
                ->select('evaluations.evaluation')
                ->where(['uploads.id' => $upload_id])
                ->get();
        $light = DB::table('uploads')
                ->join('evaluations','evaluations.id', '=' , 'light')
                ->select('evaluations.evaluation')
                ->where(['uploads.id' => $upload_id])
                ->get();
        $security = DB::table('uploads')
                ->join('evaluations','evaluations.id', '=' , 'security')
                ->select('evaluations.evaluation')
                ->where(['uploads.id' => $upload_id])
                ->get();
        $road = DB::table('uploads')
                ->join('evaluations','evaluations.id', '=' , 'road')
                ->select('evaluations.evaluation')
                ->where(['uploads.id' => $upload_id])
                ->get();
                // @ makes the variable optional
        @$keyword = DB::table('uploads')->select('uploads.*')
                   ->where(['uploads.id' => $upload_id])
                   ->first();
        @$similar = Upload::where('type', 'LIKE', '%'.$keyword->type.'%')
                  ->orWhere('location', 'LIKE', '%'.$keyword->location.'%')
                  ->orWhere('price', 'LIKE', '%'.$keyword->price.'%')
                  ->orWhere('rentorsale', 'LIKE', '%'.$keyword->rentorsale.'%')
                  ->join('categories','categories.id', '=' , 'uploads.rentorsale')
                  ->join('states','states.id', '=' , 'uploads.state')
                  ->select('uploads.*', 'categories.category', 'states.state')
                  ->orderBy('id', 'desc')
                  ->limit(6)
                  ->get();
        $moreimages = DB::table('uploads')
                ->join('addpictures','uploads.id', '=' , 'addpictures.upload_id')
                ->select('addpictures.*')
                ->where(['uploads.id' => $upload_id])
                ->get();
        $reviews = DB::table('reviews')
                ->join('uploads','uploads.user_id', '=' , 'reviews.user_id')
                ->select('reviews.*')
                ->where(['uploads.id' => $upload_id])
                ->count();
        return view('post.view', ['upload' => $upload, 'moreimages' => $moreimages, 'keyword' => $keyword, 'similar' => $similar, 'reviews' => $reviews, 'water' => $water, 'light' => $light, 'security' => $security, 'road' => $road, ]);
    }

    public function upload()
    {
        // controlls views to the upload page
        $categories = Category::all();
        $states = State::all();
        $evaluation = Evaluation::all();
        return view('post.upload', ['categories' => $categories, 'states' => $states, 'evaluation' => $evaluation]);
    }

    public function profile()
    {
        // controlls views to the profile page
        return view('post.profile');
    }

    public function edit($upload_id)
    {
        $category = Category::all();
        $state = State::all();
        $evaluation = Evaluation::all();
        $upload = Upload::find($upload_id);
        return view('post.edit',['upload' => $upload, 'category' => $category, 'state' => $state,
                'evaluation' => $evaluation]);
    }

    public function editUpload(Request $request, $upload_id)
    {
        $evaluation = Evaluation::all();
        $categories = Category::all();
        $states = State::all();
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
        $uploads = new Upload;
        $uploads->user_id = Auth::user()->id;
        $uploads->phone = $request->input('phone');
        $uploads->type = $request->input('type');
        $uploads->location = $request->input('location');
        $uploads->state = $request->input('state');
        $uploads->price = $request->input('price');
        $uploads->rentorsale = $request->input('rentorsale');
        $uploads->water = $request->input('water');
        $uploads->light = $request->input('light');
        $uploads->security = $request->input('security');
        $uploads->road = $request->input('road');
        $uploads->additional_info = $request->input('additional_info');
        $uploads->slugline = str_slug($request->input('type'));

        $data = array(
            'phone' => $uploads->phone,
            'type' => $uploads->type,
            'location' => $uploads->location,
            'state' => $uploads->state,
            'price' => $uploads->price,
            'rentorsale' => $uploads->rentorsale,
            'water' => $uploads->water,
            'light' => $uploads->light,
            'security' => $uploads->security,
            'road' => $uploads->road,
            'additional_info' => $uploads->additional_info,
            'slugline' => $uploads->slugline,
        );
        Upload::where('id', $upload_id)->update($data);
        $uploads->update();
        return redirect('/home')->with('response', 'Edited Successfully');
    }


    public function addpics($upload_id)
    {
        $upload = Upload::find($upload_id);
        return view('post.addpics',['upload' => $upload]);
    }

    public function addMorePics(Request $request, $upload_id)
    {
        //recieves the data from the form and inputes to the database
        $this->validate($request, [
            'image' => 'required',
        ]);
        $addmores = new Addpicture;
        $addmores->upload_id = $upload_id;
        if(Input::hasFile('image')){
            $file = Input::file('image');
            $file->move(public_path(). '/uploads/', time());
            $url = URL::to('/') . '/uploads/'. time();
        }
        $addmores->image = $url;
        $addmores->save();
        return redirect('/home')->with('response', 'Picture Uploaded, Upload More...');
    }


    public function uploadpost(Request $request)
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
            'picture' => 'required',
        ]);
        $uploads = new Upload;
        $uploads->user_id = Auth::user()->id;
        $uploads->phone = $request->input('phone');
        $uploads->type = $request->input('type');
        $uploads->location = $request->input('location');
        $uploads->state = $request->input('state');
        $uploads->price = $request->input('price');
        $uploads->rentorsale = $request->input('rentorsale');
        $uploads->water = $request->input('water');
        $uploads->light = $request->input('light');
        $uploads->security = $request->input('security');
        $uploads->road = $request->input('road');
        $uploads->additional_info = $request->input('additional_info');
        $uploads->pid = bin2hex(random_bytes(3));
        $uploads->availability = 0;
        $uploads->slugline = str_slug($request->input('type'));
        if(Input::hasFile('picture')){
            $file = Input::file('picture');
            $file->move(public_path(). '/uploads/', time());
            $url = URL::to('/') . '/uploads/'. time();
        }
        $uploads->picture = $url;
        $uploads->save();
        return redirect('/upload')->with('response', 'Uploaded Successfully, Upload More...');
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        $states = State::all();
        $keyword = $request->input('search');
        $upload = Upload::where('type', 'LIKE', '%'.$keyword.'%')
                  ->orWhere('location', 'LIKE', '%'.$keyword.'%')
                  ->orWhere('price', 'LIKE', '%'.$keyword.'%')
                  ->orWhere('pid', 'LIKE', '%'.$keyword.'%')
                    ->join('categories','categories.id', '=' , 'uploads.rentorsale')
                    ->join('states','states.id', '=' , 'uploads.state')
                    ->select('uploads.*', 'categories.category', 'states.state')
                  ->orderBy('id', 'desc')
                  ->simplePaginate(12);
        $noPictures = Nopicture::where('type', 'LIKE', '%'.$keyword.'%')
                  ->orWhere('location', 'LIKE', '%'.$keyword.'%')
                  ->orWhere('price', 'LIKE', '%'.$keyword.'%')
                  ->orWhere('pid', 'LIKE', '%'.$keyword.'%')
                    ->join('categories','categories.id', '=' , 'nopictures.rentorsale')
                    ->join('states','states.id', '=' , 'nopictures.state')
                    ->select('nopictures.*', 'categories.category', 'states.state')
                  ->orderBy('id', 'desc')
                  ->simplePaginate(5);
        $blog = DB::table('blogs')->orderBy('blogs.id', 'desc')
                ->join('admins','admins.id', '=' , 'blogs.admin_id')
                ->select('blogs.*', 'admins.name')
                ->limit(5)
                ->get();
        return view('post.search', ['upload' => $upload, 'categories' => $categories, 'states' => $states, 'blog' =>$blog, 'noPictures' => $noPictures]);
    }



    public function delete($upload_id)
    {
        Upload::where('id',$upload_id)->delete();
        return redirect('/home')->with('response', 'Deleted Successfully');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->password = $request->input('password');

        if ($user->password == $request->input('password_confirmation'))
        {
            $data = array(
            'name' => $user['name'],
            'password' => bcrypt($user['password']),
                    );
            User::where('id', $user->id)->update($data);
            $user->update();
            return redirect('/home')->with('response', 'Profile updated');
        } else {
            return redirect('/home')->with('response', 'Profile not updated');
        }
    }

    public function availability(Request $request, $upload_id)
    {
        $upload = Upload::find($upload_id);
        $availabilities = Availability::all();
        return view('post.availability', ['upload' => $upload, 'availabilities' => $availabilities]);
    }

    public function setAvailability(Request $request, $upload_id)
    {
        $availabilities = Availability::all();

        $this->validate($request, [
            'availability' => 'required',
        ]);
        $uploads = new Upload;
        $uploads->user_id = Auth::user()->id;
        $uploads->availability = $request->input('availability');

        $data = array(
            'availability' => $uploads->availability,
        );
        Upload::where('id', $upload_id)->update($data);
        $uploads->update();
        return redirect('/home')->with('response', 'Availability Set');
    }

    public function category($cat_id)
    {
        $categories = Category::all();
        $states = State::all();
        $upload = DB::table('uploads')
                ->join('categories','uploads.rentorsale', '=' , 'categories.id')
                ->join('states','uploads.rentorsale', '=' , 'states.id')
                ->select('uploads.*', 'categories.category', 'states.state')
                ->where(['uploads.rentorsale' => $cat_id])
                ->orderBy('uploads.id', 'desc')
                ->simplePaginate(12);
    $noPictures = DB::table('nopictures')
            ->join('users','nopictures.user_id', '=' , 'users.id')
            ->join('categories','categories.id', '=' , 'nopictures.rentorsale')
            ->join('states','states.id', '=' , 'nopictures.state')
            ->select('nopictures.*', 'users.*', 'categories.category', 'states.state')
            ->where(['nopictures.rentorsale' => $cat_id])
            ->orderBy('nopictures.id', 'desc')
            ->simplePaginate(5);
        $blog = Blog::all();
        return view('category.category', ['upload' => $upload, 'categories' => $categories,
                 'states' => $states, 'blog' => $blog, 'noPictures' => $noPictures]);
    }

    public function state($state_id)
    {
        $categories = Category::all();
        $states = State::all();
        $upload = DB::table('uploads')
                ->join('states','uploads.state', '=' , 'states.id')
                ->join('categories','uploads.rentorsale', '=' , 'categories.id')
                ->select('uploads.*', 'states.state', 'categories.category')
                ->where(['uploads.state' => $state_id])
                ->orderBy('uploads.id', 'desc')
                ->simplePaginate(12);
        $noPictures = DB::table('nopictures')
                ->join('users','nopictures.user_id', '=' , 'users.id')
                ->join('categories','categories.id', '=' , 'nopictures.rentorsale')
                ->join('states','states.id', '=' , 'nopictures.state')
                ->select('nopictures.*', 'users.*', 'categories.category', 'states.state')
                ->where(['nopictures.state' => $state_id])
                ->orderBy('nopictures.id', 'desc')
                ->simplePaginate(5);
        $blog = Blog::all();
        return view('state.state', ['upload' => $upload, 'categories' => $categories,
                 'states' => $states, 'blog' => $blog, 'noPictures' => $noPictures]);
    }

    public function blogForm()
    {
        $admin = Admin::all();
        $adminRank = Auth::user()->rank;
        return view('admin.blog', ['admin' => $admin, 'adminRank' => $adminRank]);
    }

    public function read($post_id)
    {
        $blog = DB::table('blogs')->orderBy('blogs.id', 'desc')
                ->join('admins','admins.id', '=' , 'blogs.admin_id')
                ->select('blogs.*', 'admins.name')
                ->where(['blogs.id' => $post_id])
                ->get();
        $otherposts = DB::table('blogs')->orderBy('blogs.id', 'desc')
                ->limit(10)->get();
        return view('admin.read', ['blog' => $blog, 'otherposts' => $otherposts]);
    }

    public function blog_titles()
    {
        $blog = DB::table('blogs')->orderBy('blogs.id', 'desc')->simplePaginate(20);

        return view('admin.blog_titles', ['blog' => $blog]);
    }

}