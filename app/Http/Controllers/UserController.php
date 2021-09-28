<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Master;

class UserController extends Controller
{
    //
    function index()
    {
        return view('dashboard.user.index');
    }
    function profile()
    {
        return view('dashboard.user.profile');
    }
    function data()
    {
       $master = Master::with('user')->get();
       return view('dashboard.user.data',['master' => $master]);
   }
   function addData()
   {
        return view('dashboard.user.v_add_data');
   }
   function insertData(Request $request){
    $request->validate([
        'nama_kegiatan'=>['required','string','max:255'],
        'waktu'=>['required','string'],
        'ket'=>['required','string'],

    ]);
    $master = new Master();
    $master->nama_kegiatan = $request->nama_kegiatan;
    $master->waktu = $request->waktu;
    $master->ket = $request->ket;
    $master->status = 1;
    $master->user_id = Auth::user()->id;
    if ($master->save()) {
        return redirect()->route('user.data')->with('pesan','Data Anda Berhasil di Ajukan');
    }else{
        return redirect()->back()->with('error','Gagal Tambah, Silahkan Coba Lagi');
    }
}
   function updateInfo(Request $request){

       $validator = \Validator::make($request->all(),[
           'name'=>'required',
           'bio'=>'required',
           'email'=> 'required|email',
       ]);

       if(!$validator->passes()){
           return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
       }else{
        $query = User::find(Auth::user()->id)->update([
         'name'=>$request->name,
         'bio'=>$request->bio,
         'email'=>$request->email,
         'no_hp'=>$request->no_hp,
     ]);

        if(!$query){
            return response()->json(['status'=>0,'msg'=>'Gagal Update Profil, silahkan Coba Lagi']);
        }else{
            return response()->json(['status'=>1,'msg'=>'Profil Anda telah berhasil di Update']);
        }
    }
}
function updatePicture(Request $request){
 $path = 'users/images/';
 $file = $request->file('user_image');
 $new_name = 'UIMG_'.date('Ymd').uniqid().'.jpg';

           //Upload new image
 $upload = $file->move(public_path($path), $new_name);

 if( !$upload ){
     return response()->json(['status'=>0,'msg'=>'Gagal Upload Foto']);
 }else{
               //Get Old picture
     $oldPicture = User::find(Auth::user()->id)->getAttributes()['picture'];

     if( $oldPicture != '' ){
         if( \File::exists(public_path($path.$oldPicture))){
             \File::delete(public_path($path.$oldPicture));
         }
     }

               //Update DB
     $update = User::find(Auth::user()->id)->update(['picture'=>$new_name]);

     if( !$upload ){
         return response()->json(['status'=>0,'msg'=>'Gagal Upload Foto.']);
     }else{
         return response()->json(['status'=>1,'msg'=>'Foto Profil Anda telah berhasil diperbarui']);
     }
 }
}
function changePassword(Request $request){
           //Validate form
 $validator = \Validator::make($request->all(),[
     'oldpassword'=>[
         'required', function($attribute, $value, $fail){
             if( !\Hash::check($value, Auth::user()->password) ){
                 return $fail(__('Password Lama Anda Salah, Silahkan Ulangi lagi'));
             }
         },
         'min:8',
         'max:30'
     ],
     'newpassword'=>'required|min:8|max:30',
     'cnewpassword'=>'required|same:newpassword'
 ],[
    'oldpassword.required'=>'Masukkan Password Lama Anda',
    'oldpassword.min'=>'Password Lama harus memiliki minimal 8 karakter',
    'oldpassword.max'=>'Password Lama tidak boleh lebih dari 30 karakter',
    'newpassword.required'=>'Masukkan Password Baru Anda',
    'newpassword.min'=>'Password Baru harus memiliki minimal 8 karakter',
    'newpassword.max'=>'Password Baru tidak boleh lebih dari 30 karakter',
    'cnewpassword.required'=>'Masukkan kembali Password baru Anda',
    'cnewpassword.same'=>'Password baru dan Konfirmasi Password baru harus cocok
    '
]);

 if( !$validator->passes() ){
     return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
 }else{

    $update = User::find(Auth::user()->id)->update(['password'=>\Hash::make($request->newpassword)]);

    if( !$update ){
        return response()->json(['status'=>0,'msg'=>'Gagal Update Password']);
    }else{
        return response()->json(['status'=>1,'msg'=>'Kata sandi Anda telah berhasil di update
            ']);
    }
}
}
}
