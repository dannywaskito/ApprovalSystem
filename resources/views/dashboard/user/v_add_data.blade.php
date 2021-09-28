@extends('dashboard.user.layouts.user-dash-layout')
@section('title', 'Tambah Data Pengajuan')
@section('content')
<div class="container">
 <form action="/user/insertData" method="POST">
  @csrf
  <div class="content">
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <label>Nama Kegiatan</label>
          <input class="form-control" name="nama_kegiatan" value="{{old('nama_kegiatan')}}">
          <div class="text-danger">
            @error('nama_kegiatan')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="form-group">
          <label>Waktu</label>
          <input class="form-control" type="date" name="waktu" value="{{old('waktu')}}">
          <div class="text-danger">
            @error('waktu')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="form-group">
          <label>Keterangan</label>
          <textarea name="ket" class="form-control" rows="3">{{old('ket')}}</textarea>
          <div class="text-danger">
            @error('ket')
            {{ $message }}
            @enderror
          </div>
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