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
// USER ROUTE
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::get('/profile', 'ProfileController@index')->name('user.profile');
Route::get('/profile/{id}', 'ProfileController@index2')->name('user.visit_profile');

Route::put('/profile/update', 'ProfileController@update')->name('user.profile_update');

Route::get('autocomplete', 'SearchController@autocomplete')->name('user.search_autocomplete'); // route for search typeahead
Route::get('/result', 'SearchController@searchResult')->name('user.search_result');

Route::post('/friend' , 'FriendController@index')->name('user.add_friend')->middleware('auth');
// ADMIN ROUTE
Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.home');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login.form');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});


// GLOBAL SHARABLE DATA
View::composer(['*'], function ($view) {
    if (Auth::check()) {
        $auth_details = Auth::user();
        $auth_profile = Auth::user()->profile;
        $view->with('auth_details', $auth_details)->with('auth_profile', $auth_profile);
    }
});
