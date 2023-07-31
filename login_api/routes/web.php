<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Routecontroller;
use App\Http\Controllers\Recordcontroller;
use App\Http\Controllers\Logincontroller;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\Editcontroller;
use App\Http\Controllers\Addcontroller;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [Routecontroller::class, "loginview"])->name('login');
Route::post('/login', [Logincontroller::class, "loginpost"])->name('loginpost');

Route::post('/home', [Routecontroller::class, "delete_token"])->name('homepost');
Route::get('/home', [Routecontroller::class, "homeview"])->name('home');

Route::get('/record', [Routecontroller::class, "recordview"])->name('record');

Route::post('/record', [Recordcontroller::class, "recordpost"])->name('recordpost');

Route::post('/home/delete', [DeleteController::class, "deletepost"])->name('deletepost');

Route::post('/home/refresh', [Routecontroller::class, "refresh"])->name('refresh');

Route::post('/home/edit', [Editcontroller::class, "edit"])->name('edit');

Route::post('/home/add', [Addcontroller::class, "addfunction"])->name('add');

?>
