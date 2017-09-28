<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/19
 * Time: 9:19
 */
namespace app\Http\Controllers\HaHa;
use App\Http\Controllers\Controller;
use DB;
//数据库请求构建器
class UserController extends Controller
{
    public function index()
    {
        //get()方法会返回表的总结果
        $users = DB::table('user')->get();
        return view('haha.haha',['users'=>$users]);

       //从数据表中获取单个列或行[从数据表中获取一行数据],使用first()方法,得到的是数据库表中的第一条记录
       $users = DB::table('user')->first();
        print_r($users);

        //如果你不需要一整行数据,可以使用value方法从单条记录中取出单个值,此方法直接返回字段的值s
        $name = DB::table('user')->where('id',12)->value('name');//如果表中没有这条id,那么返回一个null
        print_r($name);

       //如果你想要获取一个包含单个字段值的集合,可以使用pluck方法【即获取某一列的值】//按照升序的方法已经排好了
       $names = DB::table('user')->pluck('name');
        //pluck最后面的那个参数是键名,前面的是键值
        $results = DB::table('user')->pluck('name','id');
        print_r($results);

        //聚合#
        //表的总记录条数
        $counts = DB::table('user')->count();
        echo $counts;
        //查出表中最大年龄
        $age= DB::table('user')->max('age');
        echo $age;

        //select#
        //指定一个select语句,查询指定的字段【指定哪几个字段,就查询出哪几个字段的值】
        $users = DB::table('user')->select('name','id')->get();
        print_r($users);

        //在现有的查询字段上再添加一个字段进行查询
       $query = DB::table('user')->select('name');
       $users = $query->addSelect('age')->get();
       print_r($users);

       //where#用法
        //查询某条id对应的记录【这两种写法是一样的】
        $users = DB::table('user')->where("id",'=',15)->get();
        $users = DB::table('user')->where('id',15)->get();
        print_r($users);

        //在编写sql时,可以运用运算符【大于等于,小于等于】
        $users = DB::table('user')->where('id','>',10)->get();
        //这个运算符‘<>’相当于不等于
        $users = DB::table('user')->where('id','<>',10)->get();
        print_r($users);

       //like模糊查询
       $users =DB::table('user')->where('name','like','c%')->get();
       print_r($users);

       //whereBetween用法【查询某个字段的值介于两个值之间】
       $users = DB::table('user')->whereBetween('id',[1,10])->get();
       print_r($users);
        //whereNotBetween用法【验证字段的值不在两个值之间】
       $users = DB::table('user')->whereNotBetween('id',[1,10])->get();//【即大于10的】
        print_r($users);

       //orderby,limit,grouping,offset用法 #
        $users = DB::table('user')->orderBy('id','desc')->get();
        //inRandomOrder随机获取一个用户信息
        $randomusers = DB::table('user')->inRandomOrder()->first();
        print_r($randomusers);

        $users = DB::table('user')->groupBy('id')->having('id','>',10)->get();
        print_r($users);
    }

}