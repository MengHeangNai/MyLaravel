<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    $html = "<h1>Contact App</h1>
    <div>
    <a href='" . route('contacts.index') . "'>All contacts</a>
    <a href='" . route('contacts.create') . "'>Add contact</a>
    <a href='" . route('contacts.show', 1) . "'>Show contact</a>
    </div>
    ";
    return $html;
});

Route::get('/contacts', function () {
    return "<h1>All contacts</h1>";
})->name('contacts.index');
Route::get('/contacts/create', function () {
    return "<h1>Add new contact</h1>";
})->name('contacts.create');
Route::get('/contacts/{id}', function ($id) {
    return "Contact " . $id;
})->whereNumber('id')->name('contacts.show');

Route::get('/', function () {
    $html = "
    <h1>Contact App</h1>
    <div>
    <a href='" . route('admin.contacts.index') . "'>All contacts</a>
    <a href='" . route('admin.contacts.create') . "'>Add contact</a>
    <a href='" . route('admin.contacts.show', 2) . "'>Show contact</a>
    </div>
    ";
    return $html;
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/contacts', function () {
        return "<h1>All contacts</h1>";
    })->name('contacts.index');
    Route::get('/contacts/create', function () {
        return "<h1>Add new contact</h1>";
    })->name('contacts.create');
    Route::get('/contacts/{id}', function ($id) {
        return "Contact " . $id;
    })->whereNumber('id')->name('contacts.show');
});

Route::fallback(function () {
	return "<h1>Sorry, the page does not exist</h1>";
});

