@extends('layout')@section('c')@include('admin.nav')<h3>{{$a->exists?'Sửa':'Thêm'}} bài viết</h3>
<form method="post" enctype="multipart/form-data" action="/admin/articles{{$a->exists?'/'.$a->id:''}}">@csrf @if($a->exists)@method('PUT')@endif
<input name="title" class="form-control mb-2" placeholder="Tiêu đề" value="{{old('title',$a->title)}}" required>
<textarea name="summary" class="form-control mb-2" placeholder="Tóm tắt">{{old('summary',$a->summary)}}</textarea>
<textarea name="content" rows="8" class="form-control mb-2" placeholder="Nội dung" required>{{old('content',$a->content)}}</textarea>
<select name="category_id" class="form-select mb-2">@foreach($cats as $c)<option value="{{$c->id}}" @selected($c->id==old('category_id',$a->category_id))>{{$c->name}}</option>@endforeach</select>
<select name="status" class="form-select mb-2"><option value="published" @selected($a->status=='published')>Đăng</option><option value="draft" @selected($a->status=='draft')>Nháp</option></select>
<input type="file" name="image" class="form-control mb-2"><button class="btn btn-primary">Lưu</button></form>@endsection
