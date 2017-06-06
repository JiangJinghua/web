<?php 
session_start();
$userid=$_SESSION['id'];
if(isset($_POST['applyorder']))//判断提交按钮
{
	$id=$_POST['room'];
	$orderdate=$_POST['date'];
	$orderinterval=$_POST['interval'];
	$orderreason=$_POST['reason'];
	$command=$_POST['command'];
	error_reporting(E_ALL ^ E_DEPRECATED);
	mysql_connect('localhost','root','123456') or die(mysql_error());
	mysql_select_db('roomweb');
	mysql_query('set names utf8');
	$sql1="select location,roomid from rw_room where id='$id'";
	$rs1=mysql_query($sql1);
	if($rows1=mysql_fetch_assoc($rs1)){
		$location=$rows1['location'];
		$roomid=$rows1['roomid'];
	}
	$sql2="select authority from rw_user where userid='$userid'";
	$rs2=mysql_query($sql2);
	if($rows2=mysql_fetch_assoc($rs2)){
		$authority=$rows2['authority'];
	}
	if($authority=='普通') $orderstate='未审核';
	else $orderstate='审核通过';
	$sql3="insert into rw_order values(NULL,'$userid','$location','$roomid','$orderdate','$orderinterval','$orderreason','$orderstate','$command')";
	echo $sql3;
	$rs3=mysql_query($sql3);
	if($rs3) 
	{
		if($orderstate='未审核') 
			echo '<script language="javascript">alert("预约成功!请等待审核");</script>';
		else echo '<script language="javascript">alert("预约成功!");</script>';
		echo '<script language="javascript">window.location.href=document.referrer;</script>'; 
	}
	else
	{
		echo '<script language="javascript">alert("预约失败!");</script>';
		die(mysql_error());
		}
}
?>