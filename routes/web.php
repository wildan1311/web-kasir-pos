<?php

use App\Http\Controllers\product;
use App\Http\Controllers\purchase;
use App\Models\cart;
use App\Models\product as ModelsProduct;
use Illuminate\Support\Facades\Route;

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
    $product = ModelsProduct::get();
    $cart = new cart();
    return view('main', [
        'product'=>$product,
        'cart'=>$cart,
    ]);
});
Route::get('/add-product', function () {
    return view('add-product');
});
Route::POST('/product', [product::class, 'store']);
Route::GET('/product/{id}', [product::class, 'show']);
Route::get('/product/{id}/edit', [product::class, 'edit']);
Route::put('/product/{id}/update', [product::class, 'update']);

Route::POST('/purchase/{id}', [purchase::class, 'transaction']);
Route::get('/report', function () {
    return view('report');
});


