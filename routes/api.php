<?php

use Illuminate\Http\Request;
use App\Product;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
**Basic Routes for a RESTful service:
**Route::get($uri, $callback);
**Route::post($uri, $callback);
**Route::put($uri, $callback);
**Route::delete($uri, $callback);
**
*/


Route::get('products', 'ProductsController@index')->middleware('cors');
// Route::get('purchases', 'ProductsController@showAll')->middleware('cors');
// Route::get('purchases/{entity}/{id}', 'ProductsController@filter')->middleware('cors');

Route::get('products/{product}', 'ProductsController@show');

Route::post('products','ProductsController@store')->middleware('cors');

Route::put('products/{product}','ProductsController@update');

Route::delete('products/{product}', 'ProductsController@delete');

// Fix API path
Route::get('purchases', 'ProductsController@lastPurchased')->middleware('cors');
Route::get('purchasehistory/{key}', 'ProductsController@purchasesHistory')->middleware('cors');
Route::get('searchproducts/{key}', 'ProductsController@listProduct')->middleware('cors');
Route::get('categories', 'ProductsController@listCategories')->middleware('cors');
Route::get('unitsize', 'ProductsController@listUnits')->middleware('cors');