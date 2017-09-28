<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/27
 * Time: 11:24
 */
namespace App\Http\Controllers\login;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IndexController extends Controller
{
    //注册页面
    public function zhuce()
    {
        return view('register.register');
    }
    //注册行为
    public function register()
    {
        //验证
        $this->validate(request(),[
            'name'=>'required|min:3|unique:user,name',
            'email'=>'required|unique:user,email|email',
            "password"=>'required|min:5|max:10|confirmed'
        ]);
        //逻辑
        $name = request('name');
        $email = request('email');
        $password = bcrypt(request('password'));
        $user = User::create(compact('name','email','password'));
        //渲染
        return redirect('index');
    }

    //登陆页面
    public function index()
    {
        return view('login.index');
    }
    //登陆行为
    public function login(Request $request)
    {
        //验证
        $this->validate(request(),[
            'email'=>'required|email',
            'password'=>'required|min:5|max:10',

        ]);
        //逻辑
        $user = request(['email','password']);
		//var_dump(Auth::attempt($user));exit;
        if(Auth::attempt($user))
        {
           /*
            * 第一种方法，传视图的方法
            * $email = $user['email'];
           return view('body.body',['email'=>$email]);*/
           //重定向到方法
           return redirect('body');
        }

        //渲染
    }

    public function body()
    {
        return view('body.body');
    }


}