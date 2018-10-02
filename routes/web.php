<?php

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
    return redirect()->route('category_list');
});

Route::get('category-list', 'CategoryController@index')->name('category_list');
Route::get('add-category', 'CategoryController@create')->name('create_category');
Route::post('add-category', 'CategoryController@store')->name('store_category');
Route::get('category/{id}', 'CategoryController@show')->name('show_category');
Route::post('category/{id}', 'CategoryController@edit')->name('edit_category');
Route::get('category-delete/{id}', 'CategoryController@delete')->name('delete_category');

Route::get('product-list', 'ProductController@index')->name('product_list');
Route::get('add-product', 'ProductController@create')->name('create_product');
Route::post('add-product', 'ProductController@store')->name('store_product');
Route::get('product/{id}', 'ProductController@show')->name('show_product');
Route::post('product/{id}', 'ProductController@edit')->name('edit_product');
Route::get('product-delete/{id}', 'ProductController@delete')->name('delete_product');