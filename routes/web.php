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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/change-password', 'HomeController@renderChangePasswordForm')->name('render-change-password-form');
Route::post('/change-password', 'HomeController@processChangePasswordForm')->name('process-change-password-form');
Route::get('/my-team', 'MyTeamController@index')->name('my-team');
Route::get('/invite-user', 'MyTeamController@renderInviteUserForm')->name('render-invite-user-form');
Route::post('/invite-user', 'MyTeamController@processInviteUserForm')->name('process-invite-user-form');
Route::get('/time-record', 'TimeRecordController@index')->name('time-record');
