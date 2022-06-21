<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Role;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $admins =Admin::orderby('admin_id', 'DESC')->get();
        $id = Auth::id();
        $admins = Admin::where('admin_id','!=',$id)->orderby('admin_id', 'DESC')->paginate(5);
        // $admins->role->role_id;
        // foreach($admins as $admin){
        //     dd($admin->role()->where('role_name', 'admin')->first());
        // }
        // dd($admins);
        // // dd($admins );
        // $arr='';
        // foreach($admins->role as $role) {
        //    $arr =$role->role_id;
        // }
        // dd($arr);
        return view('admin.user.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data= $request->all();
      
        $admins = Admin::where('admin_email', $request->admin_email)->first();
        $admins->role()->detach();
        if($request->roleAdmin) {
           $admins->role()->attach(Role::where('role_name','admin')->first());
        }
        if($request->roleDistributor){
            $admins->role()->attach(Role::where('role_name','distributor')->first());
        }
        if($request->roleUser){
            $admins->role()->attach(Role::where('role_name','user')->first());
        }  
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admins = Admin::find($id);
        $admins->role()->detach();
        $admins->delete();
        return redirect()->back();
    }

    public function searchUser(Request $request) {
        
        $id = Auth::id();
        $admins = Admin::where([['admin_name', 'like', '%' . $request->search . '%'],['admin_id','!=',$id]])->orwhere([['admin_id', '=',$request->search],['admin_id','!=',$id]])->paginate(5);
        return view('admin.user.index', compact('admins'));
    }
}
