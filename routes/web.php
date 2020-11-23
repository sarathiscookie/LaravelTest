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

		// User status update
		Route::put('dashboard/user/status/update', 'Admin\DashboardController@update')->name('admin.dashboard.user.status.update');
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
        
        /* Store profile details */
		Route::post('/dashboard/store', 'User\DashboardController@store')->name('user.dashboard.store');
		
		/* Change password */
        Route::post('/dashboard/password/change', 'User\DashboardController@updatePassword')->name('user.dashboard.password.change');
	});
});