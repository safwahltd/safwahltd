<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\AvailableShop;
use App\Models\Concern;
use App\Models\CoreValue;
use App\Models\MissionVision;
use App\Models\Permission;
use App\Models\Product;
use App\Models\Role;
use App\Models\Slider;
use App\Models\SocialLink;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCore = CoreValue::count();
        $totalConcern = Concern::count();
        $totalMission = MissionVision::count();
        $totalProduct = Product::count();
        $totalArticle = Article::count();
        $totalShop = AvailableShop::count();
        $totalSocial = SocialLink::count();
        $totalSlider = Slider::count();
        $totalRole = Role::count();
        $totalPermission = Permission::count();
        $totalUser = User::count();
        return view('admin.dashboard.index',
            compact('totalCore','totalConcern',
                'totalMission','totalProduct','totalArticle',
                'totalShop','totalSocial','totalSlider','totalRole','totalPermission','totalUser')
        );
    }
}
