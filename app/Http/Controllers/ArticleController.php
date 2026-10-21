<?php
namespace App\Http\Controllers;
use App\Models\{Article,Category}; use Illuminate\Http\Request; use Illuminate\Support\Str;
class ArticleController extends Controller {
 private function own(Article $a){abort_unless(auth()->user()->role=='admin'||$a->user_id==auth()->id(),403);}
 function index(){$q=Article::with('category','user')->latest(); if(auth()->user()->role!='admin')$q->where('user_id',auth()->id()); return view('admin.articles',['rows'=>$q->paginate(15)]);}
 function create(){return view('admin.form',['a'=>new Article,'cats'=>Category::all()]);}
 private function data(Request $r){
  $d=$r->validate(['title'=>'required|max:255','summary'=>'nullable','content'=>'required','category_id'=>'required|exists:categories,id','status'=>'required|in:published,draft','image'=>'nullable|image|max:2048']);
  if($r->hasFile('image'))$d['image']=$r->file('image')->store('articles','public'); else unset($d['image']); return $d;
 }
 function store(Request $r){$d=$this->data($r);$d+=['user_id'=>auth()->id(),'slug'=>Str::slug($d['title']).'-'.time(),'published_at'=>now()];Article::create($d);return redirect('/admin/articles')->with('ok','Đã thêm bài viết.');}
 function edit(Article $article){$this->own($article);return view('admin.form',['a'=>$article,'cats'=>Category::all()]);}
 function update(Request $r,Article $article){$this->own($article);$article->update($this->data($r));return redirect('/admin/articles')->with('ok','Đã cập nhật.');}
 function destroy(Article $article){$this->own($article);$article->delete();return back()->with('ok','Đã xóa bài viết.');}
}
