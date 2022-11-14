<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get api method
Route::get('product/list', [RouteController::class, 'ProductList']);
Route::get('category/list', [RouteController::class, 'CategoryList']);

//post api method
Route::post('create/category', [RouteController::class, 'CreateCategory']);
Route::post('create/contact', [RouteController::class, 'CreateContact']);

Route::get('delete/category/{id}', [RouteController::class, 'DeleteCategory']);
Route::get('category/list/{id}', [RouteController::class, 'CategoryDetail']);

Route::post('category/update', [RouteController::class, 'CategoryUpdate']);

/**
 *
 * product list
 * localhost::8000/api/product/list (GET)
 *
 * category list
 * localhost::8000/api/category/list (GET)
 *
 * create category
 * localhost::8000/api/create/category (POST)
 * body{
 *  name : ''
 * }
 *
 * localhost::8000/api/category/delete/{id} (GET)
 *
 * localhost::8000/api/category/list/{id} (GET, one list)
 *
 * Localhost::8000/api/category/update (POST)
 *
 * key => category_name, category_id
 *
 */
