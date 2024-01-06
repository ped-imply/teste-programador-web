<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Route::resource('/vendas', 'VendasController')->names('vendas')->parameters([
    'vendas' => 'venda'
]);

Route::get('/produtos/get-produtos', 'ProdutosController@getProdutos')->name('produtos.getProdutos');
