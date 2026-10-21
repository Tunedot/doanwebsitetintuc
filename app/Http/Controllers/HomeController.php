<?php
namespace App\Http\Controllers;
use App\Models\{Article,Contact}; use Illuminate\Http\Request; use Illuminate\Support\Facades\Auth;
class HomeController extends Controller {
 function index(Request $r){
  $q=Article::with('category')->where('status','published')->latest('published_at');
  if($s=$r->q)$q->where(fn($x)=>$x->where('title','like',"%$s%")->orWhere('summary','like',"%$s%"));
  if($r->cat)$q->whereHas('category',fn($x)=>$x->where('slug',$r->cat));
  return view('home',['articles'=>$q->paginate(6),'top'=>Article::where('status','published')->orderByDesc('views')->take(5)->get()]);
 }
 function show($slug){
  $a=Article::where('slug',$slug)->firstOrFail(); $a->increment('views');
  return view('show',['a'=>$a,'comments'=>$a->comments()->where('is_approved',1)->latest()->get(),
   'related'=>Article::where('category_id',$a->category_id)->where('id','!=',$a->id)->take(4)->get()]);
 }
 function comment(Request $r,Article $article){
  $d=$r->validate(['author_name'=>'required|max:100','content'=>'required']);
  $article->comments()->create($d); return back()->with('ok','Bình luận đã gửi, đang chờ duyệt.');
 }
 function contact(){return view('contact');}
 function sendContact(Request $r){
  Contact::create($r->validate(['name'=>'required','email'=>'required|email','subject'=>'required','message'=>'required']));
  return back()->with('ok','Đã gửi liên hệ. Cảm ơn bạn!');
 }
 function login(){return view('login');}
 function doLogin(Request $r){
  if(Auth::attempt($r->validate(['email'=>'required|email','password'=>'required']))){$r->session()->regenerate();return redirect('/admin/articles');}
  return back()->withErrors(['email'=>'Sai email hoặc mật khẩu.']);
 }
 function logout(Request $r){Auth::logout();$r->session()->invalidate();$r->session()->regenerateToken();return redirect('/');}
}
