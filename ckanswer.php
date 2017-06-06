<?php 
	session_start();
 	$_SESSION['id']=$_POST['userid'];
	error_reporting(E_ALL ^ E_DEPRECATED);
	if(isset($_POST['button2']))//判断提交按钮
  	{
		  $userid=$_POST['userid'];
		  $answer=$_POST['answer'];
		  mysql_connect('localhost','root','123456') or die(mysql_error());
		  mysql_select_db('roomweb');
		  mysql_query('set names utf8');
		  $sql="select authority from rw_user where userid='$userid' and answer='$answer'";
		  $rs=mysql_query($sql);
		  //echo $rs;
		  if($rows=mysql_fetch_assoc($rs))//获得匹配记录数
		  {
			  
			  //echo '登录成功';
			  $_SESSION['authority']=$rows['authority'];
			  echo "<script>alert('用户登录成功!');window.location='user/user.php';</script>";
			  //header('location:user/user.php');
		  }
		  else{
			  //echo '登录失败';
			  echo "<script language='javascript'>alert('您输入的答案，请重新输入！');history.back();</script>";
          exit;
		  }
	  }
?>
