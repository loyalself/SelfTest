<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/17
 * Time: 18:10
 */
namespace app\Http\Controllers\Hello;
use App\Http\Controllers\Controller;

use DB;

class IndexController extends Controller
{
    public function dbTest()
    {
        //查询表中所有数据,使用select
        $results = DB::select('select * from user');
        //print_r($results);
        return view('db.db',['results'=>$results]);

        //select查询使用命名绑定
        $results = DB::select('select * from user where id=:id',['id'=>1]);
        return view('db.db',['results'=>$results]);

        //使用insert
        $results = DB::insert("insert user(name) values('qiuqiu')");
        print_r($results);

       //使用问号占位符
       $results = DB::insert('insert into user(id,name) values(?,?)',['9','dian']);
        print_r($results);

        //使用update
        $results = DB::update("update user set name='mlxg' where id=4");
        print_r($results);

        //使用问号占位符
        $results = DB::update("update user set name='godv' where id=?",[7]);
        $results = DB::update('update user set id=8 where name=?',['dian']);
        print_r($results);

        //使用delete
        $results = DB::delete('delete fromo user');//删除表中所有数据
        $results = DB::delete('delete from user where id=8');//删除表中某条数据
        print_r($results);
    }

    //数据库事务
    public function Sw()
    {
         DB::transaction(function(){
            DB::table('user')->delete(['id'=>7]);
        });
    }

    //手动操作事务
    public function Hand()
    {
        //开启事务
        DB::begintransaction();

        $a = DB::delete('delete from user where id=15');
        if($a)
        {
            DB::commit();
        }else
        {
            DB::rollback();
        }
        //DB::commit();
    }
}