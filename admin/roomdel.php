<?php
	$id=$_GET['id'];
 	error_reporting(E_ALL ^ E_DEPRECATED);
	mysql_connect('localhost','root','123456') or die(mysql_error());
	mysql_select_db('roomweb');
	mysql_query('set names utf8');
	$rs=mysql_query("delete from rw_room where id='$id'");
	if($rs) 
	{	
		echo '<script language="javascript">alert("删除教室成功!");</script>';
		echo '<script language="javascript">window.location.href=document.referrer;</script>'; 
	}
	else
		die(mysql_error());
?>