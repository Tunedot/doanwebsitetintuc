@extends('layout')@section('c')
<div class="row"><div class="col-md-8">
@forelse($articles as $a)<div class="card mb-3"><div class="row g-0">@if($a->image)<div class="col-4"><img src="{{asset('storage/'.$a->image)}}" class="img-fluid"></div>@endif<div class="col"><div class="card-body"><span class="badge bg-secondary">{{$a->category->name}}</span><h5><a href="/bai-viet/{{$a->slug}}">{{$a->title}}</a></h5><p>{{$a->summary}}</p><small class="text-muted">{{$a->published_at?->format('d/m/Y')}} · {{$a->views}} lượt xem</small></div></div></div></div>@empty<p>Không có bài viết.</p>@endforelse
{{$articles->withQueryString()->links('pagination::bootstrap-5')}}</div>
<div class="col-md-4"><h5>Xem nhiều</h5><ol>@foreach($top as $a)<li><a href="/bai-viet/{{$a->slug}}">{{$a->title}}</a></li>@endforeach</ol></div></div>
@endsection
