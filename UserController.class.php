<?php
namespace Home\Controller;
use Think\Controller;
use Think\Upload;
class UserController extends Controller {
	//获取用户信息
    /*
      参数：    
      返回：code 1 成功 0 失败
            data 用户数据
    */
     public function userInfo(){
         $userId = $_SESSION['user']['id'];  
         $userinfo = M('userinfo');
         //查询个人资料
         $data = $userinfo->where("userId = {$userId}")->find();       
         if(is_array($data))
         {          
         	$data = genBody(1,"",$data);
         }
         else
         {
         	$data = genBody(0,"","");
         } 
             
         $this->ajaxReturn($data,"Json");
     }

    //用户注册
     /*参数：用户名(手机号)：user
                      密码 ：pass
                手机验证码 ：code
                   用户昵称：name_n
       传输方式：post
       返回：code 1 成功 0 失败
           
     */               
      public function registera()
      {              
          //获取60秒前的时间戳
         $time = strtotime("-90seconds");
         //获得发送短信时的时间戳
         $time2 = $_SESSION['time'];
         $captcha = $_SESSION['captcha'];
         //判断是否发送超时
       if($time2 > $time){              
          //获取参数
          $code = I('post.code');
            //验证短信验证码
          if($captcha == $code)
          {
          unset($_SESSION['time']);
          unset($_SESSION['captcha']);
          $where['user'] = I('post.user');
          $usera = I('post.user');
          $where['pass'] = md5(I('post.pass'));              
          if(!empty($usera))
          {
              $user = M("user");
              //查询当前用户是否存在             
              $row =$user->where("user='{$usera}'")->find();              
            if(!is_array($row))
            { //添加该用户
              $row1 = $user->add($where);
              //获得用户详情并更新个人资料
              if(!empty($row1))
              {              
                $data = genBody('1','注册成功');
              }
              else
              {
                $data = genBody('0','');
              }
            }
            else
            {
              $data = genBody('0','该用户已存在');
            }
          }
          else
          {
            $data = genBody('0','账号不能为空');
          }
        }
         else
         {
          unset($_SESSION['time']);
          unset($_SESSION['captcha']);
          $data = genBody('0','验证码错误');
         }
        }
        else
        {
          unset($_SESSION['time']);
          unset($_SESSION['captcha']);
          $data = genBody('0','验证码超时');
        }
          $this->ajaxReturn($data,"Json");
        
      }

      //修改密码
     /*参数：用户名(手机号)：user
                      密码 ：pass
                手机验证码 ：code
       传输方式：post
       返回：code 1 成功 0 失败
     */               
      public function updatea()
      {   //获取60秒前的时间戳
         $time = strtotime("-60seconds");
         //获得发送短信时的时间戳
         $time2 = $_SESSION['time'];
         $captcha = $_SESSION['captcha'];
         //判断是否发送超时
       if($time2 > $time){              
          //获取参数
          $code = I('post.code');
            //验证短信验证码
          if($captcha == $code)
          {
          unset($_SESSION['time']);
          unset($_SESSION['captcha']);
          $where['user'] = I('post.user');
          $usera = I('post.user');
          $where['pass'] = md5(I('post.pass'));
                 
          if(!empty($usera))
          {
              $user = M("user");
              //查询当前用户是否存在             
              $row =$user->where("user='{$usera}'")->find();              
            if(is_array($row))
            { //更新用户
              $row1 = $user->where("user='{$usera}'")->save($where);
              if(!empty($row1))
              {              
                $data = genBody('1','更改成功');
              }
              else
              {
                $data = genBody('0','');
              }
            }
            else
            {
              $data = genBody('0','未注册');
            }
          }
          else
          {
            $data = genBody('0','账号不能为空');
          }
         }
         else
         {
          unset($_SESSION['time']);
          unset($_SESSION['captcha']);
          $data = genBody('0','验证码错误');
         }
        }
        else
        {
          unset($_SESSION['time']);
          unset($_SESSION['captcha']);
          $data = genBody('0','验证码超时');
        }
          $this->ajaxReturn($data,"Json");
      } 
        
      

