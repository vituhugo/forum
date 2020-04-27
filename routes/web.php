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

Route::auth();
Route::middleware('auth')->group(function() {

    Route::get('/', 'ModuleController@index')->name('home');
    Route::get('/change', 'ModuleController@change')->name('module.change');
    Route::get('/search', 'SearchController@pesquisa')->name('search');

    Route::resource('issue', 'IssueController');
    Route::post('issue/{issue}/comment', 'IssueController@comment')->name('issue.comment');
    Route::post('issue/{issue}/favorite', 'IssueController@favorite')->name('issue.favorite');
    Route::post('issue/{issue}/follow', 'IssueController@follow')->name('issue.follow');
    Route::post('issue/{issue}/like', 'IssueController@like')->name('issue.like');
    Route::post('issue/{issue}/unlike', 'IssueController@unlike')->name('issue.unlike');
    Route::delete('issue/{issue}/comment/{comment}', 'IssueController@commentDestroy')->name('issue.comment_destroy');

    Route::resource('article', 'ArticleController');

    Route::get('/module/{module}', 'ModuleController@show')->name('module.show');
    Route::get('/module', 'ModuleController@index')->name('module.index');
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile/update', 'ProfileController@update')->name('profile.update');
    Route::get('/profile/password', 'ProfileController@password')->name('profile.password');
    Route::put('/profile/change-password', 'ProfileController@changePassword')->name('profile.change_password');
    Route::get('/profile/history', 'ProfileController@changePassword')->name('profile.history');
    Route::get('/profile/favorite', 'ProfileController@favorite')->name('profile.favorite');
    Route::get('/profile/open', 'ProfileController@open')->name('profile.open');
    Route::get('/profile/close', 'ProfileController@close')->name('profile.close');
    Route::get('/profile/user/{user}', 'ProfileController@show')->name('profile.show');

    Route::get('/module/{module}/subject/{subject}', 'SubjectController@show')->name('subject.show');

    Route::resource('issue/{issue}/answer', 'AnswerController')->only(['store', 'edit','update', 'destroy']);
    Route::post('issue/{issue}/answer/{answer}/comment', 'AnswerController@comment')->name('answer.comment');
    Route::delete('issue/{issue}/answer/{answer}/comment/{comment}', 'AnswerController@commentDestroy')->name('answer.comment_destroy');


});
