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
use App\Http\Controllers\website\WebsiteController;
use App\Http\Controllers\admin\SocialLinkController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\AboutUsController;
use App\Http\Controllers\admin\TopbarController;
use App\Http\Controllers\admin\MissionVisionController;
use App\Http\Controllers\website\ContactController;
use App\Http\Controllers\WebsiteCMSController;
use App\Http\Controllers\admin\PostPageLinkController;
use App\Http\Controllers\admin\GalleryController;


/* Website Start*/
Route::get('/',[WebsiteController::class,'index'])->name('website.index');
Route::get('/article',[WebsiteController::class,'article'])->name('website.articles');
Route::get('/article-details/{slug}',[WebsiteController::class,'articleDetails'])->name('website.article.details');
Route::get('/about-us',[WebsiteController::class,'about'])->name('website.about');
Route::get('/contact',[WebsiteController::class,'contact'])->name('website.contact');
Route::post('/contact-submit', [ContactController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/bulk-order', [WebsiteController::class, 'bulkOrder'])->name('bulk.order');
Route::post('/bulk-order-submit', [ContactController::class, 'bulkOrderSubmit'])->name('bulk.order.submit');
Route::get('/become-wholesaler', [WebsiteController::class, 'becomeWholesaler'])->name('become.wholesaler');
Route::post('/become-wholesaler-submit', [ContactController::class, 'becomeWholesalerSubmit'])->name('become.wholesaler.submit');
Route::get('/gallery', [GalleryController::class, 'gallery'])->name('website.gallery');

/* Website End*/
/* Admin Panel Start */
Route::get('/login',[AdminAuthController::class,'login'])->name('admin.login');
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
        Route::get('/article-create','create')->name('admin.article.create');
        Route::post('/article-store','store')->name('admin.article.store');
        Route::get('/article-edit/{slug}','edit')->name('admin.article.edit');
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
    Route::controller(SettingController::class)->group(function () {
        Route::get('/company-setting','companySetting')->name('admin.company.setting.index');
        Route::put('/company-setting-update/{id}','companySettingUpdate')->name('admin.company.setting.update');
        Route::get('/email-setting','emailSetting')->name('admin.email.setting.index');
        Route::put('/email-setting-update/{id}','emailSettingUpdate')->name('admin.email.setting.update');
    });
    Route::controller(WebsiteCMSController::class)->group(function () {
        Route::get('/cms-settings','index')->name('admin.cms.index');
        Route::post('/cms-settings-update','update')->name('admin.cms.update');
        Route::put('/cms-settings-update-value','updateValue')->name('admin.cms.value.update');
    });
    Route::controller(SocialLinkController::class)->group(function () {
        Route::get('/social-link','index')->name('admin.social.link.index');
        Route::post('/social-link-store','store')->name('admin.social.link.store');
        Route::put('/social-link-update/{id}','update')->name('admin.social.link.update');
        Route::delete('/social-link-delete/{id}','destroy')->name('admin.social.link.destroy');
    });
    Route::controller(SliderController::class)->group(function () {
        Route::get('/slider','index')->name('admin.slider.index');
        Route::post('/slider-store','store')->name('admin.slider.store');
        Route::put('/slider-update/{id}','update')->name('admin.slider.update');
        Route::delete('/slider-delete/{id}','destroy')->name('admin.slider.destroy');
    });
    Route::controller(AboutUsController::class)->group(function () {
        Route::get('/about','index')->name('admin.about.index');
        Route::put('/about-update/{id}','update')->name('admin.about.update');
    });
    Route::controller(TopbarController::class)->group(function () {
        Route::get('/topbar','index')->name('admin.topbar.index');
        Route::post('/topbar-store','store')->name('admin.topbar.store');
        Route::put('/topbar-update/{id}','update')->name('admin.topbar.update');
        Route::delete('/topbar-delete/{id}','destroy')->name('admin.topbar.destroy');
    });
    Route::controller(MissionVisionController::class)->group(function () {
        Route::get('/mission','index')->name('admin.mission.index');
        Route::post('/mission-store','store')->name('admin.mission.store');
        Route::put('/mission-update/{id}','update')->name('admin.mission.update');
        Route::delete('/mission-delete/{id}','destroy')->name('admin.mission.destroy');
    });
    Route::controller(PostPageLinkController::class)->group(function () {
        Route::get('/post-page-link','index')->name('admin.post.page.index');
        Route::post('/post-page-link-store','store')->name('admin.post.page.store');
        Route::put('/post-page-link-update/{id}','update')->name('admin.post.page.update');
        Route::delete('/post-page-link-delete/{id}','destroy')->name('admin.post.page.destroy');
    });
    Route::controller(GalleryController::class)->group(function () {
        Route::get('/gallery','index')->name('admin.gallery.index');
        Route::post('/gallery-store','store')->name('admin.gallery.store');
        Route::put('/gallery-update/{id}','update')->name('admin.gallery.update');
        Route::delete('/gallery-delete/{id}','destroy')->name('admin.gallery.destroy');
    });
    Route::get('/update-details',[AdminAuthController::class,'userDetails'])->name('admin.user.details');
    Route::put('/update-details-update',[AdminAuthController::class,'userDetailsUpdate'])->name('admin.user.details.update');
    Route::get('/update-password',[AdminAuthController::class,'userPasswordChange'])->name('admin.pass.change');
    Route::put('/update-password-submit',[AdminAuthController::class,'userPasswordChangeSubmit'])->name('admin.pass.update');

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});
/* Admin Panel End */


