<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Session;
use Auth;
class AdminController extends Controller
{
    public function index() {
        return view('admin.login');
    }
    
    public function home() {
        return view('admin.home');
    }
    
    public function logout(){
        Auth::logout();
        return redirect('/admin');
    }

    public function login(Request $request) {  
        $adminEmail= $request->admin_email;
        $adminPassword=$request->admin_password;
        if(Auth::attempt(['admin_Email'=>$adminEmail,'admin_password'=>$adminPassword])){
            return view('admin.home');
        }else{
            return back()->with('statuslogin', 'Tài khoản hoăc Mật khẩu không chính xác');
        }
    }
    // public function dash(Request $request) {
    //     $adminEmail= $request->admin_email;
    //     $adminPassword=$request->admin_password;

    //     $resuft = Admin::where("admin_Email", $adminEmail)->where("admin_password", $adminPassword)->first();
    //     if($resuft) {
    //         //$adminName= $resuft->admin_name;   
    //         Session::put('adminName', $resuft->admin_name);
    //         Session::put('adminId', $resuft->admin_id);
    //         return view('admin.home');
    //     } else {
    //         return back()->with('statuslogin', 'Tài khoản hoăc Mật khẩu không chính xác');
    //     }
    // }
    
    public function register() {
       return view('admin.register');
    }

    public function checkregister(Request $request) {
        $inputData = $request->all();
        $registerAdmin = Admin::Create([
            'admin_email' => $inputData['Email'],
            'admin_password' => md5($inputData['Password']),
            'admin_name' => $inputData['Name'],
            'admin_phone' => $inputData['Phone'],
        ]);
    }
}