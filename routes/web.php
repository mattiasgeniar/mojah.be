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

Route::get('/', function () {
    return view('welcome');
});

Route::get('mailing-lists', 'MailingListController@index');
Route::get('mailing-lists/author/{id}', 'AuthorController@show');
Route::get('mailing-lists/{slug}', 'TopicController@index');
Route::get('mailing-list/{slug}/{topic}', 'TopicController@show');

Route::get('/api/v1/mailing-lists/{slug}', 'TopicApiController@index');
