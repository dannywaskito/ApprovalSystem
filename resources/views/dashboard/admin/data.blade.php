@extends('dashboard.admin.layouts.admin-dash-layout')
@section('title','Master Data')
@section('content')
<div class="container">
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
             <th>Nama Kegiatan</th>
             <th>Waktu Pelaksanaan</th>
             <th>Tanggal Pengajuan</th>
             <th>Keterangan</th>
             <th>Status Pengajuan</th>
             <th>#</th>
         </tr>
     </thead>
     <tbody>
        <?php $no=1; ?>
        @foreach($master as $data)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$data->user->name}}</td>
            <td>{{$data->nama_kegiatan}}</td>
            <td>{{date('d F Y', strtotime($data->waktu))}}</td>
            <td>{{date('d F Y', strtotime($data->created_at))}}</td>
            <td>{{$data->ket}}</td>
            @if($data->status == 1)
            <td>
                <span class="badge badge-warning"> <i class="fa fa-spinner"></i> Pending</span>
            </td>
            @endif
            @if($data->status == 2)
            <td>
                <span class="badge badge-success"><i class="fa fa-check"></i> Success</span>
            </td>
            @endif
            @if($data->status == 3)
            <td>
                <span class="badge badge-danger"><i class="fa fa-times-circle"></i> Rejected!</span>
            </td>
            @endif
            @if($data->status == 1)
            <td>
                <a href="/admin/approved/{{$data->id}}" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Accept</a>
                <a href="/admin/rejected/{{$data->id}}" class="btn btn-danger btn-sm"><i class="fa fa-times-circle"></i> Rejected</a>
            </td>
            @endif
            @if($data->status == 2)
            <td>
             <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#accModal"><i class="fa fa-info"></i> Info</button>
         </td>
         @endif
         @if($data->status == 3)
         <td>
             <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rejectedModal"><i class="fa fa-info"></i> Info</button>
         </td>
         @endif
     </tr>
     @endforeach
 </tbody>
</table>
</div>
<!-- Modal Pending -->
<div class="modal fade" id="pendingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
   Lorem, ipsum, dolor sit amet consectetur adipisicing elit. Dicta accusamus, quos, natus distinctio maxime doloremque incidunt neque! Dolor, rem cum, quos quo dicta ipsam dolore mollitia consequuntur cupiditate rerum illo.
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!-- Modal Pending -->
<div class="modal fade" id="accModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
   Selamat! Data Anda telah di Terima oleh Admin
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!-- Modal Pending -->
<div class="modal fade" id="rejectedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
   Mohon Maaf, Data Anda telah di Tolak oleh Admin!
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
@endsection