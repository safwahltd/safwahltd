<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AboutUs;
use App\Models\Permission;
use App\Models\Setting;
use App\Models\User;
use App\Models\WebsiteCMS;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $email = 'info@safwahltd.com';
        $user = User::where('email',$email)->first();
        if (!$user){
            \App\Models\User::create([
                'id' => 1,
                'name' => 'Super Admin',
                'email' => $email,
                'password' => bcrypt('info@safwahltd.com'),
                'role' => 'admin',
            ]);
        }

        /* Role Permission */
        $routeCollection = Route::getRoutes();
        $middlewareGroup = 'admin.auth';
        $routeNames = [];
        foreach ($routeCollection as $route){
            $middleWares = $route->gatherMiddleware();
            if (in_array($middlewareGroup,$middleWares)){
                $routeName = $route->getName();
                if ($routeName !== 'admin.dashboard' && $routeName !== 'admin.logout'){
                    array_push($routeNames,$routeName);
                }
            }
        }
        foreach ($routeNames as $name) {
            if(!empty($name)) {
                $permission = $name;
                $permission = trim(strtolower($permission));
                $permission = preg_replace('/[\s.,-]+/', ' ', $permission);
                $per = Permission::where('name',$permission)->first();
                if (!$per){
                    Permission::create([
                        'name' => $permission
                    ]);
                }
            }
        }

        /* Setting */
        $sitting = Setting::find(1);
        if (!$sitting){
            \App\Models\Setting::create([
                'id' => 1,
                'company_name' => 'SAFWAH LIMITED',
                'company_title' => 'A Path For Prosperity',
                'phone' => '+880 9611-656104',
                'hotLine' => '+880 9611-656104',
                'email' => 'safwahmart@gmail.com',
                'address' => 'Kha-9, Confidence Center, Level-10/B, Shahajadpur, Gulshan-2, Dhaka-1212, Bangladesh',
            ]);
        }
        $about = AboutUs::find(1);
        if (!$about){
            \App\Models\AboutUs::create([
                'id' => 1,
                'title' => 'SAFWAH LIMITED',
                'description' => 'A Path For Prosperity',
            ]);
        }
        $feature = WebsiteCMS::find(1);
        if (!$feature) {
            WebsiteCMS::create([
                'website_title' => 'SAFWAH LIMITED',
                'top_bar_bg_color' => 'black',
                'top_bar_text_color' => 'white',
                'header_bg_color' => '#b2beb5',
                'home_section_bg_color' => '#b2beb5',
                'footer_section_bg_color' => 'black',
                'contact_form_color' => '#b2beb5',
                'bulk_order_form_color' => '#b2beb5',
                'wholesaler_form_color' => '#b2beb5',
                'loading_image_status' => 1,
                'slider' => 1,
                'company_logo_header' => 1,
                'company_logo_footer' => 1,
                'footer_social_link' => 1,
                'google_map' => 1,
            ]);
        }
    }
}
