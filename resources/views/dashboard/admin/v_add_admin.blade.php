@extends('dashboard.admin.layouts.admin-dash-layout')
@section('title', 'Tambah Data Admin')
@section('content')
<div class="container">
 <form action="/admin/insertAdmin" method="POST">
  @csrf
  <div class="content">
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <label>Nama</label>
          <input class="form-control" name="name" value="{{old('name')}}">
          <div class="text-danger">
            @error('name')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input class="form-control" name="email" value="{{old('email')}}">
          <div class="text-danger">
            @error('email')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input id="password" type="password" class="form-control" name="password" required data-eye value="{{old('password')}}">
          <span class="text-danger">@error('password'){{$message}}@enderror</span>
        </div>
        <div class="form-group">
          <label for="password-confirm">Konfirmasi Password</label>
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required data-eye value="{{old('password_confirmation')}}">
          <span class="text-danger">@error('password_confirmation'){{$message}}@enderror</span>
        </div>
        <div class="form-group">
          <button class="btn btn-success">Simpan</button>
          <a href="/admin/user" class="btn btn-primary">Back</a>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
@endsection