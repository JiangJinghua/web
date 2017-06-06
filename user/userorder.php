<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>
<script language="javascript">
function checkroom(){
	var date=document.getElementById("date");
	if (date.value==""){
		alert("日期不能为空!");
		date.focus();
		return false;
	}
	var interval=document.getElementById("interval");
	if (interval.value==""){
		alert("时间段不能为空!");
		interval.focus();
		return false;
	}
	var number=document.getElementById("number");
	if (number.value==""){
		alert("预期人数不能为空!");
		number.focus();
		return false;
	}
}
function checkorder(){
	var room=document.getElementById("room");
	if (room.value==''||room.value==0){
		alert("请重新选择教室！");
		room.focus();
		return false;
	}
	var orderreason=document.getElementById("orderreason");
	if (orderreason.value==''){
		alert("借用理由不能为空!");
		orderreason.focus();
		return false;
	}
}
function addNumber(){ 
    var str = ''; 
    for(var i = 0; i < 6; i ++){ 
           str+=Math.floor(Math.random()*10);
    } 
    document.getElementById("command").value=str;
}
</script>
<body bgcolor="#B9B9FF">
<form name="form1" method="post" action="" onSubmit="return checkroom()">
<table width="80%" border="1" align="center">
  <tr>
    <td width="35%" height="108"><div align="right">
      <div align="right">日期
        <select name="date" id="date">
          <?php 
	  $i=1;
	  for($i = 1; $i < 4; $i++){ 
	  	if($i==1){  
			echo '<option selected value="'.$i.'">';
    		echo date('Y-m-d', strtotime('+'.$i.' day')).'</option>'; 
		}
		else{
			echo '<option value="'.$i.'">';
			echo date('Y-m-d', strtotime('+'.$i.' day')).'</option>';
		}
}
	  ?>
        </select>
      </div></td>
    <td width="35%"><div align="right">时间段
      <select name="interval" id="interval">
        <option>8:00-9:35</option>
        <option>9:55-11:30</option>
        <option>13:30-15:05</option>
        <option>15:20-16:55</option>
        <option>17:10-18:45</option>
        <option>19:30-21:05</option>
      </select>
    </div></td>
    <td width="30%" rowspan="2"><div align="center">
      <input type="hidden" name="command" id="command" value="">
      <input name="ckroom" id="ckroom" type="submit" value="查询合适教室" style="font-size:20px" onClick="addNumber()">
    </div></td>
  </tr>
  <tr>
    <td height="99"><div align="right">预期人数
      <input type="number" name="number" id="number" min="1" max="300">
    </div></td>
    <td><div align="right">教室类型
      <select name="kind" id="kind">
        <option>教室</option>
        <option>会议室</option>
      </select>
    </div></td>
    </tr>
  </table>
</form>
<form name="form2" method="post" action="ckorder.php" onSubmit="return checkorder()">
  <table width="80%" height="203" border="1" align="center">
    <tr>
      <td width="36%" rowspan="2"><div align="center">
        <p><strong>可选教室</strong>
          <?php 
        error_reporting(E_ALL ^ E_DEPRECATED);
        if(isset($_POST['ckroom'])){
			$offset=$_POST['date'];
			$date=date('Y-m-d', strtotime('+'.$offset.' day'));
			$interval=$_POST['interval'];
			$mincapacity=$_POST['number'];
			$command=$_POST['command'];
			$kind=$_POST['kind'];
			$begin= '2017-02-20';  
			$date1_arr = explode("-",$date);  
			$date2_arr = explode("-",$begin);  
			$day1 = mktime(0,0,0,$date1_arr[1],$date1_arr[2],$date1_arr[0]);  
			$day2 = mktime(0,0,0,$date2_arr[1],$date2_arr[2],$date2_arr[0]);  
			$days = round(($day1 - $day2)/3600/24);  
			$week=floor($days/7)+1;
			$weekday=$days%7+1;
			//echo $offset.'<br>';
			//echo $days.'<br>';
			//echo $week.'<br>';
			//echo $weekday.'<br>';
			mysql_connect('localhost','root','123456') or die(mysql_error());
			mysql_select_db('roomweb');
			mysql_query('set names utf8');
			$sql1="SELECT id,location,roomid,maxcapacity FROM rw_room WHERE maxcapacity>='$mincapacity' and kind='$kind' ORDER BY rw_room.maxcapacity ASC,rw_room.location ASC,rw_room.roomid ASC";
			$rs1=mysql_query($sql1);
			$rs2=mysql_query("select location,roomid from rw_order where orderdate='$date' and orderinterval='$interval'and orderstate!='审核未通过'");
			$sq3="select location,roomid from rw_reservation where reservationinterval='$interval' and reservationbeginweek<=$week and reservationendweek>=$week and reservationweekday='$weekday' and reservationstate!='审核未通过'";
			$rs3=mysql_query($sq3);
			$array1=array();
			$array2=array();
			$array3=array();
			if(mysql_num_rows($rs1))
				while($rows1=mysql_fetch_assoc($rs1))
					$array1[]=$rows1;
			else $array1[]=0;
			if(mysql_num_rows($rs2))
				while($rows2=mysql_fetch_assoc($rs2))
					$array2[]=$rows2;
			else $array2[]=0;
			if(mysql_num_rows($rs3))
				while($rows3=mysql_fetch_assoc($rs3))
					$array3[]=$rows3;
			else $array3[]=0;
			$num1=count($array1); 
			$num2=count($array2); 
			$num3=count($array3); 
			//print_r($array1);
			//print_r($array2);
			//print_r($array3);
			echo '<input type="hidden" name="date" value="'.$date.'">';
      		echo '<input type="hidden" name="interval" value="'.$interval.'">';
			echo '<input type="hidden" name="command" id="command" value="'.$command.'">';
			echo '<select name="room" id="room">';
			echo '<option value=0 selected>请选择</option>';
			for($i1=0;$i1<$num1;$i1++)
			{
				$flag=0;
				for($i2=0;$i2<$num2;$i2++)
					if($array1[$i1]['location']==$array2[$i2]['location']&&$array1[$i1]['roomid']==$array2[$i2]['roomid'])	$flag=1;
				for($i3=0;$i3<$num3;$i3++)
					if($array1[$i1]['location']==$array3[$i3]['location']&&$array1[$i1]['roomid']==$array3[$i3]['roomid'])	$flag=1;
				if($flag!=1) echo '<option value="'.$array1[$i1]['id'].'">'.$array1[$i1]['location'].$array1[$i1]['roomid']. $array1[$i1]['maxcapacity'].'座</option>';
			}
			echo '</select>';
		}
		?>
        </p>
      </div></td>
      <td width="64%" height="97">
        <div align="center">
          <div align="center">
            <p>借用理由（30字以内）</p>
            <p><textarea name="reason" cols="20" rows="3" maxlength="30"></textarea></p>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td height="100"><div align="center">
      	  <input type="submit" name="applyorder" id="applyorder" value="提交申请" style="font-size:20px">
      </div></td>
    </tr>
  </table>

</form>
</body>
</html>