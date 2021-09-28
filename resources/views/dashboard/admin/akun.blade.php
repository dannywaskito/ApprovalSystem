@extends('dashboard.admin.layouts.admin-dash-layout')
@section('title','Data Akun')
@section('content')
<div class="container">
    <!-- <a href="/admin/add" class="btn btn-primary">Add</a> -->
    <br><br>
    @if (session('pesan'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
        {{session('pesan')}}
    </div>
    @endif
    <table id="userTable" class="display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>E-Mail</th>
                <th>Tanggal Daftar Akun</th>
                <th>Terakhir Login</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            @foreach($akun as $data)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->email}}</td>
                <td>{{date('d F Y', strtotime($data->created_at))}}</td>
                <td>{{ Carbon\Carbon::parse($data->current_login_at)->diffForHumans()}}</td>
                <td>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$data->id}}">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
        @foreach($akun as $data)

        
    <!-- Modal Delete Siswa -->
    <div class="modal fade" id="delete{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$data->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus data dengan nama
                    <b>{{$data->name}}</b>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="/akun/delete/{{$data->id}}" class="btn btn-primary">Yes Delete!</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
  </div>
  @endsection