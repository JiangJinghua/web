<html>
<head>
<meta charset="utf-8">
<title>管理首页</title>
<style type="text/css">
body,td,th {
	font-size: 36%;
	font-weight: bold;
}
body {
	background-color: #FFF;
}
</style>
</head>

<body>
<br><br><br><br><br><br>
<table width=60% height=60% border=1 align="center">
	<tr height=25% bgcolor=lightblue>
		<td colspan="3"><div align="right"><a href="../login.php" target="_self"><font size="+3">退出登录</font></a></div></td>		
	</tr>
	<tr height=65%>
		<td width=33% align="center" valign="middle" bgcolor=azure><form name="form1" method="post" action="">
          <input type="button"  name="usermanagement" id="usermanagement" value="用户管理"  onclick="location.href='usermanagement.php'" style="width: 100px; height: 100px;border-radius:20px">
      </form></td>
		<td width=33% align="center" valign="middle" bgcolor=azure><form name="form2" method="post" action="">
		  <input type="button"  name="appointmentmanagement" id="appointmentmanagement" value="预约管理" onclick="location.href='appointmentmanagement.php'" style="width: 100px; height: 100px;border-radius:20px">
	    </form></td>
		<td width=33% align="center" valign="middle" bgcolor=azure><form name="form3" method="post" action="">
		  <input type="button"  name="roommanagement" id="roommanagement" value="教室管理" onclick="location.href='roommanagement.php'" style="width: 100px; height: 100px;border-radius:20px">
	    </form></td>
	</tr>
	<tr height=10% bgcolor=gray>
		<td colspan="3" bgcolor="gray"></td>		
	</tr>	
</table>
</body>
</html>