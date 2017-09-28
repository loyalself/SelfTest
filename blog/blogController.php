<?php

namespace App\Http\Controllers\Backend;

use App\caibin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class IndexController extends Controller
{
    public function index()
    {
        //后台登陆
        return view('backend.login');
    }
    public function login(Request $request)
    {
        //Request $request这个可写可不写
        //验证
        $this->validate(request(),[
            'password'=>'required|min:5|max:10',
        ]);
         //dd(request(['name']));
        //获取到用户的登陆信息
        $user = request(['name','password']);
        $request->session()->put('user',$user);
        if(Auth::attempt($user))
        {
            return view('backend.index');
        }else
        {
            return back();
        }

    }
    public function backend()
    {
        return view('backend.index');
    }
    //关于crypt
    public function crypt()
    {
        $str = '123456';
        //encrypt函数对字符串进行加密
        $c_str =  encrypt($str);        //这个加密的值,刷新一次这个值就会变一次，但是解密后的结果还是123456
        //decrypt函数进行解密
         decrypt($c_str);
    }

}
