<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>用户管理页面</title>
</head>
<script type = "text/javascript" language="javascript">
function jump(id)
{
	if(confirm('确定要重置该用户的密码？'))
		if(confirm('请再次确定，是否重置？'))
			location.href='psdset.php?userid='+id;
}
</script>
<body bgcolor="#B9B9FF">
<form action="" method="post" id="form1">
  <div align="center"><table width="80%" height="30%" border="1">
  <tr>
    <td width="27%" height="155"><div align="right">用户名</div></td>
    <td width="29%"><input type="text" name="userid" id="userid"></td>
    <td width="22%"><div align="center">
      <input name="selectuser" id="selectuser" type="submit" value="查询" style='font-size:20px'>
      </div></td>
    <td width="22%"><div align="center">
      <input type="button" name="button" id="button" value="添加" style='font-size:20px'onClick="window.location.href='useradd.php'">
      </div></td>
  </tr>
  </table>

  </div>
</form>
<form method="get" target="_self" id="form2">
<table width="80%" height="20%" border="1px" align="center">
<tr>
<th width="16%" height="81">用户名</th>
<th width="12%">姓名</th><th width="14%">身份</th><th width="11%">权限</th><th width="11%">状态</th><th width="14%">手机号码</th>
<th width="10%">修改</th>
<th width="12%">重置密码</th>
<?php 
	error_reporting(E_ALL ^ E_DEPRECATED);
	if(isset($_POST['selectuser'])){
		$userid=$_POST['userid'];
		mysql_connect('localhost','root','123456') or die(mysql_error());
		mysql_select_db('roomweb');
		mysql_query('set names utf8');
		$rs=mysql_query("select * from rw_user where userid='$userid'");
		//echo $rs;
 		if($rows=mysql_fetch_assoc($rs)){
			echo '<tr>';	
			echo '<td>'.$rows['userid'].'</td>';
			echo '<td>'.$rows['username'].'</td>';
			echo '<td>'.$rows['identity'].'</td>';
			echo '<td>'.$rows['authority'].'</td>';
			echo '<td>'.$rows['forbid'].'</td>';
			echo '<td>'.$rows['phone'].'</td>';
			echo '<td><div align="center"><input type="button" value="修改" style="font-size:20px" onClick="window.location.href=\'userset.php?userid='.$rows['userid'].'\'"></div></td>';
			echo '<td><div align="center"><input type="button" value="重置" style="font-size:20px" onClick="jump('.$rows['userid'].')"></div></td>';
			echo '</tr>';
		 }
		 else echo "<script>alert('该用户不存在！');</script>";
	}
?>
</tr>
<tr>
</tr>
</table>
</form>
</body>
</html>