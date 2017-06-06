<?php
	$number=$_GET['number'];
 	error_reporting(E_ALL ^ E_DEPRECATED);
	mysql_connect('localhost','root','123456') or die(mysql_error());
	mysql_select_db('roomweb');
	mysql_query('set names utf8');
	$one=mysql_query("select * from rw_order where number='$number'");
	$rows=mysql_fetch_assoc($one);
	$ordertime=$rows['orderdate'];
	$date=date("$ordertime");
	$now=date('Y-m-d');
	$date1_arr = explode("-",$date);  
	$date2_arr = explode("-",$now);  
	$day1 = mktime(0,0,0,$date1_arr[1],$date1_arr[2],$date1_arr[0]);  
	$day2 = mktime(0,0,0,$date2_arr[1],$date2_arr[2],$date2_arr[0]);  
	$days = round(($day2 - $day1)/3600/24);
	if($days<0)
	{
		$rs=mysql_query("update rw_order set orderstate='已取消' where number='$number'");
		if($rs) 
		{	//header('location:userhistory.php');
			echo '<script language="javascript">alert("取消预约成功!");</script>';
			echo '<script language="javascript">window.location.href=document.referrer;</script>'; 
		}
		else
			die(mysql_error());
	}
	else
	{
		echo '<script language="javascript">alert("取消失败，只能取消今天以后的预约!");</script>';
		echo '<script language="javascript">window.location.href=document.referrer;</script>'; 
	}
?>