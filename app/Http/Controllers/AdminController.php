<?php

namespace App\Http\Controllers;
use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Master;

class AdminController extends Controller
{
    //
    function index()
    {
        return view('dashboard.admin.index');
    }
    function data()
    {
       $master = Master::with('user')->get();
       return view('dashboard.admin.data',compact('master'));
   }
    // Approved
    function approved($id){
    Master::where('id',$id)->update([
        'status'=>2
    ]);
    return redirect()->route('admin.data')->with('pesan','Status Data Telah diubah');
}
// End Approved
 // Approved
    function rejected($id){
    Master::where('id',$id)->update([
        'status'=>3
    ]);
    return redirect()->route('admin.data')->with('pesan','Status Data Telah diubah');
}
// End Approved

function profile()
{
    return view('dashboard.admin.profile');
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
        return response()->json(['status'=>0,'msg'=>'Gagal Update Profil, Silahkan Coba Lagi']);
    }else{
        return response()->json(['status'=>1,'msg'=>'Profil Anda telah berhasil di Update.']);
    }
}
}
function updatePicture(Request $request){
   $path = 'users/images/';
   $file = $request->file('admin_image');
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
           return response()->json(['status'=>0,'msg'=>'Something went wrong, updating picture in db failed.']);
       }else{
           return response()->json(['status'=>1,'msg'=>'Foto Profil Anda telah berhasil diperbarui']);
       }
   }
}
    // Data Akun User
function akun()
{
        // $users = DB::select('select * from users where role=1');
    $akun = DB::table('users')->where('role', 2)->get();
    return view('dashboard.admin.akun',compact('akun'));
}
    // Data List Admin
function user()
{
        // $users = DB::select('select * from users where role=1');
    $user = DB::table('users')->where('role', 1)->get();
    return view('dashboard.admin.user',compact('user'));
}
function deleteUser($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('admin.user')->with('pesan','Data Berhasil Di Hapus');
}
function add()
{
    return view('dashboard.admin.v_add_admin');
}
function insertAdmin(Request $request){
    $request->validate([
        'name'=>['required','string','max:255'],
        'email'=>['required','string','email','max:255','unique:users'],
        'password'=>['required','string','min:8','confirmed'],

    ]);
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = 1;
    $user->password = \Hash::make($request->password);
    if ($user->save()) {
        return redirect()->route('admin.user')->with('pesan','Data Berhasil di tambahkan');
    }else{
        return redirect()->back()->with('error','Gagal Tambah, Silahkan Coba Lagi');
    }
}
}
// End Data List Admin


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
        return response()->json(['status'=>0,'msg'=>'Gagal Update Kata Sandi']);
    }else{
        return response()->json(['status'=>1,'msg'=>'Kata sandi Anda telah berhasil di update']);
    }
}
}
