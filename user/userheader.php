<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>用户界面头部</title>
</head>
<?php 
session_start();$userid=$_SESSION['id']?>
<body bgcolor="#D1E9E9">
<form name="form1" method="post" action="">
  <table width="80%" height="186" border="0" align="center">
    <tr width='50%'>
      <td height="104">&nbsp;</td>
      <td height="104"><div align="center">当前登录：
        <?php echo $userid?>
      </div></td>
      <td><a href="userinformation.php" target="usercontent">
      <div align="center">个人中心</div></td>
      <td height="104"><a target="_parent" href="../login.php">
      <div align="center">退出登录</div></a></td>
    </tr>
    <tr>
      <td width="52%"></td>
      <td width="18%"><a target="usercontent" href="userorder.php">
        <div align="center">
          <input type="button" name="usermanagement" id="usermanagement" value="临时预约" style="font-size:20px">
      </div></td>
      <td width="18%"><a target="usercontent" href="usercontrol.php">
      <div align="center">
          <input type="button" name="ordermanagement" id="ordermanagement" value="长期预约" style="font-size:20px">
      </div></td>
      <td width="18%"><a target="usercontent" href="userhistory.php">
        <div align="center">
          <input type="button" name="roommanagement" id="roommanagement" value="借用历史" style="font-size:20px">
      </div></td>
    </tr>
  </table>
</form>
</body>
</html>