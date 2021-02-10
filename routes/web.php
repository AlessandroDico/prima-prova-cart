<?php

use Illuminate\Support\Facades\Route;
use App\Product;
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
    $newProduct = new Product();
    $products = $newProduct->all();
    $data = [
        'products' => $products
    ];

    return view('guest.welcome', $data);
})->name('casa');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/cart', 'Cart@index')->name('cart.index');
Route::post('/cart/{id}', 'Cart@add')->name('cart.send');
// rotta checkout
Route::get('/checkout', 'Cart@checkout')->name('checkout');
// Route::get('/checkout', 'ShopController@checkout')->name('checkout');
