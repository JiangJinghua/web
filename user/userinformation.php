<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>个人信息页面</title>
</head>
<?php
	session_start();
	$userid=$_SESSION['id'];
	error_reporting(E_ALL ^ E_DEPRECATED);
	mysql_connect('localhost','root','123456') or die(mysql_error());
	mysql_select_db('roomweb');
	mysql_query('set names utf8');
	$rs=mysql_query("select * from rw_user where userid='$userid'");
	$rows=mysql_fetch_assoc($rs);
?>
<body bgcolor="#B9B9FF">
<form name="form1" method="post" action="" onSubmit="return check()">
  <div align="center">
    <table width="426" height="411" border="1px">
      <tr><th colspan="2">用户设置</th></tr>
      <tr>
        <td width="109"><div align="right">用户名</div></td>
        <td><div align="left"><?php echo $rows['userid']?>
        </div></td>
      </tr>
      <tr>
        <td><div align="right">密码</div></td>
        <td><?php echo $rows['password']?></td>
      </tr>
      <tr>
        <td><div align="right">姓名</div></td>
        <td><?php echo $rows['username']?></td>
      </tr>
      <tr>
        <td><div align="right">身份</div></td>
        <td><?php echo $rows['identity']?></td>
      </tr>
      <tr>
        <td><div align="right">权限</div></td>
        <td><?php echo $rows['authority']?></td>
      </tr>
      <tr>
        <td><div align="right">状态</div></td>
        <td><?php echo $rows['forbid']?></td>
      </tr>
      <tr>
        <td><div align="right">手机号码</div></td>
        <td><?php echo $rows['phone']?></td>
        </tr>
      <tr>
        <td><div align="right">密保问题</div></td>
        <td><?php echo $rows['question']?></td>
      </tr>
      <tr>
        <td><div align="right">密保答案</div></td>
        <td><?php echo $rows['answer']?></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">
          <input type="button" name='button' id="button" value="编辑" style="font-size:18px;margin-right:15px" onClick="window.location.href='informationset.php?userid=<?php echo $rows['userid']?>'">
        </div></td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>