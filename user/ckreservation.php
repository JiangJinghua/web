<?php 
session_start();
$userid=$_SESSION['id'];
if(isset($_POST['applyreservation']))//判断提交按钮
{
	$id=$_POST['room'];
	$reservationbeginweek=$_POST['beginweek'];
	$reservationendweek=$_POST['endweek'];
	$reservationweekday=$_POST['weekday'];
	$reservationinterval=$_POST['interval'];
	$reservationreason=$_POST['reason'];
	$command=$_POST['command'];
	error_reporting(E_ALL ^ E_DEPRECATED);
	mysql_connect('localhost','root','123456') or die(mysql_error());
	mysql_select_db('roomweb');
	mysql_query('set names utf8');
	$sql1="select location,roomid from rw_room where id='$id'";
	$rs1=mysql_query($sql1);
	if($rows=mysql_fetch_assoc($rs1)){
		$location=$rows['location'];
		$roomid=$rows['roomid'];
	}
	$sql2="insert into rw_reservation values(NULL,'$userid','$location','$roomid','$reservationbeginweek','$reservationendweek','$reservationweekday','$reservationinterval','$reservationreason','未审核','$command')";
	$rs2=mysql_query($sql2);
	echo $sql2;
	if($rs2) 
	{	
		echo '<script language="javascript">alert("预约成功!");</script>';
		echo '<script language="javascript">window.location.href=document.referrer;</script>'; 
	}
	else
	{
		echo '<script language="javascript">alert("预约失败!");</script>';
		die(mysql_error());
		}
}
?>