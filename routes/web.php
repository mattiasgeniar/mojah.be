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

Route::feeds();

Route::get('mailing-list', 'MailingListController@index');
Route::get('mailing-list/author/{id}', 'MailingListController@showAuthor');
Route::get('mailing-list/{slug}', 'MailingListController@showTopics');
Route::get('mailing-list/{slug}/{topic}', 'MailingListController@showTopic');
