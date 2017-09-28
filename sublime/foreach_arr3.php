<?php

/*$a = array(
	'a'=>1,
	'b'=>2,
	'c'=>'cc'
	);
这个echo是取出$a这个数组里下标为c的值,只能这样才能取出值	
echo $a['c'];		=>cc

$b = '菜';
foreach ($a as $k => $v)
{
    $v['c'] = $b.$v['c'];		
	1['c']	Warning: Cannot use a scalar value as an array in F:\wamp64\www\sublime\foreach_arr3.php on line 12
	2['c']	Warning: Illegal string offset 'c' in F:\wamp64\www\sublime\foreach_arr3.php on line 12
	cc['c']
	$a[$k] = $v;
}
print_r($a);
*/




$a = array(
	array('a'=>1,'b'=>2,'c'=>'cc')
	);

$b = '菜';

foreach ($a as $key => $value)
{
	$value['c'] = $b.$value['c'];
	$a[$key] = $value;
}

print_r($a);

/*Array
(
    [0] => Array
        (
            [a] => 1
            [b] => 2
            [c] => 菜cc
        )

)
*/



