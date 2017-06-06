<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>用户添加页面</title>
<script language="javascript">
function check(){
	var userid=document.getElementById("userid");
	if (userid.value=="" || isNaN(userid.value)){
		alert("用户名必须由数字组成！");
		userid.focus();
		return false;
	}
	var password=document.getElementById("password");
	if (password.value==""){
		alert("密码不能为空！");
		password.focus();
		return false;
	}
	var authority=document.getElementById("authority");
	if (authority.value==0){
		alert("请选择权限！");
		authority.focus();
		return false;
	}
	var forbid=document.getElementById("forbid");
	if (forbid.value==0){
		alert("请选择状态！");
		forbid.focus();
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
	  $authority=$_POST['authority'];
	  $forbid=$_POST['forbid'];
	  $phone=$_POST['phone'];
	  mysql_connect('localhost','root','123456') or die(mysql_error());
	  mysql_select_db('roomweb');
	  mysql_query('set names utf8');
	  $one=mysql_query("select * from rw_user where userid='$userid'");
	  if(mysql_num_rows($one)!=1)//查询是否已有该教室
	  {
	  $sql="insert into rw_user values('$userid','$password','$username','$identity','$authority','$forbid','$phone','你的父亲叫什么名字？','未设置')";
	  //echo $sql;
	  if(mysql_query($sql))
	  	echo "<script>alert('添加用户成功！');</script>";
	  else
	  	echo "<script>alert('添加用户失败！');</script>";
	  }
	  else echo "<script>alert('已有该用户！请重新输入！');</script>";
	}
?>
<form name="form1" method="post" action="" onSubmit="return check()">
  <div align="center">
    <table width="426" height="411" border="1px">
      <tr><th colspan="3">添加用户</th></tr>
      <tr>
        <td width="109"><div align="right">用户名</div></td>
        <td colspan="2"><div align="left"><input type="text" name='userid' id="userid">
        </div></td>
      </tr>
      <tr>
        <td><div align="right">密码</div></td>
        <td colspan="2"><input type="text" name='password' id="password"  value="111111" readonly></td>
      </tr>
      <tr>
        <td><div align="right">姓名</div></td>
        <td colspan="2"><input type="text" name='username' id="username"  value="未设置" readonly></td>
      </tr>
      <tr>
        <td><div align="right">身份</div></td>
        <td colspan="2"><input type="text" name='identity' id="identity"  value="未设置" readonly>
        </td>
      </tr>
      <tr>
        <td><div align="right">权限</div></td>
        <td colspan="2">
        <select name="authority" id="authority">
        	<option value=0 selected>请选择</option>
            <option value="普通">普通</option>
            <option value="工作">工作</option>
          </select>
          </td>
      </tr>
      <tr>
        <td><div align="right">状态</div></td>
        <td colspan="2">
        <select name="forbid" id="forbid">
        	<option value=0 selected>请选择</option>
            <option value="未禁用">未禁用</option>
            <option value="禁用">禁用</option>
          </select>
        </td>
      </tr>
      <tr>
        <td><div align="right">手机号码</div></td>
        <td colspan="2"><input type="text" name='phone' id="phone" value="未设置" readonly>
        </td>
        </tr>
      <tr>
        <td colspan="3"><div align="center">
          <input type="submit" name='button' id="button" value="添加" style="font-size:18px;margin-right:15px">
          <input type="button" name='button1' id="button1" value="返回"  style="font-size:18px" onClick="location.href='adminuser.php'">
        </div></td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>