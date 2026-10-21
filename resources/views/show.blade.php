@extends('layout')@section('c')
<h2>{{$a->title}}</h2><p class="text-muted">{{$a->category->name}} · {{$a->user->name}} · {{$a->published_at?->format('d/m/Y')}} · {{$a->views}} lượt xem</p>
@if($a->image)<img src="{{asset('storage/'.$a->image)}}" class="img-fluid mb-3">@endif
<p><b>{{$a->summary}}</b></p><div style="white-space:pre-line">{{$a->content}}</div><hr>
<h5>Bình luận ({{$comments->count()}})</h5>@foreach($comments as $c)<p><b>{{$c->author_name}}</b>: {{$c->content}}</p>@endforeach
<form method="post" action="/bai-viet/{{$a->id}}/binh-luan" class="mb-4">@csrf<input name="author_name" class="form-control mb-2" placeholder="Tên của bạn" required><textarea name="content" class="form-control mb-2" placeholder="Nội dung" required></textarea><button class="btn btn-primary">Gửi bình luận</button></form>
<h5>Tin liên quan</h5><ul>@foreach($related as $r)<li><a href="/bai-viet/{{$r->slug}}">{{$r->title}}</a></li>@endforeach</ul>
@endsection
