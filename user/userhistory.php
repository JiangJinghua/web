<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>用户借用历史界面</title>
</head>
<script type = "text/javascript" language="javascript">
function jump1(number)
{
	if(confirm('确定要取消预约吗？'))
		location.href='reservationdel.php?number='+number;
}
function jump2(number)
{
	if(confirm('确定要取消预约吗？'))
		location.href='orderdel.php?number='+number;
}
</script>
<?php 
session_start();
$userid=$_SESSION['id'];
?>
<body bgcolor="#B9B9FF">
<form name="form1" method="post" action="">
<table width="80%" border="1" align="center">
  <tr>
  	<td width="10%"><div align="center">预约类型</div></td>
    <td width="12%"><div align="center">所属楼宇</div></td>
    <td width="9%"><div align="center">门牌号</div></td>
    <td width="14%"><div align="center">预约日期</div></td>
    <td width="11%"><div align="center">时间段</div></td>
    <td width="13%"><div align="center">预约理由</div></td>
    <td width="11%"><div align="center">审核状态</div></td>
    <td width="8%"><div align="center">口令</div></td>
    <td width="12%"><div align="center">取消预约</div></td>
  </tr>
  <?php 
		error_reporting(E_ALL ^ E_DEPRECATED);
		mysql_connect('localhost','root','123456') or die(mysql_error());
		mysql_select_db('roomweb');
		mysql_query('set names utf8');
		$rs1=mysql_query("select * from rw_reservation where userid='$userid' and reservationstate!='已取消' order by number DESC");
 		while($rows1=mysql_fetch_assoc($rs1)){
			echo '<tr>';
			echo '<td>长期预约</td>';	
			echo '<td>'.$rows1['location'].'</td>';
			echo '<td>'.$rows1['roomid'].'</td>';
			echo '<td>'.$rows1['reservationbeginweek'].'——'.$rows1['reservationendweek'].' 周'.$rows1['reservationweekday'].'</td>';
			echo '<td>'.$rows1['reservationinterval'].'</td>';
			echo '<td>'.$rows1['reservationreason'].'</td>';
			echo '<td>'.$rows1['reservationstate'].'</td>';
			if($rows1['reservationstate']=='审核通过')
				echo '<td>'.$rows1['command'].'</td>';
			else echo '<td></td>';
			if($rows1['reservationstate']=='未审核'||$rows1['reservationstate']=='审核通过')
				echo '<td><div align="center"><input type="button" value="取消" onclick="jump1('.$rows1['number'].')"></div></td>';
			else echo '<td></td>';
			echo '</tr>';
		}
		$rs2=mysql_query("select * from rw_order where userid='$userid' and orderstate!='已取消' order by number DESC");
 		while($rows2=mysql_fetch_assoc($rs2)){
			echo '<tr>';
			echo '<td>临时预约</td>';	
			echo '<td>'.$rows2['location'].'</td>';
			echo '<td>'.$rows2['roomid'].'</td>';
			echo '<td>'.$rows2['orderdate'].'</td>';
			echo '<td>'.$rows2['orderinterval'].'</td>';
			echo '<td>'.$rows2['orderreason'].'</td>';
			echo '<td>'.$rows2['orderstate'].'</td>';
			if($rows2['orderstate']=='未审核'||$rows2['orderstate']=='审核通过')
				echo '<td>'.$rows2['command'].'</td>';
			else echo '<td></td>';
			if($rows2['orderstate']=='未审核'||$rows2['orderstate']=='审核通过')
				echo '<td><div align="center"><input type="button" value="取消" onclick="jump2('.$rows2['number'].')"></div></td>';
			else echo '<td></td>';
			echo '</tr>';
		 }
?>
</table>
</form>

</body>
</html>