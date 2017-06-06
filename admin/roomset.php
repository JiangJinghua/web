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
	  $sql="update rw_room set kind='$kind',permit='$permit',maxcapacity='$maxcapacity',borrowauthority='$borrowauthority',multimedia='$multimedia' where location='$location' and roomid='$roomid'";
	  echo $sql;
	  if(mysql_query($sql))
	  	echo "<script>alert('修改教室成功！');</script>";
	  else
	  	echo "<script>alert('修改教室失败！');</script>";
	}
?>
<?php
	$location=$_GET['location'];
	$roomid=$_GET['roomid'];
	error_reporting(E_ALL ^ E_DEPRECATED);
	mysql_connect('localhost','root','123456') or die(mysql_error());
	mysql_select_db('roomweb');
	mysql_query('set names utf8');
	$rs=mysql_query("select * from rw_room where location='$location' and roomid='$roomid'");
	$rows=mysql_fetch_assoc($rs);
?>

<form name="form1" method="post" action="" onSubmit="return check()">
  <div align="center">
    <table width="426" height="411" border="1px">
      <tr><th colspan="3">修改教室</th></tr>
      <tr>
        <td width="109"><div align="right">所属楼宇</div></td>
        <td colspan="2"><div align="left">
          <select name="location" id="location">
            <option value="逸夫楼" selected>逸夫楼</option>
          </select>
        </div></td>
      </tr>
      <tr>
        <td><div align="right">门牌号</div></td>
        <td colspan="2"><input type="text" name='roomid' id="roomid"  value="<?php echo $rows['roomid']?>" readonly></td>
      </tr>
      <tr>
        <td><div align="right">类型</div></td>
        <td colspan="2">
        <select name="kind" id="kind">
            <option value="教室" <?php if($rows['kind']=="教室") echo 'selected';?>>教室</option>
            <option value="会议室" <?php if($rows['kind']=="会议室") echo 'selected';?>>会议室</option>
          </select>
        </td>
      </tr>
      <tr>
        <td><div align="right">状态</div></td>
        <td colspan="2">
        <select name="permit" id="permit">
            <option value="可借"<?php if($rows['permit']=="可借") echo 'selected';?>>可借</option>
            <option value="不可借"<?php if($rows['permit']=="不可借") echo 'selected';?>>不可借</option>
          </select>
          </td>
      </tr>
      <tr>
        <td><div align="right">容量</div></td>
        <td colspan="2"><input type="text" name='maxcapacity' id="maxcapacity" value="<?php echo $rows['maxcapacity']?>"></td>
      </tr>
      <tr>
        <td><div align="right">借用权限</div></td>
        <td colspan="2">
        <select name="borrowauthority" id="borrowauthority">
            <option value="普通"<?php if($rows['borrowauthority']=="普通") echo 'selected';?>>普通 </option>
            <option value="工作"<?php if($rows['borrowauthority']=="工作") echo 'selected';?>>工作</option>
          </select>
        </td>
      </tr><tr>
        <td><div align="right">多媒体</div></td>
        <td colspan="2">
        <select name="multimedia" id="multimedia">
            <option value="有"<?php if($rows['multimedia']=="有") echo 'selected';?>>有 </option>
            <option value="无"<?php if($rows['multimedia']=="无") echo 'selected';?>>无</option>
          </select>
        </td>
        </tr>
      <tr>
        <td colspan="3"><div align="center">
          <input type="submit" name='button' id="button" value="修改" style="font-size:18px;margin-right:15px">
          <input type="button" name='button1' id="button1" value="返回"  style="font-size:18px" onClick="window.location.href='adminroom.php'">
        </div></td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>