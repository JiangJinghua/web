<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>教室预约借用系统</title>
<script language="javascript">
function check(){
	var userid=document.getElementById("userid");
	if (userid.value==""){
		alert("请输入用户名!");
		userid.focus();
		return false;
	}
	var pwd=document.getElementById("pwd");
	if (pwd.value==""){
		alert("请输入密码!");
		pwd.focus();
		return false;
	}
	var usertype=document.getElementById("usertype");
	if (usertype.value==0){
		alert("选择用户类型!");
		usertype.focus();
		return false;
	}	
}
</script>
</head>
<body bgcolor="#B9B9FF">
  <br>
  <br><br><br><br><br><br><br><br><br>
  <form name="form" action="cklogin.php" method="post" onSubmit="return check()">
    <table width="500" height="182" border="5" align="center" >
    <tr>
      <td colspan="3"><div align="center"><strong>教室预约借用系统</strong></div></td>
    </tr>
    <tr>
      <td width="151"><div align="center"><strong>用户名：</strong></div></td>
      <td width="176" ><strong>
        <input type="text" name="userid" id="userid" size="25">
      </strong></td>
    </tr>
    <tr>
      <td><div align="center"><strong>密码：</strong></div></td>
      <td ><strong>
        <input type="password" name="pwd" id="pwd" size="25">
      </strong></td>
    </tr>
    <tr>
      <td height="28" colspan="3"><div align="center">
        <p> <strong>
          <input type="radio" name=usertype  value="普通用户"checked>
          普通用户
          <input type="radio" name=usertype  value="管理员">
          管理员</strong></p>
      </div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"> <strong>
        <input type="submit" name="button1" id="button1" value="提交" style="font-size:25px;margin-right:15px" >
        <input type="reset" name="button2" id="button2" value="重置" style="font-size:25px;margin-left:15px">
      </strong></div></td>
      <td width="143"><a href="answerlogin.php"><div align="center">
        <input type="button" name="button3" id="button3" value="忘记密码？" style="font-size:20px">
      </div></td>
    </tr>
    </table>
</form>
<strong><br>
<br><br><br>
</strong><br>
</form>
</body>
</html>