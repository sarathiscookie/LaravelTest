<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| Web Routes for admin
|--------------------------------------------------------------------------
|
| Here is the web routes for admin.
|
*/
Route::prefix('admin')->group(function(){
	Route::group(['middleware' => ['auth', 'admin']], function () {
        // Admin dashboard
		Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
	});
});


/*
|--------------------------------------------------------------------------
| Web Routes for user
|--------------------------------------------------------------------------
|
| Here is the web routes for user.
|
*/
Route::prefix('user')->group(function(){
	Route::group(['middleware' => ['auth', 'user']], function () {
		// User dashboard
		Route::get('dashboard', 'User\DashboardController@index')->name('user.dashboard');
	});
});