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
    return view('welcome');
});

Route::get('/produto', function () {
    return view('produto');
});
Route::get('/estoque', function () {
    return view('estoque');
});
Route::get('/venda', function () {
    return view('venda');
});

Route::get('/produtos', 'ProdutoController@index');
Route::post('/produtos', 'ProdutoController@store');
Route::get('/produtos/{id}', 'ProdutoController@show');
Route::put('/produtos/{id}','ProdutoController@update');
Route::delete('/produtos/{id}','ProdutoController@destroy');

Route::get('/estoques', 'EstoqueController@index');
Route::post('/estoques', 'EstoqueController@store');
Route::get('/estoques/{id}', 'EstoqueController@show');
Route::put('/estoques/{id}','EstoqueController@update');
Route::delete('/estoques/{id}','EstoqueController@destroy');

Route::get('/vendas', 'VendaController@index');
Route::post('/vendas', 'VendaController@store');
Route::get('/vendas/{id}', 'VendaController@show');
Route::put('/vendas/{id}','VendaController@update');
Route::delete('/vendas/{id}','VendaController@destroy');

Route::get('/venda_items', 'VendaItemController@index');
Route::post('/venda_items', 'VendaItemController@store');
Route::get('/venda_items/{id}', 'VendaItemController@show');
Route::put('/venda_items/{id}','VendaItemController@update');
Route::delete('/venda_items/{id}','VendaItemController@destroy');


Auth::routes();

Route::get('/home', 'HomeController@index');
