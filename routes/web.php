<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Sitemap\SitemapGenerator;
use App\Admin;
use App\Category;
use App\PropertyRequest;
use App\Review;
use App\Upload;
use App\State;
use App\Blog;
use App\User;


Route::get('/', function () {
    $upload = DB::table('uploads')->orderBy('id', 'desc')
                ->join('categories','categories.id', '=' , 'uploads.rentorsale')
                ->join('states','states.id', '=' , 'uploads.state')
                ->select('uploads.*', 'categories.category', 'states.state')
                ->orderBy('id', 'desc')
                ->simplePaginate(16);
    $noPictures = DB::table('nopictures')
            ->join('users','nopictures.user_id', '=' , 'users.id')
            ->join('categories','categories.id', '=' , 'nopictures.rentorsale')
            ->join('states','states.id', '=' , 'nopictures.state')
            ->select('nopictures.*', 'users.*', 'categories.category', 'states.state')
            ->orderBy('nopictures.id', 'desc')
            ->simplePaginate(5);
    $categories = Category::all();
    $states = State::all();
    $admin = Admin::all();
    $blog = DB::table('blogs')
            ->orderBy('blogs.id', 'desc')
            ->limit(5)
            ->get();
    return view('welcome', ['upload' => $upload, 'states' => $states, 'categories' => $categories, 'admin' => $admin, 'blog' => $blog, 'noPictures' => $noPictures]);
});

Route::post('/search', 'PostController@search');

Route::get('/view/{id}/{rentorsale}/{category}/{state}/{slugline}', 'PostController@view');

Route::get('/category/{id}', 'PostController@category');

Route::get('/state/{id}', 'PostController@state');

Route::get('/showRequests', 'RequestController@showRequests');

Route::post('/makeRequest', 'RequestController@makeRequest');
// ROUTES REQUIRING AUTH START HERE
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/upload', 'PostController@upload')->middleware('auth');

Route::get('/uploadWithoutPicture', 'NoPictureController@uploadWithoutPicture')->middleware('auth');

Route::get('/profile', 'PostController@profile')->middleware('auth');

Route::post('/updateProfile', 'PostController@updateProfile')->middleware('auth');

Route::post('/uploadpost', 'PostController@uploadpost')->middleware('auth');

Route::post('/withoutPictureUpload', 'NoPictureController@withoutPictureUpload')->middleware('auth');

Route::get('/edit/{upload_id}', 'PostController@edit')->middleware('auth');

Route::post('/editUpload/{id}', 'PostController@editUpload')->middleware('auth');

Route::get('/addpics/{upload_id}', 'PostController@addpics')->middleware('auth');

Route::post('/addMorePics/{id}', 'PostController@addMorePics')->middleware('auth');

Route::get('/availability/{id}', 'PostController@availability')->middleware('auth');

Route::post('/setAvailability/{id}', 'PostController@setAvailability')->middleware('auth');

Route::get('/delete/{id}', 'PostController@delete')->middleware('auth');

Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');



Route::post('/advertise', 'AdvertController@advertise');

Route::post('/registerAdmin', 'AdminController@registerAdmin');

Route::get('/admin/blog', 'PostController@blogForm');

Route::post('/blogpost', 'AdminController@blogpost');

Route::get('/read/{id}/{slugline}', 'PostController@read');

Route::get('/blog_titles', 'PostController@blog_titles');

Route::get('/hla', 'PostController@hla');

Route::prefix('admin')->group( function ()
{

    Route::get('/advert', 'AdvertController@advert');

    Route::get('/create-admin', 'AdminController@showRegistrationForm');

    Route::get('/reviews', 'ReviewController@reviews');

    Route::post('/reviewAgent', 'ReviewController@reviewAgent');

    Route::post('/updateReview/{id}', 'ReviewController@updateReview');

    Route::get('/transactions', 'ReviewController@transactions');

    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');

    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});