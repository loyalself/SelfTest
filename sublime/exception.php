<?php

function checkNum($number)
{
	if($number > 1)
	{	
		//当满足条件或者不满足条件时,这个就是抛出异常
		throw new Exception('value must be 1 or below');
	}
	return true;
}

//checkNum(2);
try
{
  checkNum(1);	//如果条件不允许,就走这里面
  //checkNum(2);
  echo 'if you see this,the number is below'; 
}catch(Exception $e)
{	
	//如果满足checkNum中的条件,则抛出异常
	echo 'Message:'.$e->getMessage();
}