     //更新或者添加用户信息
     /*参数：用户id
      不更新的字段参数可以为空，如执行添加操作则参数不能为空
            "name":      用户名
		        "name_n":     用户昵称
		        "pic":        头像
		        "phone":      手机
		        "age":         年龄
		        "sex":         1：男 2：女
		        "city":        城市
		        "rows":        经度
		        "cols":        纬度		        
		        "isHidden":    1：隐身 2：在线  是否隐身
		        "content":     个性签名
       返回：code 1 成功 0 失败
     */
       public function updateUser(){
           
            print_r($_GET);  
            exit();
       	   $userId = $_SESSION['user']['id'];
    
       	   //判断参数是否存在
       	   if(I('post.name'))
       	   {
       	   	$where['name'] = I('post.name');
       	   }
       	   if(I('post.name_n'))
       	   {
       	   	$where['name_n'] = I('post.name_n');
       	   } 
       	   if(I('post.phone'))
       	   {                  
           $where['phone'] = I('post.phone');
           }
           if(I('post.age'))
           {
           	$where['age'] = I('post.age');
           }
           if(I('post.sex'))
           {
           	$where['sex'] = I('post.sex');
           }
           if(I('city'))
           {
           	$where['city'] = I('post.city');
           }
           if(I('rows'))
           {
           	$where['rows'] = I('post.rows');
           }
           if(I('cols'))
           {
           	$where['cols'] = I('post.cols');
           }
           if(I('isHidden'))
           {
           	$where['isHidden'] = I('post.isHidden');
           }
           if(I('content'))
           {
           $where['content'] = I('post.content');
       	   }
       	   if(I('pic'))
       	   { 
       	   	 if($_FILES)
      		    {
      				$file = $_FILES['pic'];
      				//实例化上传类
      				$upload = new Upload();
      			  //设置上传文件的大小
      				$upload->maxSize = 10000000;
      				//设置允许上传文件的扩展名
      				$upload->exts = array("jpg","gif","png");
      				//是否生成子目录
      				$upload->autoSub = true;
      				//设置上传的根目录  
      				$upload->rootPath = "./";
      				//设置保存的路径
      				$upload->savePath = "/public/home/images/";
      				//上传文件，返回：false、一维关联数组
      				$result = $upload->uploadOne($file);
      				//截取图片路径
      				$yy = $result['savepath'].$result['savename'];
              $ul = C('pics');
              //拼接路径
      				$img = $ul.substr($yy,strpos($yy,'/')+1);
      				//获得添加任务							   
      			    $where['pic'] = $img;			    			    		   
       	    }
            else
            {
              //默认头像路径 暂时没设
              $where['pic'] = "C('pics').admin/images/2017-07-12/5965d15a20e90.png";
            }      	   
        }
        $userinfo = M('userinfo'); 
        $arr = $userinfo->field('id')->where("userId={$userId}")->find();
        if(is_array($arr))
        {
          //如果存在个人信息表 执行用户信息更新 
            $row = $userinfo->where("userId = {$userId}")->save($where);
           if($row)
           {
             $data = genBody(1,"更新成功","");
           }
           else
           {
             $data = genBody(0,"更新失败","");
           }
        }
        else
        {  //如果不存在则执行添加操作
           //查询注册表里有该用户没
           $user = M('user')->where("id = {$userId}")->find();
           if(is_array($user))
            { //执行添加操作
              $where['userId'] = $userId;
              $data = $userinfo->add($where);
              if(!empty($data))
              {
                $data = genBody(1,"添加成功");
              }
              else
              {

                $data = genBody(0,"添加失败");
              }
            } 
            else
            {
              $data = genBody(0,"当前用户没注册");
            }                 
        }      
        
         $this->ajaxReturn($data,"Json");
  }
   
  //查询行程
  /*参数：
  传输方式：post
    返回：code 1 成功 0 失败
         "data": {
                "id": 主键id
                "userId": userid
                "rou": 行程内容
                "time": 时间
    }
  */
    public function route(){
      $userId = $_SESSION['user']['id'];
      $route = M('route');
      $data = $route->where("userId = {$userId}")->select();
      if(is_array($data))
      {
        $data = genBody(1,'',$data);
      }
      else
      {
        $data = genBody(0,'该用户还没有行程记录');
      }      
       $this->ajaxReturn($data,"Json");
 }

