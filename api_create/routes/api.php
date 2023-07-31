<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Modelcontroller;
use App\Http\Controllers\Memberscontroller;
use App\Http\Controllers\InsertController;
use App\Http\Controllers\GetProduct;
use App\Http\Controllers\DeleteProduct;
use App\Http\Controllers\UpdateProduct;


Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('/get-data', [Modelcontroller::class, "data_list"]);
    Route::get('/get-data/{api}/{item?}', [Modelcontroller::class, "get_data"]);
    Route::post("/delete_token",[Memberscontroller::class,'delete_token']);

    Route::post('/create-product', [InsertController::class, 'Insert']);

    Route::get('/get-product/{item}/{value?}', [GetProduct::class, 'get_product']);
    Route::get('/get-product', [GetProduct::class, 'get_product_all']);

    Route::post('/delete-product', [DeleteProduct::class, 'delete_product']);

    Route::post('/update-product', [UpdateProduct::class, 'update_product']);
    });

    Route::post("/get_token_api",[Memberscontroller::class,'get_token_api']);
    Route::post("/login",[Modelcontroller::class,'login']);
    Route::post('/create-data', [Modelcontroller::class, "create_data"]);

