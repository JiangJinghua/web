<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>教室管理</title>
</head>
<script type = "text/javascript" language="javascript">
function jump2(id)
{
	if(confirm('确定要取消删除教室吗？'))
		location.href='roomdel.php?id='+id;
}
</script>
<body bgcolor="#B9B9FF">
<form action="" method="post" name="form1" id="form1">
  <div align="center">
    <table width="80%" height="20%" border="1px">
      <tr>
  <th>所属楼宇 <select name="location" id="location">
    <option value="逸夫楼" selected>逸夫楼</option>
    <option value="机电楼">机电楼</option>
    <option value="教学楼">教学楼</option>
  </select>  </th>
  <th width="37%">门牌号
    <input type="text" name="roomid" id="roomid">
  <th width="15%"> <input name="selectroom" id="selectroom" type="submit" value="查询" style='font-size:20px'>  </th>
  <th width="19%"> <input type="button" name="button" id="button" value="添加" style='font-size:20px'onClick="window.location.href='roomadd.php'">  </th>
  </tr>
  </table>
  </div>
</form>
<form method="get" target="_self" name="form2" id="form2">
<table width="80%" height="20%" border="1px" align="center">
<tr>
<th height="81">所属楼宇</th><th>门牌号</th><th>类型</th><th>状态</th><th>容量</th><th>权限</th><th>多媒体</th><th>修改</th><th>删除</th>
<?php 
	error_reporting(E_ALL ^ E_DEPRECATED);
	if(isset($_POST['selectroom'])){
		$location=$_POST['location'];
		$roomid=$_POST['roomid'];
		//echo $location;
		//echo $roomid;
		mysql_connect('localhost','root','123456') or die(mysql_error());
		mysql_select_db('roomweb');
		mysql_query('set names utf8');
		$rs=mysql_query("select * from rw_room where roomid='$roomid' and location='$location'");
		//echo $rs;
 		if($rows=mysql_fetch_assoc($rs)){
			echo '<tr>';	
			echo '<td>'.$rows['location'].'</td>';
			echo '<td>'.$rows['roomid'].'</td>';
			echo '<td>'.$rows['kind'].'</td>';
			echo '<td>'.$rows['permit'].'</td>';
			echo '<td>'.$rows['maxcapacity'].'</td>';
			echo '<td>'.$rows['borrowauthority'].'</td>';
			echo '<td>'.$rows['multimedia'].'</td>';
			echo '<td><div align="center"><input type="button" value="修改" style="font-size:20px" onClick="window.location.href=\'roomset.php?roomid='.$rows['roomid'].'&location='.$rows['location'].'\'"></div></td>';
			echo '<td><div align="center"><input type="button" value="删除" style="font-size:20px" onClick="jump2('.$rows['id'].')"></div></td>';
			echo '</tr>';
		 }
		 else echo "<script>alert('该教室不存在！');</script>";
	}
?>
</tr>
<tr>
</tr>
</table>
</form>
<form name="form3" id="form3" method="post" action="">
<table width="80%" border="1" align="center">
  <tr>
  	<td width="15%"><div align="center">预约类型</div></td>
  	<td width="15%"><div align="center">用户名</div></td>
    <td width="20%"><div align="center">预约日期</div></td>
    <td width="17%"><div align="center">时间段</div></td>
    <td width="18%"><div align="center">预约理由</div></td>
  </tr>
  <?php 
	error_reporting(E_ALL ^ E_DEPRECATED);
	if(isset($_POST['selectroom'])){
		$location=$_POST['location'];
		$roomid=$_POST['roomid'];
		mysql_connect('localhost','root','123456') or die(mysql_error());
		mysql_select_db('roomweb');
		mysql_query('set names utf8');
		$rs1=mysql_query("select * from rw_reservation where location='$location' and roomid='$roomid' and reservationstate='审核通过' order by number DESC");
 		while($rows1=mysql_fetch_assoc($rs1)){
			echo '<tr>';
			echo '<td>长期预约</td>';
			echo '<td>'.$rows1['userid'].'</td>';
			echo '<td>'.$rows1['reservationbeginweek'].'——'.$rows1['reservationendweek'].' 周'.$rows1['reservationweekday'].'</td>';
			echo '<td>'.$rows1['reservationinterval'].'</td>';
			echo '<td>'.$rows1['reservationreason'].'</td>';
			echo '</tr>';
		}
		$rs2=mysql_query("select * from rw_order where location='$location' and roomid='$roomid' and orderstate='审核通过' order by number DESC");
 		while($rows2=mysql_fetch_assoc($rs2)){
			echo '<tr>';
			echo '<td>临时预约</td>';	
			echo '<td>'.$rows2['userid'].'</td>';
			echo '<td>'.$rows2['orderdate'].'</td>';
			echo '<td>'.$rows2['orderinterval'].'</td>';
			echo '<td>'.$rows2['orderreason'].'</td>';
			echo '</tr>';
		 }
	}
?>
</table>
</form>
</body>
</html>