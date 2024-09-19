<?php

namespace App\Providers;

use App\Models\AboutUs;
use App\Models\Setting;
use App\Models\SocialLink;
use App\Models\Topbar;
use App\Models\WebsiteCMS;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        View::composer(['*'],function ($view){
            $view->with([
                'company' => Setting::first(),
                'cms' => WebsiteCMS::first(),
                'socials' => SocialLink::orderBy('serial','asc')->where('status',1)->get(),
                'about' => AboutUs::where('status',1)->first(),
                'topBars' => Topbar::orderBy('serial','asc')->where('status',1)->get(),

            ]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
