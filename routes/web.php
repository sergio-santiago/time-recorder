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
Route::get('/my-team', 'MyTeamController@index')->name('my-team')->middleware('hasCompany');
Route::get('/invite-user', 'MyTeamController@renderInviteUserForm')->name('render-invite-user-form')->middleware('isAdmin', 'hasCompany');
Route::post('/invite-user', 'MyTeamController@processInviteUserForm')->name('process-invite-user-form')->middleware('isAdmin', 'hasCompany');
Route::post('/toogle-role', 'MyTeamController@processToogleRoleForm')->name('process-toogle-role-form')->middleware('isAdmin', 'hasCompany');
Route::post('/remove-user', 'MyTeamController@processRemoveUserForm')->name('process-remove-user-form')->middleware('isAdmin', 'hasCompany');

//TimeRecordController
Route::get('/time-record', 'TimeRecordController@index')->name('time-record')->middleware('hasCompany');
Route::get('/create-time-record', 'TimeRecordController@renderCreateTimeRecordForm')->name('render-create-time-record-form')->middleware('hasCompany');
Route::post('/create-time-record', 'TimeRecordController@processCreateTimeRecordForm')->name('process-create-time-record-form')->middleware('hasCompany');
Route::post('/remove-time-record', 'TimeRecordController@processRemoveTimeRecordForm')->name('process-remove-time-record-form')->middleware('hasCompany');

//SearchTimeRecordsController
Route::get('/search-time-records', 'SearchTimeRecordsController@renderSearchTimeRecordsForm')->name('render-search-time-records-form')->middleware('hasCompany');
Route::post('/search-time-records', 'SearchTimeRecordsController@processSearchTimeRecordsForm')->name('process-search-time-records-form')->middleware('hasCompany');
