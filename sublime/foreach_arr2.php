<?php
$a = array(
	0=>array('id'=>1,'name'=>'aa'),
	1=>array('id'=>2,'name'=>'bb'),
	2=>array('id'=>3,'name'=>'ff')
	);
$b = '菜';
/*foreach($a as $k=>$v)
{	
	//直接输出$k,才能输出键名,$a[$k]输出的还是键值
     echo $k,'<br>';
}*/
/*foreach ($a as $key => $value) 
{
	$a[$k] = $value;
}
print_r($a);	//这个还是原样数组
*/
foreach ($a as $k => $v)
{
	$v['name'] = $b.$v['name'];    //=>赋值运算,即给$v中的一个值重新赋值了
   	$a[$k] = $v;				  //然后将重新赋过的值进行遍历,即每遍历一次,将新值放到数组	
}
echo '<pre>';
print_r($a);
echo '</pre>';