<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\CoreValueController;
use App\Http\Controllers\admin\ConcernController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ArticleController;
use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\RolePermissionController;
use App\Http\Controllers\admin\AvailableShopController;
use App\Http\Controllers\admin\SettingController;


Route::get('/',[AdminAuthController::class,'login'])->name('admin.login');
Route::post('/admin/login-confirm', [AdminAuthController::class, 'loginConfirm'])->name('admin.login.confirm');

Route::middleware(['admin.auth'])->prefix('admin/')->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
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
    Route::controller(ArticleController::class)->group(function (){
        Route::get('/article','index')->name('admin.article.index');
        Route::post('/article-store','store')->name('admin.article.store');
        Route::put('/article-update/{id}','update')->name('admin.article.update');
        Route::delete('/article-destroy/{id}','destroy')->name('admin.article.destroy');
    });
    Route::controller(UserController::class)->group(function (){
        Route::get('/user','index')->name('admin.user.index');
        Route::post('/user-store','store')->name('admin.user.store');
        Route::put('/user-update/{id}','update')->name('admin.user.update');
        Route::delete('/user-destroy/{id}','destroy')->name('admin.user.destroy');
    });
    Route::controller(RolePermissionController::class)->group(function (){
        /* role */
        Route::get('/role','roleIndex')->name('admin.role.index');
        Route::post('/role-store','roleStore')->name('admin.role.store');
        Route::put('/role-update/{id}','roleUpdate')->name('admin.role.update');
        Route::delete('/role-destroy/{id}','roleDestroy')->name('admin.role.destroy');
        /* Permission */
        Route::get('/permission','permissionIndex')->name('admin.permission.index');
        Route::post('/permission-store','permissionStore')->name('admin.permission.store');
        Route::put('/permission-update/{id}','permissionUpdate')->name('admin.permission.update');
        Route::delete('/permission-destroy/{id}','permissionDestroy')->name('admin.permission.destroy');

    });
    Route::controller(AvailableShopController::class)->group(function (){
        Route::get('/shop','index')->name('admin.shop.index');
        Route::post('/shop-store','store')->name('admin.shop.store');
        Route::put('/shop-update/{id}','update')->name('admin.shop.update');
        Route::delete('/shop-destroy/{id}','destroy')->name('admin.shop.destroy');
    });
    Route::get('/company-setting',[SettingController::class,'companySetting'])->name('admin.company.setting.index');
    Route::put('/company-setting-update/{id}',[SettingController::class,'companySettingUpdate'])->name('admin.company.setting.update');
    Route::get('/email-setting',[SettingController::class,'emailSetting'])->name('admin.email.setting.index');
    Route::put('/email-setting-update/{id}',[SettingController::class,'emailSettingUpdate'])->name('admin.email.setting.update');

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});



