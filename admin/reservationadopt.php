<?php
	$number=$_GET['number'];
 	error_reporting(E_ALL ^ E_DEPRECATED);
	mysql_connect('localhost','root','123456') or die(mysql_error());
	mysql_select_db('roomweb');
	mysql_query('set names utf8');
	$rs=mysql_query("update rw_reservation set reservationstate='审核通过' where number='$number'");
	if($rs) 
	{	
		echo '<script language="javascript">alert("审核成功!");</script>';
		echo '<script language="javascript">window.location.href=document.referrer;</script>'; 
	}
	else
		die(mysql_error());
?>