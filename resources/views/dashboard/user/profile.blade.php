@extends('dashboard.user.layouts.user-dash-layout')
@section('title','User Profile')
@section('content')


<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Profile</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{\URL::to('/user/dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle user_picture"
              src="{{ Auth::user()->picture }}"
              alt="User profile picture">
            </div>

            <h3 class="profile-username text-center user_name">{{ Auth::user()->name }}</h3>
            <p class="text-muted text-center user_bio"><span>{{ Auth::user()->bio }}</span></p>
            <p class="text-muted text-center">Terakhir Login <span>{{ Auth::user()->current_login_at->diffForHumans() }}</span></p>
            <p class="text-muted text-center">Bergabung Sejak <span>{{ Auth::user()->created_at->diffForHumans() }}</span></p>
            <input type="file" name="user_image" id="user_image" style="opacity: 0;height:1px;display:none">
            <a href="javascript:void(0)" class="btn btn-primary btn-block" id="change_picture_btn"><b>Ganti Foto</b></a>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#personal_info" data-toggle="tab">Informasi Pribadi</a></li>
              <li class="nav-item"><a class="nav-link" href="#change_pass" data-toggle="tab">Ganti Kata Sandi</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="personal_info">
                <form class="form-horizontal" method="POST" action="{{ route('userUpdateInfo') }}" id="UserInfoForm">
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Nama Lengkap" name="name" value="{{ Auth::user()->name }}">
                      <span class="text-danger error-text name_error"></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Alamat Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Alamat Email" name="email" value="{{ Auth::user()->email }}">
                      <span class="text-danger error-text email_error"></span>
                      <small class="text-danger">Alamat E-Mail Harus Valid</small>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Bio</label>
                    <div class="col-sm-10">
                      <textarea name="bio" cols="30" class="form-control">{{ Auth::user()->bio }}</textarea>
                      <span class="text-danger error-text bio_error"></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputName2" class="col-sm-2 col-form-label">Nomor Hp</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inputName2" placeholder="Nomor Hp" name="no_hp" value="{{ Auth::user()->no_hp }}">
                      <span class="text-danger error-text no_hp_error"></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">

                      <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-user"></i> Edit Profile</button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="tab-pane" id="change_pass">
               <form class="form-horizontal" action="{{route('userChangePassword')}}" method="post" id="changePasswordUserForm">
                <div class="form-group row">
                  <label for="oldpassword" class="col-sm-2 col-form-label">Password Lama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="oldpassword" placeholder="Password Lama" name="oldpassword">
                    <span class="text-danger error-text oldpassword_error"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="newpassword" class="col-sm-2 col-form-label">Password Baru</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="newpassword" placeholder="Password Baru" name="newpassword">
                    <span class="text-danger error-text newpassword_error"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="cnewpassword" class="col-sm-2 col-form-label">Konfirmasi Password Baru</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="cnewpassword" placeholder="Konfirmasi Password Baru" name="cnewpassword">
                    <span class="text-danger error-text cnewpassword_error"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Edit Password</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
  <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
@endsection
