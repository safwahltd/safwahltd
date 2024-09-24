<?php

namespace App\Http\Controllers\website;

use App\Models\Article;
use App\Models\AvailableShop;
use App\Models\Concern;
use App\Models\CoreValue;
use App\Models\MissionVision;
use App\Models\PostPageLink;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{
    public function index(){
        $sliders = Slider::where('status',1)->orderBy('serial','asc')->get();
        $coreValues = CoreValue::where('status',1)->orderBy('serial','asc')->get();
        $concerns = Concern::where('status',1)->orderBy('serial','asc')->get();
        $products = Product::where('status',1)->orderBy('serial','asc')->get();
        $articles = Article::where('status',1)->latest()->get()->take(3);
        $shops = AvailableShop::where('status',1)->orderBy('serial','asc')->get();
        $missions = MissionVision::where('status',1)->orderBy('serial','asc')->get();
        return view('website.home.index',compact('sliders','coreValues','concerns','products','articles','shops','missions'));
    }
    public function contact(){
        return view('website.contact.index');
    }
    public function article(){
        $articles = Article::where('status',1)->latest()->get();
        return view('website.article.index',compact('articles'));
    }
    public function articleDetails($slug){
        $article = Article::where('slug',$slug)->where('status',1)->first();
        $articles = Article::whereNotIn('id',[$article->id])->get()->take(10);
        $links = PostPageLink::where('article_id',$article->id)->get();
        return view('website.article.article-details',compact('article','articles','links'));
    }
    public function bulkOrder(){
        return view('website.bulk-order.index');
    }
    public function becomeWholesaler(){
        return view('website.wholeSaler.index');
    }
}
