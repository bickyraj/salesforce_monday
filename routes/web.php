<?php

use Illuminate\Support\Facades\Log;

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
Route::get('/dashboard', 'AdminController@index')->middleware('auth')->name('admin.dashboard');

Route::get('/authenticate', function()
{
    return Forrest::authenticate();
});

Route::get('/callback', function()
{
    Forrest::callback();
    return Redirect::to('/');
});

Route::get('/new', function() {
	$query = Forrest::query('SELECT Id FROM Account');
	dd($query);
});

Route::get('oauth/_salesforce-callback', 'SalesForceApiController@getAccessToken');
Route::get('/testsalesforce', 'SalesForceApiController@testsalesforce');

Route::get('/account', 'SalesController@accounts')->name('salesforce.account');
Route::post('/account', 'SalesController@store')->name('salesforce.account.store');
Route::patch('/account/{id}', 'SalesController@update')->name('salesforce.account.update');
Route::delete('/account/{id}', 'SalesController@destroy')->name('salesforce.account.delete');
Route::get('/add-account', 'SalesController@addAccount')->name('salesforce.account.add');
Route::get('/edit-account/{id}', 'SalesController@editAccount')->name('salesforce.account.edit');

Route::get('/createjob', 'SalesController@createJob');
Route::get('/jobs', 'SalesController@getAllJobs');
Route::get('/delete-jobs', 'SalesController@deleteJobs');
Route::get('/abort-jobs', 'SalesController@abortJob');
Route::get('/contact', 'SalesController@contacts')->name('salesforce.contact');
Route::post('/importcsv', 'SalesController@importCsv')->name('salesforce.import.csv');

Route::get('newjob', 'BulkController@newJob');

// 44.0 version bulk api.
Route::get('abortJobs/{id}', 'BulkController@abortJob');
Route::get('closeJobs/{id}', 'BulkController@closeJobs');
Route::get('createBatch/{id}', 'BulkController@createBatch');
Route::get('createAccountBatch/{id}', 'BulkController@createAccountBatch');
Route::get('batchInfo/{id}', 'BulkController@batchInfo');
Route::get('checkChanges', 'BulkController@checkChanges');

// monday graphQL
Route::get('monday/boards', 'MondayApiController@getBoards')->name('monday.boards');
Route::get('monday/board/{id}/detail', 'MondayApiController@getBoardDetail')->name('monday.board.detail');
Route::post('monday/board', 'MondayApiController@storeBoard')->name('monday.board.store');
Route::get('monday/board', 'MondayApiController@addBoard')->name('monday.board.add');
// Route::delete('/monday/board/{id}', 'MondayApiController@destroyBoard')->name('monday.board.delete');