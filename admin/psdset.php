<?php 
  error_reporting(E_ALL ^ E_DEPRECATED);
  $userid=$_GET['userid'];
  mysql_connect('localhost','root','123456') or die(mysql_error());
  mysql_select_db('roomweb');
  mysql_query('set names utf8');
  $sql="update rw_user set password='111111' where userid='$userid'";
  //echo $sql;
  if(mysql_query($sql))
  	echo "<script>alert('重置密码成功！');</script>";
  else
  	echo "<script>alert('重置密码失败！');</script>";
	echo '<script language="javascript">window.location.href=document.referrer;</script>'; 
?>