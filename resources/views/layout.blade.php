<!doctype html><html lang="vi"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Tin tức</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head><body>
<nav class="navbar navbar-expand navbar-dark bg-dark"><div class="container"><a class="navbar-brand" href="/">TinTức</a>
<div class="navbar-nav me-auto">@foreach(\App\Models\Category::all() as $c)<a class="nav-link" href="/?cat={{$c->slug}}">{{$c->name}}</a>@endforeach<a class="nav-link" href="/lien-he">Liên hệ</a></div>
<form class="d-flex me-2" action="/"><input name="q" class="form-control form-control-sm" placeholder="Tìm kiếm"></form>
@auth<a class="btn btn-sm btn-warning me-1" href="/admin/articles">Quản trị</a><form method="post" action="/logout">@csrf<button class="btn btn-sm btn-outline-light">Thoát</button></form>@else<a class="btn btn-sm btn-outline-light" href="/login">Đăng nhập</a>@endauth
</div></nav><div class="container my-4">
@if(session('ok'))<div class="alert alert-success">{{session('ok')}}</div>@endif
@if($errors->any())<div class="alert alert-danger">{{$errors->first()}}</div>@endif
@yield('c')</div></body></html>
