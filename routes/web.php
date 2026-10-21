<?php
use Illuminate\Support\Facades\Route; use App\Http\Controllers\{HomeController,ArticleController,AdminController};
Route::get('/',[HomeController::class,'index']);
Route::get('/bai-viet/{slug}',[HomeController::class,'show']);
Route::post('/bai-viet/{article}/binh-luan',[HomeController::class,'comment']);
Route::get('/lien-he',[HomeController::class,'contact']); Route::post('/lien-he',[HomeController::class,'sendContact']);
Route::get('/login',[HomeController::class,'login'])->name('login'); Route::post('/login',[HomeController::class,'doLogin']);
Route::post('/logout',[HomeController::class,'logout']);
Route::middleware('auth')->prefix('admin')->group(function(){
 Route::resource('articles',ArticleController::class)->except('show');
 Route::middleware(fn($r,$n)=>auth()->user()->role=='admin'?$n($r):abort(403))->group(function(){
  $w='categories|users|comments|contacts';
  Route::get('{t}',[AdminController::class,'index'])->where('t',$w);
  Route::post('{t}',[AdminController::class,'store'])->where('t',$w);
  Route::put('{t}/{id}',[AdminController::class,'update'])->where('t',$w);
  Route::delete('{t}/{id}',[AdminController::class,'destroy'])->where('t',$w);
 });
});
