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

//HomeController
Route::get('/', 'HomeController@index')->name('home');
Route::get('/change-password', 'HomeController@renderChangePasswordForm')->name('render-change-password-form');
Route::post('/change-password', 'HomeController@processChangePasswordForm')->name('process-change-password-form');

//MyTeamController
Route::get('/my-team', 'MyTeamController@index')->name('my-team');
Route::get('/invite-user', 'MyTeamController@renderInviteUserForm')->name('render-invite-user-form');
Route::post('/invite-user', 'MyTeamController@processInviteUserForm')->name('process-invite-user-form');
Route::post('/toogle-role', 'MyTeamController@processToogleRoleForm')->name('process-toogle-role-form');
Route::post('/remove-user', 'MyTeamController@processRemoveUserForm')->name('process-remove-user-form');

//TimeRecordController
Route::get('/time-record', 'TimeRecordController@index')->name('time-record');
Route::get('/create-time-record', 'TimeRecordController@renderCreateTimeRecordForm')->name('render-create-time-record-form');
Route::post('/create-time-record', 'TimeRecordController@processCreateTimeRecordForm')->name('process-create-time-record-form');
Route::post('/remove-time-record', 'TimeRecordController@processRemoveTimeRecordForm')->name('process-remove-time-record-form');
