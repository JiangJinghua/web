<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>用户修改页面</title>
<script language="javascript">
function check(){
	var password=document.getElementById("password");
	if (password.value==0){
		alert("密码不能为空！");
		password.focus();
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
	  $authority=$_POST['authority'];
	  $forbid=$_POST['forbid'];
	  mysql_connect('localhost','root','123456') or die(mysql_error());
	  mysql_select_db('roomweb');
	  mysql_query('set names utf8');
	  $sql="update rw_user set password='$password',authority='$authority',forbid='$forbid' where userid='$userid'";
	  echo $sql;
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
      <tr><th colspan="3">用户设置</th></tr>
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
        <td colspan="2"><input type="text" name='username' id="username"  value="<?php echo $rows['username']?>" readonly></td>
      </tr>
      <tr>
        <td><div align="right">身份</div></td>
        <td colspan="2"><input type="text" name='identity' id="identity"  value="<?php echo $rows['identity']?>" readonly>
        </td>
      </tr>
      <tr>
        <td><div align="right">权限</div></td>
        <td colspan="2">
        <select name="authority" id="authority">
            <option value="普通"<?php if($rows['authority']=="普通") echo 'selected';?>>普通</option>
            <option value="工作"<?php if($rows['authority']=="工作") echo 'selected';?>>工作</option>
          </select>
          </td>
      </tr>
      <tr>
        <td><div align="right">状态</div></td>
        <td colspan="2">
        <select name="forbid" id="forbid">
            <option value="未禁用"<?php if($rows['forbid']=="未禁用") echo 'selected';?>>未禁用</option>
            <option value="禁用"<?php if($rows['forbid']=="禁用") echo 'selected';?>>禁用</option>
          </select>
        </td>
      </tr>
      <tr>
        <td><div align="right">手机号码</div></td>
        <td colspan="2"><input type="text" name='phone' id="phone"  value="<?php echo $rows['phone']?>" readonly>
        </td>
        </tr>
      <tr>
        <td colspan="3"><div align="center">
          <input type="submit" name='button' id="button" value="修改" style="font-size:18px;margin-right:15px">
          <input type="button" name='button1' id="button1" value="返回"  style="font-size:18px" onClick="location.href='adminuser.php'">
        </div></td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>