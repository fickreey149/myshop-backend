<?php

use App\Http\Livewire\Category;
use GuzzleHttp\Middleware;
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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/categories', function () {
        return view('admin.categories');
    })->name('categories');

    Route::get('/products', function () {
        return view('admin.products');
    })->name('products');
    Route::get('/transactions', function () {
        return view('admin.transactions');
    })->name('transactions');
});
