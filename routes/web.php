<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::fallback(function () {
    return "<h1>Sorry, the page you are looking for is not exist.</h1>";
});

Route::get('/', function () {
    return view('welcome');
});
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');
Route::controller(ContactController::class)->name('contacts.')->group(function () {
    Route::get('/contacts', 'index')->name('index');
    Route::get('/contacts/create', 'create')->name('create');
    Route::post('/contacts/store', 'store')->name('store');
    Route::get('/contacts/{id}', 'show')->name('show');
});
Route::resource('/companies', CompanyController::class);
Route::resources([
	'tags' => TagController::class,
	'taks' => TaskController::class
]);
Route::resource('/activities', ActivityController::class)->only([
	'index','store','edit','update','destroy'
]);
Route::resource('/contacts.notes', ContactNoteController::class);
Route::resource('/contacts.notes', ContactNoteController::class)->shallow();
Route::controller(ContactController::class)->name('contacts.')->group(function(){
    Route::get('/contacts','index' )->name('index');
    Route::get('/contacts/create','create')->name('create');
    Route::post('/contacts/store','store')->name('store');
    Route::get('/contacts/{id}','show')->name('show');
    Route::get('/contacts/{id}/edit','edit')->name('edit');
    Route::put('/contacts/{id}','update')->name('update');
    Route::delete('/contacts/{id}','destroy')->name('destroy');
    });
    
