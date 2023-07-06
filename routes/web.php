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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('debtor','App\Http\Controllers\DebtorController')->middleware('auth');
Route::resource('bill','App\Http\Controllers\BillController')->middleware('auth');


Route::get('debit/{debits}/edit', 'App\Http\Controllers\DebitsController@edit')->name('debit.edit');
Route::put('debit/{debits}', 'App\Http\Controllers\DebitsController@update')->name('debit.update');
Route::get('debit', 'App\Http\Controllers\DebitsController@index')->name('debit.index');
Route::get('debit/create', 'App\Http\Controllers\DebitsController@create')->name('debit.create');
Route::delete('debit/{debits}', 'App\Http\Controllers\DebitsController@destroy')->name('debit.destroy');
Route::post('debit', 'App\Http\Controllers\DebitsController@store')->name('debit.store');


Route::get('bill/{bill}/quitar', 'App\Http\Controllers\BillController@quitar')->name('bill.quitar');
Route::post('bill/pesquisar', 'App\Http\Controllers\BillController@pesquisar')->name('bill.pesquisar');
Route::get('bill/principal/{invalid}', 'App\Http\Controllers\BillController@principal')->name('bill.principal');