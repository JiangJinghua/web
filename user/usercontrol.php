<?php 
	session_start();
	$authority=$_SESSION['authority'];
	if($authority=='工作')
		echo "<script>window.location='userreservation.php';</script>";
	else{
	echo "<script>alert('你没有权限长期预约!');</script>";
	echo '<script>window.location=userorder.php;</script>';
	}
	echo '请选择其他功能！';
?>