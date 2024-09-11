<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\CoreValueController;
use App\Http\Controllers\admin\ConcernController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ArticleController;


Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');
Route::controller(CoreValueController::class)->group(function (){
    Route::get('/core-value','index')->name('admin.core.value.index');
    Route::post('/core-value-store','store')->name('admin.core.value.store');
    Route::put('/core-value-update/{id}','update')->name('admin.core.value.update');
    Route::delete('/core-value-destroy/{id}','destroy')->name('admin.core.value.destroy');
});
Route::controller(ConcernController::class)->group(function (){
    Route::get('/concern','index')->name('admin.concern.index');
    Route::post('/concern-store','store')->name('admin.concern.store');
    Route::put('/concern-update/{id}','update')->name('admin.concern.update');
    Route::delete('/concern-destroy/{id}','destroy')->name('admin.concern.destroy');
});
Route::controller(ProductController::class)->group(function (){
    Route::get('/product','index')->name('admin.product.index');
    Route::post('/product-store','store')->name('admin.product.store');
    Route::put('/product-update/{id}','update')->name('admin.product.update');
    Route::delete('/product-destroy/{id}','destroy')->name('admin.product.destroy');
});



