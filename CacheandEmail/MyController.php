<?php
namespace app\Http\Controllers\Test;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Mail;

class MyController extends Controller
{
    //缓存使用
    public function cache1()
    {   //1.put()方法，三个参数，第一个缓存的键名值，第二个缓存的键值，第三个缓存的存储时间
        Cache::put('key1','value1',10);
        //2.add()方法,如果成功返回true，否则false
        $result = Cache::add('key2','value2',10);
        var_dump($result);
        //3.forever()方法，永久写入到缓存中
        Cache::forever('key3','value3');

        //判断一个项目存在缓存中，用到has()方法;里面只需写上缓存的键名值就可以了
       if(Cache::has('key4'))
        {
            var_dump(Cache::get('key4'));
        }else
        {
            echo "并沒有缓存";
        }
    }

    public function cache2()
    {   //取出缓存中的值,get()方法
        var_dump(Cache::get('key1'));
       //var_dump(Cache::get('key2'));
        //var_dump(Cache::get('key3'));

        //pull()方法，第一次取出值，第二次删掉,第二次返回的是NULL
        //var_dump(Cache::pull('key2'));

        //forget()方法，从缓存中删除一个项目,删除成功，返回true，否则返回false
        //var_dump(Cache::forget('key3'));
        //var_dump(Cache::get('key3'));     =>返回NULL

    }


    //发送邮件两种方法
    public function mail()
    {
        //第一种:raw方法
        mail::raw('邮件内容 测试',function($message){
            //邮件来源
            $message->from('plafhtcc@163.com','菜菜');
            //邮件主题
            $message->subject('这个是测试');
            //发给谁
            $message->to('1213199837@qq.com');
        });
       /* //第二种:send方法
        mail::send('mail',['name'=>'菜菜','age'=>16],function($message){
            $message->to('1213199837@qq.com');
        });*/
    }
}
