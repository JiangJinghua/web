<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>用户修改页面</title>
<script language="javascript">
function check(){
	var password=document.getElementById("password");
	if (password.value==""){
		alert("请设置密码！");
		password.focus();
		return false;
	}
	var username=document.getElementById("username");
	if (username.value==""){
		alert("姓名不能为空!");
		username.focus();
		return false;
	}
	var identity=document.getElementById("identity");
	if (identity.value==""){
		alert("身份不能为空！");
		identity.focus();
		return false;
	}
	var phone=document.getElementById("phone");
	if (phone.value==""){
		alert("请设置手机号码！");
		phone.focus();
		return false;
	}
	var question=document.getElementById("question");
	if (question.value==""){
		alert("请设置密保问题！");
		question.focus();
		return false;
	}
	var answer=document.getElementById("answer");
	if (answer.value==""){
		alert("请设置答案！");
		answer.focus();
		return false;
	}
}
</script>
</head>
<body bgcolor="#B9B9FF">
<?php 
  error_reporting(E_ALL ^ E_DEPRECATED);
  if(isset($_POST['button']))//判断提交按钮
  {
	  $userid=$_POST['userid'];
	  $password=$_POST['password'];
	  $username=$_POST['username'];
	  $identity=$_POST['identity'];
	  $phone=$_POST['phone'];
	  $question=$_POST['question'];
	  $answer=$_POST['answer'];
	  mysql_connect('localhost','root','123456') or die(mysql_error());
	  mysql_select_db('roomweb');
	  mysql_query('set names utf8');
	  $sql="update rw_user set password='$password',username='$username',identity='$identity',phone='$phone',question='$question',answer='$answer' where userid='$userid'";
	  //echo $sql;
	  if(mysql_query($sql))
	  	echo "<script>alert('用户设置成功！');</script>";
	  else
	  	echo "<script>alert('用户设置失败！');</script>";
	}
?>
<?php
	$userid=$_GET['userid'];
	error_reporting(E_ALL ^ E_DEPRECATED);
	mysql_connect('localhost','root','123456') or die(mysql_error());
	mysql_select_db('roomweb');
	mysql_query('set names utf8');
	$rs=mysql_query("select * from rw_user where userid='$userid'");
	$rows=mysql_fetch_assoc($rs);
?>
<form name="form1" method="post" action="" onSubmit="return check()">
  <div align="center">
    <table width="426" height="411" border="1px">
      <tr><th colspan="3">个人信息设置</th></tr>
      <tr>
        <td width="109"><div align="right">用户名</div></td>
        <td colspan="2"><div align="left"><input type="text" name='userid' id="userid"  value="<?php echo $rows['userid']?>" readonly>
        </div></td>
      </tr>
      <tr>
        <td><div align="right">密码</div></td>
        <td colspan="2"><input type="text" name='password' id="password"  value="<?php echo $rows['password']?>"></td>
      </tr>
      <tr>
        <td><div align="right">姓名</div></td>
        <td colspan="2"><input type="text" name='username' id="username"  value="<?php echo $rows['username']?>"></td>
      </tr>
      <tr>
        <td><div align="right">身份</div></td>
        <td colspan="2"><input type="text" name='identity' id="identity"  value="<?php echo $rows['identity']?>">
        </td>
      </tr>
      <tr>
        <td><div align="right">权限</div></td>
        <td colspan="2"><?php echo $rows['authority']?></td>
      </tr>
      <tr>
        <td><div align="right">状态</div></td>
        <td colspan="2"><?php echo $rows['forbid']?></td>
      </tr>
      <tr>
        <td><div align="right">手机号码</div></td>
        <td colspan="2"><input type="text" name='phone' id="phone"  value="<?php echo $rows['phone']?>">
        </td>
        </tr>
       <tr>
        <td><div align="right">密保问题</div></td>
        <td><input type="text" name='question' id="question"  value="<?php echo $rows['question']?>" maxlength="10">
        十个字以内</td>
      </tr>
      <tr>
        <td><div align="right">密保答案</div></td>
        <td><input type="text" name='answer' id="answer"  value="<?php echo $rows['answer']?>" maxlength="10">
        十个字以内</td>
      </tr>
      <tr>
        <td colspan="3"><div align="center">
          <input type="submit" name='button' id="button" value="修改" style="font-size:18px;margin-right:15px">
          <input type="button" name='button1' id="button1" value="返回"  style="font-size:18px" onClick="location.href='userinformation.php'">
        </div></td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>