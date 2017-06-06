<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>

<body bgcolor="#D1E9E9">
<form name="form1" method="post" action="">
  <table width="80%" height="186" border="1px" align="center">
    <tr width='50%'>
      <td height="104" colspan="2">&nbsp;</td>
      <td height="104">当前登录：<?php session_start();echo $_SESSION['id']?></td>
      <td height="104"><a target="_parent" href="../login.php">
      <div align="center">退出登录</div></a></td>
    </tr>
    <tr>
      <td width="47%"></td>
      <td width="20%"><a target="content" href="adminuser.php">
        <div align="center">
          <input type="button" name="usermanagement" id="usermanagement" value="用户管理" style="font-size:20px">
      </div></td>
      <td width="20%"><a target="content" href="adminorder.php">
        <div align="center">
          <input type="button" name="ordermanagement" id="ordermanagement" value="预约管理" style="font-size:20px">
      </div></td>
      <td width="20%"><a target="content" href="adminroom.php">
        <div align="center">
          <input type="button" name="roommanagement" id="roommanagement" value="教室管理" style="font-size:20px">
      </div></td>
    </tr>
  </table>
</form>
</body>
</html>