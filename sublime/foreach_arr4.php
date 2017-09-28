<?php

$a = array(
  array('id'=>1,'name'=>'张三','sex'=>'男','address'=>'湖北'),
  array('id'=>2,'name'=>'李四','sex'=>'女','address'=>'湖北'),
  array('id'=>3,'name'=>'王五','sex'=>'女','address'=>'湖北'),
  );
/*$b =  '武汉';

foreach ($a as $k => $v) 
{
	$v['address'] = $b.$v['address'];
	$a[$k] = $v;
}
print_r($a);	//  =>将武汉成功拼接到address对应的值里去了*/

//$b = array('武汉','黄冈','黄石');

$b = array(
   array('武汉','孝感'),
   array('黄冈','黄石'),
   array('宜昌','十堰')
	);
/*foreach($a as $k=>$v)
{
	foreach ($b as $m => $n) 
	{
		$v['address'] = $v['address'].$n;
	}
	$a[$k] = $v;
}
print_r($a);*/

/*foreach($a as $k=>$v)
{
	foreach ($b as $m => $n) 
	{
		$v[$k]['address'] = $v['address'].$n;
	}
	$a[$k] = $v;

}*/
/*foreach ($a as $k => $v) 
{
 	foreach ($b as $key => $value) 
 	{
 		if($k==$key)
 		{
 			$v['address'] = $v['address'].$value;
 			$a[$k] = $v;
 		}
 	}
}*/
foreach ($a as $k => $v)
{
	foreach($b as $kk=>$vv)
	{
		if($k == $kk)
		{
			$v['abc'] = $vv;
		}
		$a[$k] = $v;
	}
}




print_r($a);


