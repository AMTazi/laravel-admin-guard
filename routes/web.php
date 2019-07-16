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

//Auth::routes();

Route::group(['prefix' => 'admin'], function () {

	Route::group([], function () {

		Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.auth.show_login_form');

        Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.auth.login');

        Route::post('logout', 'Admin\Auth\LoginController@showLoginForm')->name('admin.auth.logout');

        Route::post('update-password', 'Admin\Auth\PasswordUpdateController@updatePassword')->name('admin.auth.password.update');

	});


	Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');

	Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

	Route::get('account', 'Admin\DashboardController@account')->name('admin.account');

	Route::post('add-moderator', 'Admin\DashboardController@addModerator')->name('admin.dashboard.add_moderator');

});
