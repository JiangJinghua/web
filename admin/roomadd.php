<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>教室设置页面</title>
<script language="javascript">
function check(){
	var location=document.getElementById("location");
	if (location.value==0){
		alert("请选择所属楼宇！");
		location.focus();
		return false;
	}
	var roomid=document.getElementById("roomid");
	if (roomid.value==""){
		alert("门牌号不能为空!");
		roomid.focus();
		return false;
	}
	var kind=document.getElementById("kind");
	if (kind.value==0){
		alert("请选择类型！");
		kind.focus();
		return false;
	}
	var permit=document.getElementById("permit");
	if (permit.value==0){
		alert("请选择状态！");
		permit.focus();
		return false;
	}
	var maxcapacity=document.getElementById("maxcapacity");
	if (maxcapacity.value=="" || isNaN(maxcapacity.value)||maxcapacity.value.indexOf('.')!=-1){
		alert("容量必须是一个整数!");
		maxcapacity.select();
		return false;
	}
	var borrowauthority=document.getElementById("borrowauthority");
	if (borrowauthority.value==0){
		alert("请选择借用权限！");
		borrowauthority.focus();
		return false;
	}
	var multimedia=document.getElementById("multimedia");
	if (multimedia.value==0){
		alert("请选择类型！");
		multimedia.focus();
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
	  $location=$_POST['location'];
	  $roomid=$_POST['roomid'];
	  $kind=$_POST['kind'];
	  $permit=$_POST['permit'];
	  $maxcapacity=$_POST['maxcapacity'];
	  $borrowauthority=$_POST['borrowauthority'];
	  $multimedia=$_POST['multimedia'];
	  mysql_connect('localhost','root','123456') or die(mysql_error());
	  mysql_select_db('roomweb');
	  mysql_query('set names utf8');
	  $one=mysql_query("select * from rw_room where location='$location' and roomid='$roomid'");
	  if(mysql_num_rows($one)!=1)//查询是否已有该教室
	  {
		  $sql="insert into rw_room values('$location','$roomid','$kind','$permit','$maxcapacity','$borrowauthority','$multimedia')";
		  echo $sql;
		  if(mysql_query($sql))
		  echo "<script>alert('添加教室成功！');</script>";
		  else
		  echo "<script>alert('添加教室失败！');</script>";
	  }
	  else echo "<script>alert('已有该教室！请重新输入！');</script>";
  }
?>
<form name="form1" method="post" action="" onSubmit="return check()">
  <div align="center">
    <table width="426" height="411" border="1px">
      <tr><th colspan="3">添加教室</th></tr>
      <tr>
        <td width="109"><div align="right">所属楼宇</div></td>
        <td colspan="2"><div align="left">
          <select name="location" id="location">
          	<option value=0 selected>请选择</option>
            <option value="逸夫楼" >逸夫楼</option>
            <option value="机电楼">机电楼</option>
            <option value="教学楼">教学楼</option>
          </select>
        </div></td>
      </tr>
      <tr>
        <td><div align="right">门牌号</div></td>
        <td colspan="2"><input type="text" name='roomid' id="roomid"></td>
      </tr>
      <tr>
        <td><div align="right">类型</div></td>
        <td colspan="2">
        <select name="kind" id="kind">
        	<option value=0 selected>请选择</option>
            <option value="教室">教室</option>
            <option value="会议室">会议室</option>
          </select>
        </td>
      </tr>
      <tr>
        <td><div align="right">状态</div></td>
        <td colspan="2">
        <select name="permit" id="permit">
        	<option value=0 selected>请选择</option>
            <option value="可借">可借</option>
            <option value="不可借">不可借</option>
          </select>
          </td>
      </tr>
      <tr>
        <td><div align="right">容量</div></td>
        <td colspan="2"><input type="text" name='maxcapacity' id="maxcapacity"></td>
      </tr>
      <tr>
        <td><div align="right">借用权限</div></td>
        <td colspan="2">
        <select name="borrowauthority" id="borrowauthority">
        	<option value=0 selected>请选择</option>
            <option value="普通">普通 </option>
            <option value="工作">工作</option>
          </select>
        </td>
      </tr><tr>
        <td><div align="right">多媒体</div></td>
        <td colspan="2">
        <select name="multimedia" id="multimedia">
        	<option value=0 selected>请选择</option>
            <option value="有">有 </option>
            <option value="无">无</option>
          </select>
        </td>
        </tr>
      <tr>
        <td colspan="3"><div align="center">
          <input type="submit" name='button' id="button" value="添加" style="font-size:18px;margin-right:15px">
          <input type="button" name='button1' id="button1" value="返回"  style="font-size:18px" onClick="location.href='adminroom.php'">
        </div></td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>