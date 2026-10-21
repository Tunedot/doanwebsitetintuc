@extends('layout')@section('c')<h3>Đăng nhập</h3><form method="post" style="max-width:400px">@csrf
<input name="email" type="email" class="form-control mb-2" placeholder="Email" required><input name="password" type="password" class="form-control mb-2" placeholder="Mật khẩu" required><button class="btn btn-primary">Đăng nhập</button></form>@endsection
