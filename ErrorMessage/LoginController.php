<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('login.index');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:3|max:10',
        ],  ['password.min'=>'您输入的密码小于3位']);

        $user = request(['username', 'password']);


        return \Redirect::back()->withErrors("用户名密码错误");
    }
    public function imageUpload()
    {
        dd(request()->all());
    }

}
