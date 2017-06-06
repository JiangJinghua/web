<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>
<script language="javascript">
function check1(){
	var userid=document.getElementById("userid");
	if (userid.value==""){
		alert("请输入用户名!");
		userid.focus();
		return false;
	}	
}
function check2(){
	var answer=document.getElementById("");
	if (answer.value==""){
		alert("请输入答案!");
		answer.focus();
		return false;
	}	
}
</script>
<body bgcolor="#B9B9FF">
<form action="" method="post" name="form1" onSubmit="return check1()">
<div align="center"><br>
  <br><br><br><br><br><br><br><br><br>
</div>
<table width="500" height="167" border="5" align="center">
  <tr>
    <td height="65" colspan="2"><div align="center">教室预约系统密保登录界面</div></td>
    </tr>
  <tr>
    <td width="61%">用户名<input type="text" name="userid" id="userid" size="25"></td>
    <td width="39%"><div align="center">
      <input type="submit" name="button1" id="button1" value="确定" style="font-size:20px" >
    </div></td>
  </tr>
</table>
</form>
<form action="ckanswer.php" method="post" name="form2">
<div align="center">
</div>
<table width="500" height="167" border="5" align="center">
  <tr>
    <td height="65">问题
    <?php
	error_reporting(E_ALL ^ E_DEPRECATED);
    if(isset($_POST['button1'])){
		$userid=$_POST['userid'];
		mysql_connect('localhost','root','123456') or die(mysql_error());
		mysql_select_db('roomweb');
		mysql_query('set names utf8');
		$sql="select question,answer from rw_user where userid='$userid'";
		$rs=mysql_query($sql);
		echo '<input type="hidden" name="userid" value="'.$userid.'">';
		if($rows=mysql_fetch_assoc($rs)){
			if($rows['answer']=='未设置')
			 echo "<script>alert('该用户未设置密保!请您检查用户名是否正确！');</script>";
			else
			 echo '<input type="text" name="answer" id="answer" value="'.$rows['question'].'" size="25" readonly>';
		}
	}
    ?></td>
    <td width="39%" rowspan="2"><div align="center">
      <input type="submit" name="button2" id="button2" value="登录" style="font-size:20px" >
    </div></td>
    </tr>
  <tr>
    <td width="61%"><div align="left">答案
        <input type="text" name="answer" id="answer" size="25">
    </div></td>
    </tr>
</table>

</form>
</body>
</html>