  #添加个人行程#
  /*参数： 
         行程内容：rou
    传输方式：post
    返回：code 1 成功 0 失败     
  */
   public function addRoute(){
      $userId = $_SESSION['user']['id'];
      $rou['rou'] = I('post.rou');
      $rou['userId'] = $userId;    
      $route = M('route');
      //添加行程记录
      $data = $route->where("userId = {$userId}")->add($rou);
      if(!empty($data))
      {
        $data = genBody(1,'');
      }
      else
      {
        $data = genBody(0,'');
      }
      $this->ajaxReturn($data,"Json");
   } 
   
   //手机验证码
   /*      url : User/captcha
     参数 phone ：要发送的手机号
     返回：code 1 请求成功
           data 触发URL
      –1  账号未注册
      –2  网络访问超时，请稍后再试
      –3  帐号或密码错误
      -4  只支持单发
      –5  余额不足，请充值
      –6  定时发送时间不是有效的时间格式
      -7  提交信息末尾未签名，请添加中文的企业签名【 】或未采用gb2312编码
      –8  发送内容需在1到300字之间
      -9  发送号码为空
      -10 定时时间不能小于系统当前时间
      -11 屏蔽手机号码
      -100  限制IP访问
   */
    public function captcha(){
      if($_SESSION['time'] == "")
      {
      $CorpID = "CQLKY00739";
      $Pwd = "@336699";
      $num = $this->numa();
      $Mobile = I('phone');      
      $Content = '您的验证码是'.$num.C('content');
      //生成URL地址 
      $url = "http://yzm.mb345.com/ws/BatchSend2.aspx?CorpID={$CorpID}&Pwd={$Pwd}&Mobile={$Mobile}&Content={$Content}&SendTime=&cell=";
      //存储随机数
      $_SESSION['captcha'] =  $num;
      //存储短信发送时间
       $_SESSION['time'] = time();
       $row = file_get_contents($url);
       if($row > 0)
       {
         $data = genBody('1','发送成功');
       }
       else
       {
          $data = genBody("$row");
       }
     }
     else
     {
       $data = genBody("0","短信已发送 请稍后在点击");
     }
     
    $this->ajaxReturn($data,"JSon");
   }

    //生成随机数
     private function numa(){
      for ($i=0; $i<=4; $i++) {
            $num .= mt_rand(1,9);
     } 
       $num = 123; 
      return $num;
   }
   
   //获取融云token
    /*id ：用户id
      name_n ：用户昵称
      pic ：用户头像
    返回值 ： 0 失败 1成功
              token值
    */
    public function getToken(){
      
      $name = I('name_n');
      $userId = I('id');
      $pic = I('pic');
            // 前台逻辑修改，注册时用户需要填写昵称，图像由系统自动生成默认的
      $row1 = M('userinfo')->field('token')->where("id = $userId")->find();
      if(!empty($row1['token'])){
          $data = genBody('1','',$row1);
      }else{
            // 根据用户id 获得用户的昵称和头像
      $returnDataType = I('DataType', 'json');
            $param = array(
                'userId' => $userId,
                'name' => $name,
                'portraitUri' => $pic,
            );
            $url = C('rongcloud.getTokenURL') . '.' . $returnDataType;
            $postData = 'userId=' . $param['userId'] . '&name=' . $param['name'] . '&portraitUri=' . $param['portraitUri'];
            $result = $this->post_rong($url, $postData);
            $result = json_decode($result);
            $token = $result->token;
            //token插入数据表
            $token['token'] = $token ;
            M('userinfo')->where('id = $userId')->save($token); 
            $data = genBody('1','',$token);
           }
            $this->ajaxReturn($data,'Json');       
    }

     protected function post_rong($url, $postData){
        $appKey = C('rongcloud.appKey');
        $appSecret = C('rongcloud.appSecret');
        if( empty($appKey) || empty($appSecret)){
            $body = genBody(0, '请检查配置文件');
            $this->ajaxReturn($body, 'JSONU');
        }
        srand((double)microtime()*1000000);
        $nonce = rand(); // 获取随机数。
        $timestamp = time(); // 获取时间戳。
        $signature = sha1($appSecret.$nonce.$timestamp);
        $httpHeader = array(
            'App-Key:'.$appKey,  //平台分配
            'Nonce:'.$nonce,        //随机数
            'Timestamp:'.$timestamp,    //时间戳
            'Signature:'.$signature,        //签名
            'Content-Type: application/x-www-form-urlencoded',
        );
         //创建http header
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }


}