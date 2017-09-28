<?php
$a = array(
  array('id'=>1,'name'=>'张三','sex'=>'男','address'=>'湖北'),
  array('id'=>2,'name'=>'李四','sex'=>'女','address'=>'湖北'),
  array('id'=>3,'name'=>'王五','sex'=>'女','address'=>'湖北'),
);

$b = array(
   array('武汉','孝感'),
   array('黄冈','黄石'),
   array('宜昌','十堰')
);
$c = array();
foreach($a as $k=>$v)
{	
  
	foreach ($b as $key => $value)
	{
	 if($k == $key)
	 {
	 	foreach ($value as $m => $n) 
	   {
	      $c[] = $v['address'].$n;
	   }
	 }	   
	}

}





