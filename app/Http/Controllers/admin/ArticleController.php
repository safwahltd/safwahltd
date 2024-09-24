<?php

namespace App\Http\Controllers\admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Exception;

class ArticleController extends Controller
{
    public function index(){
        if(auth()->user()->hasPermission('admin article index')){
            $articles = Article::orderBy('serial','ASC')->paginate(20);
            return view('admin.article.index',compact('articles'));
        }
        else{
            toastr()->error('You Have No Permission.');
            return back();
        }
    }
    public function create(){
        return view('admin.article.add');
    }
    public function store(Request $request){
        if(auth()->user()->hasPermission('admin article store')){
        try{
            $validate = Validator::make($request->all(),[
                'title' => 'required|string|max:255',
                'slug' => ['required', 'string', 'max:255'],
                "thumbnail"         => [
                    'image',
                    'mimes:jpg,png,jpeg,gif,svg,webp',
                    'dimensions:min_width=550,min_height=350,max_width=550,max_height=350'
                ],
            ]);
            if($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            // Use the helper function to generate a unique slug
            $slug = createUniqueSlug($request->title, Article::class);

            $article = new Article();
            $article->title = $request->title;
            $article->slug = $slug;
            $article->short_description = $request->short_description;
            $article->long_description = $request->long_description;
            if ($request->file('thumbnail')){
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = $thumbnail->getClientOriginalName();
                $directory = 'upload/article/';
                $thumbnail->move($directory,$thumbnailName);
                $thumbnailUrl = $directory.$thumbnailName;
                $article->thumbnail = $thumbnailUrl;
            }
            if ($request->serial){
                $articleCount = Article::count();
                $articleSerial = Article::where('serial',$request->serial)->first();
                if ($articleSerial){
                    $articleSerial->serial = $articleCount + 1;
                    $articleSerial->save();
                    $article->serial = $request->serial;
                }
                else{
                    $article->serial = $articleCount + 1;
                }
            }
            else{
                $articleCount = Article::count();
                $article->serial = $articleCount + 1;
            }

            $article->url = $request->url;
            $article->status = $request->status;
            $article->save();
            toastr()->success('Article Create Successfully.');
            return back();
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
        }
        else{
            toastr()->error('You Have No Permission.');
            return back();
        }
    }
    public function edit($slug){
        $article = Article::where('slug',$slug)->first();
        return view('admin.article.edit',compact('article'));
    }
    public function update(Request $request,$id){
        if(auth()->user()->hasPermission('admin article update')){
        try{
            $article = Article::find($id);
            $validate = Validator::make($request->all(),[
                'title' => 'required',
                'slug' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('articles')->ignore($article->id)
                ],
                "thumbnail"         => [
                    'image',
                    'mimes:jpg,png,jpeg,gif,svg,webp',
                    'dimensions:min_width=550,min_height=350,max_width=550,max_height=350'
                ],
            ]);
            if($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            if ($article->title == $request->title){
                $article->slug = $article->slug;
            }
            else{
                $article->slug = createUniqueSlug($request->title, Article::class);
            }

            $article->title = $request->title;
            $article->short_description = $request->short_description;
            $article->long_description = $request->long_description;
            if ($request->file('thumbnail')){
                if (file_exists($article->thumbnail)){
                    unlink($article->thumbnail);
                }
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = $thumbnail->getClientOriginalName();
                $directory = 'upload/product/thumbnail/';
                $thumbnail->move($directory,$thumbnailName);
                $thumbnailUrl = $directory.$thumbnailName;
                $article->thumbnail = $thumbnailUrl;
            }
            if ($request->serial == $article->serial){
                $article->serial = $request->serial;
            }
            else{
                $articleCount = Article::count();
                $articleSerial = Article::where('serial',$request->serial)->first();
                if ($articleSerial){
                    $articleSerial->serial = $article->serial;
                    $articleSerial->save();
                    $article->serial = $request->serial;
                }
                else{
                    $article->serial = $request->serial;
                }
            }
            $article->url = $request->url;
            $article->status = $request->status;
            $article->save();
            toastr()->success('Article Update Successfully.');
            return redirect()->route('admin.article.index');
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
        }
        else{
            toastr()->error('You Have No Permission.');
            return back();
        }
    }
    public function destroy($id){
        if(auth()->user()->hasPermission('admin article destroy')){
        try{
            $article = Article::find($id);
            if (file_exists($article->thumbnail)){
                unlink($article->thumbnail);
            }
            $article->delete();
            toastr()->success('product Delete Successfully.');
            return back();
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
        }
        else{
            toastr()->error('You Have No Permission.');
            return back();
        }
    }

}
