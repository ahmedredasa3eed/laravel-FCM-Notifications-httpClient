<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('backend.auth.login');
    }

    public function loginProcess(AuthRequest $request)
    {

        $data = $request->except('remember');
        if($request->has('remember')){
            $data['remember'] = true;
        }else{
            $data['remember'] = false;
        }

        $admin = Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']],$data['remember']);
        if ($admin) {
            //Session::flash('success','Successful Login');
            notify()->success('Successful Login');
            return redirect()->route('admin.index');
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        notify()->success('Logout Succeeded');
        return redirect()->route('admin.login');
    }

}
