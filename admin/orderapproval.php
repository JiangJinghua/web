<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>用户临时预约界面</title>
</head>
<script type = "text/javascript" language="javascript">
function jump(number)
{
	if(confirm('确定要通过该条预约吗？'))
		location.href='orderadopt.php?number='+number;
}
function jump2(number)
{
	if(confirm('确定要不通过该条预约吗？'))
		location.href='orderveto.php?number='+number;
}
</script>
<body bgcolor="#B9B9FF">
<form name="form1" method="post" action="">
<table width="80%" border="1" align="center">
  <tr>
  	<td width="11%"><div align="center">预约人</div></td>
    <td width="13%"><div align="center">所属楼宇</div></td>
    <td width="10%"><div align="center">门牌号</div></td>
    <td width="12%"><div align="center">预约日期</div></td>
    <td width="12%"><div align="center">时间段</div></td>
    <td width="14%"><div align="center">预约理由</div></td>
    <td width="11%"><div align="center">审核状态</div></td>
    <td width="7%"><div align="center">通过</div></td>
    <td width="10%"><div align="center">不通过</div></td>
  </tr>
  <?php 
		error_reporting(E_ALL ^ E_DEPRECATED);
		mysql_connect('localhost','root','123456') or die(mysql_error());
		mysql_select_db('roomweb');
		mysql_query('set names utf8');
		$rs=mysql_query("select * from rw_order where orderstate='未审核' order by number");
 		while($rows=mysql_fetch_assoc($rs)){
			echo '<tr>';
			echo '<td>'.$rows['userid'].'</td>';	
			echo '<td>'.$rows['location'].'</td>';
			echo '<td>'.$rows['roomid'].'</td>';
			echo '<td>'.$rows['orderdate'].'</td>';
			echo '<td>'.$rows['orderinterval'].'</td>';
			echo '<td>'.$rows['orderreason'].'</td>';
			echo '<td>'.$rows['orderstate'].'</td>';
			echo '<td><div align="center"><input type="button" value="通过" onclick="jump('.$rows['number'].')"></div></td>';
			echo '<td><div align="center"><input type="button" value="不通过" onclick="jump2('.$rows['number'].')"></div></td>';
			echo '</tr>';
		 }
?>
</table>
</form>

</body>
</html>