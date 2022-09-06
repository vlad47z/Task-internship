<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ResizeController;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;
use Illuminate\Support\Facades\Cache;
use UniSharp\LaravelFilemanager\Middlewares\CreateDefaultFolder;
use UniSharp\LaravelFilemanager\Middlewares\MultiUser;
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


Route::get('/dashboard', function (){
    return view('dashboard');
});


Route::get('/', 'App\Http\Controllers\PagesController@index');
Auth::routes([
    'verify' => true,
]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('admin');

//Article
Route::resource('news', 'App\Http\Controllers\NewsController')->middleware('verified');
Route::resource('news', 'App\Http\Controllers\NewsController')->except(['show']);
Route::get('news/{slug}', 'App\Http\Controllers\NewsController@showWithSlug')->middleware('verified');
Route::get('news/create', 'App\Http\Controllers\NewsController@create')->middleware('verified', 'admin');
Route::get('news/{slug}/edit', 'App\Http\Controllers\NewsController@edit')->middleware('admin', 'verified');
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


//Socialite login
Route::get('login/google', 'App\Http\Controllers\GoogleController@loginWithGoogle')->name('login.google');
Route::get('login/google/callback', 'App\Http\Controllers\GoogleController@callbackFromGoogle')->name('callback.facebook');

Route::get('/login/facebook', 'App\Http\Controllers\FaceBookController@loginUsingFacebook')->name('login.facebook');
Route::get('/login/facebook/callback', 'App\Http\Controllers\FaceBookController@callbackFromFacebook')->name('callback.google');


//Settings menu
Route::get('users', 'App\Http\Controllers\UsersController@index')->name('users.index')->middleware('verified');
Route::get('users/profile', 'App\Http\Controllers\UsersController@edit')->name('users.edit-profile')->middleware('auth');
Route::put('users/profile', 'App\Http\Controllers\UsersController@update')->name('users.update-profile');
Route::get('users/change-password', 'App\Http\Controllers\UsersController@changePassword')->name('change-password');
Route::post('users/change-password', 'App\Http\Controllers\UsersController@updatePassword')->name('update-password');
Route::resource('users/panel', 'App\Http\Controllers\ResizeController')->middleware('admin');
Route::resource('users/panel', 'App\Http\Controllers\ResizeController')->except('show');
Route::get('users/panel', 'App\Http\Controllers\ResizeController@indexSize')->name('sizepanel')->middleware('admin');
Route::get('/file-resize', 'App\Http\Controllers\ResizeController@index');
Route::post('/resize-file', 'App\Http\Controllers\ResizeController@resizeImage')->name('resizeImage');
