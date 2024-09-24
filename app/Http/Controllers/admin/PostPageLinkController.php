<?php

namespace App\Http\Controllers\admin;

use App\Models\Article;
use App\Models\PostPageLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Exception;

class PostPageLinkController extends Controller
{
    public function index(){
        $postPageLinks = PostPageLink::latest()->paginate(20);
        $articles = Article::orderBy('title','asc')->where('url',null)->where('status',1)->get();
        return view('admin.post-page-link.index',compact('articles','postPageLinks'));
    }
    public function store(Request $request){
        try{
            $validate = Validator::make($request->all(),[
                'link' => 'required',
            ]);
            if($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            $s = new PostPageLink();
            $s->article_id = $request->article_id;
            $s->type = 'post';
            $s->link = $request->link;
            $s->status = $request->status;
            $s->save();
            toastr()->success('Create Success.');
            return back();
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
    public function update(Request $request,$id){
        try{
            $validate = Validator::make($request->all(),[
                'link' => 'required',
            ]);
            if($validate->fails()){
                toastr()->error($validate->messages());
                return back();
            }
            $s = PostPageLink::find($id);
            $s->article_id = $request->article_id;
            $s->type = 'post';
            $s->link = $request->link;
            $s->status = $request->status;
            $s->save();
            toastr()->success('Update Success.');
            return back();
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }
    public function destroy($id){
        try{
            $d = PostPageLink::find($id);
            $d->delete();
            toastr()->success('Delete Successfully.');
            return back();
        }
        catch(Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }

    }

}
