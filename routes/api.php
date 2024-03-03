<?php

use Illuminate\Http\Request;

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

//API

// Clientes
Route::get('/clientes', 'API\ApiClientController@getClientAPI');
Route::get('/clientes/{cliente}', 'API\ApiClientController@showClientAPI');
Route::post('/clientes', 'API\ApiClientController@postClientAPI');
Route::put('/clientes/{cliente}', 'API\ApiClientController@updateClientAPI');
Route::delete('/clientes/{cliente}', 'API\ApiClientController@deleteClientAPI');


// Proveedor
Route::get('/proveedores', 'API\ApiProveedorController@getClientAPI');

// Categorías
Route::get('/categorias', 'API\ApiCategoryController@getCategoryAPI');
Route::get('/categorias/{categoria}', 'API\ApiCategoryController@showCategoryAPI');
Route::post('/categorias', 'API\ApiCategoryController@postCategoryAPI');
Route::put('/categorias/{categoria}', 'API\ApiCategoryController@updateCategoryAPI');
Route::delete('/categorias/{categoria}', 'API\ApiCategoryController@deleteCategoryAPI');

// Productos
Route::get('/productos', 'API\ApiProductController@getProductAPI');
Route::get('/productos/{producto}', 'API\ApiProductController@showProductAPI');
Route::post('/productos', 'API\ApiProductController@postProductAPI');
Route::put('/productos/{producto}', 'API\ApiProductController@updateProductAPI');
Route::delete('/productos/{producto}', 'API\ApiProductController@deleteProductAPI');
Route::get('/productos-categoria/{categoria}','API\ApiProductController@getCategoryProducts');
Route::get('/productos-frecuentes', 'API\ApiProductController@getFrequent');

// Listar Usuarios
Route::get('/usuarios', 'API\ApiUserController@getUserAPI');

// Login
Route::post('/login', 'API\ApiLoginController@login');

// Ventas
Route::post('/ventas/save', 'API\ApiSellController@postAPI');
Route::get('/ventas', 'API\ApiSellController@getSellAPI');
Route::get('dolar', 'TasaController@getDolar')->name('dolar.api');


/*----------------------------------- Interno APP---------------------------------------------*/

Route::prefix('v1')->namespace('API\Backend')->group(function () {
	Route::post('customer/save', 'CustomersController@post')->name('api.v1.customer.save');

	// Frequest products
	Route::get('products', 'ProductsController@getFrequent')->name('api.v1.products.frequent');
	Route::get('category/{category}/products', 'ProductsController@getCategoryProducts')->name('api.v1.category.frequent');
	Route::get('product-by-barcode/{barcode}','ProductsController@getProductByBarcode')->name('api.v1.product.by_barcode');

	//Product by search
	Route::get('product-by-search/{search}','ProductsController@getProductBySearch')->name('api.v1.product.by_search');

	//post sell by pos
	Route::post('pos/save', 'SellController@posPost')->name('api.v1.sell.save');

});
