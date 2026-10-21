<?php
namespace App\Http\Controllers;
use App\Models\{Category,User,Comment,Contact}; use Illuminate\Http\Request; use Illuminate\Support\Str;
class AdminController extends Controller {
 private function m($t){return ['categories'=>Category::class,'users'=>User::class,'comments'=>Comment::class,'contacts'=>Contact::class][$t];}
 function index($t){return view('admin.list',['t'=>$t,'rows'=>$this->m($t)::latest()->get()]);}
 function store(Request $r,$t){
  if($t=='categories'){$d=$r->validate(['name'=>'required','description'=>'nullable']);$d['slug']=Str::slug($d['name']);Category::create($d);}
  elseif($t=='users'){User::create($r->validate(['name'=>'required','email'=>'required|email|unique:users','password'=>'required|min:6','role'=>'required|in:admin,editor']));}
  return back()->with('ok','Đã thêm.');
 }
 function update(Request $r,$t,$id){
  if($t=='categories'){$d=$r->validate(['name'=>'required','description'=>'nullable']);$d['slug']=Str::slug($d['name']);Category::findOrFail($id)->update($d);}
  elseif($t=='comments')Comment::findOrFail($id)->update(['is_approved'=>1]);
  return back()->with('ok','Đã cập nhật.');
 }
 function destroy($t,$id){
  $o=$this->m($t)::findOrFail($id);
  if($t=='categories'&&$o->articles()->exists())return back()->withErrors(['x'=>'Chuyên mục đang có bài viết, không thể xóa.']);
  if($t=='users'&&($o->id==auth()->id()||$o->articles()->exists()))return back()->withErrors(['x'=>'Không thể xóa người dùng này (chính bạn hoặc đã có bài viết).']);
  $o->delete(); return back()->with('ok','Đã xóa.');
 }
}
