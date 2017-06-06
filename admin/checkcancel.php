<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>

<body bgcolor="#B9B9FF">
<form action="" method="post" id="form1">
  <div align="center">
    <table width="80%" height="20%" border="1px">
      <tr>
  <th width="17%"><p>所属楼宇</p>
    <select name="location" id="location"><br>
      <option value="逸夫楼" selected>逸夫楼</option><br>
      <option value="机电楼">机电楼</option><br>
      <option value="教学楼">教学楼</option><br>
    </select></th>
  <th width="25%"><p>门牌号</p>
    <input type="text" name="roomid" id="roomid">  </th>
  <th width="22%"><p>日期</p>
      <select name="date" id="date">
      <?php 
	  $i=1;
	  for($i = 1; $i < 4; $i++){ 
	  	if($i==1){  
			echo '<option selected value="'.$i.'">';
    		echo date('Y-m-d', strtotime('+'.$i.' day')).'</option>'; 
		}
		else{
			echo '<option value="$i">';
			echo date('Y-m-d', strtotime('+'.$i.' day')).'</option>';
		}
}
	  ?>
      </select>
      </th>
  <th width="19%"><p>时间段</p>
      <select name="interval" id="interval">
        <option>8:00-9:35</option>
        <option>9:55-11:30</option>
        <option>13:30-15:05</option>
        <option>15:20-16:55</option>
        <option>17:10-18:45</option>
        <option>19:30-21:05</option>
      </select></th>
  <th width="17%"><input name="ckorder" id="ckorder" type="submit" value="查询" style='font-size:20px'></th>
  </tr>
  </table>
  </div>
</form>
<form name="form2" method="post" action="ckorder.php" onSubmit="">
<table width="80%" border="1px" align="center">
  <tr>
  	<td width="12%"><div align="center">预约人</div></td>
    <td width="12%"><div align="center">所属楼宇</div></td>
    <td width="9%"><div align="center">门牌号</div></td>
    <td width="14%"><div align="center">预约日期</div></td>
    <td width="13%"><div align="center">时间段</div></td>
    <td width="19%"><div align="center">预约理由</div></td>
    <td width="12%"><div align="center">审核状态</div></td>
    <td width="9%"><div align="center">取消</div></td>
  </tr>
    <?php 
        error_reporting(E_ALL ^ E_DEPRECATED);
        if(isset($_POST['ckorder'])){
			$location=$_POST['location'];
			$roomid=$_POST['roomid'];
			$offset=$_POST['date'];
			$date=date('Y-m-d', strtotime('+'.$offset.' day'));
			$interval=$_POST['interval'];
			echo $interval;
			echo $date;
			mysql_connect('localhost','root','123456') or die(mysql_error());
			mysql_select_db('roomweb');
			mysql_query('set names utf8');
			$rs1=mysql_query("select * from rw_order where location='$location' and roomid='$roomid' and orderdate>='$date' and orderstate='审核通过'");
			$array1=array();
			if(mysql_num_rows($rs1)==0) echo "<script>alert('当前教室及时段无可撤销预约!');</script>";
			else while($rows=mysql_fetch_assoc($rs1)){
			echo '<tr>';
			echo '<td>'.$rows['userid'].'</td>';	
			echo '<td>'.$rows['location'].'</td>';
			echo '<td>'.$rows['roomid'].'</td>';
			echo '<td>'.$rows['orderdate'].'</td>';
			echo '<td>'.$rows['orderinterval'].'</td>';
			echo '<td>'.$rows['orderreason'].'</td>';
			echo '<td>'.$rows['orderstate'].'</td>';
			echo '<td><div align="center"><input type="button" value="取消" style="font-size:20px" onClick="window.location.href=\'cancel.php?number='.$rows['number'].'&userid='.$rows['userid'].'\'"></div></td>';
			echo '</tr>';
		    }
		}
		?>
</table>
</form>
</body>
</html>