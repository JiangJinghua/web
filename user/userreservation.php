<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>
<script language="javascript">
function checkroom(){
	var beginweek=document.getElementById("beginweek");
	if (beginweek.value==""){
		alert("起始周不能为空!");
		beginweek.focus();
		return false;
	}
	var endweek=document.getElementById("endweek");
	if (endweek.value==""||endweek.value<=beginweek.value){
		alert("终止周必须大于起始周!");
		endweek.focus();
		return false;
	}
	var weekday=document.getElementById("weekday");
	if (endweek.value==""){
		alert("终止周必须大于起始周!");
		endweek.focus();
		return false;
	}
	var number=document.getElementById("number");
	if (number.value==""){
		alert("预期人数不能为空!");
		number.focus();
		return false;
	}
}
function checkreservation(){
	var orderreason=document.getElementById("orderreason");
	if (orderreason.value==''){
		alert("借用理由不能为空!");
		orderreason.focus();
		return false;
	}
	var room=document.getElementById("room");
	if (room.value==''){
		alert("借用理由不能为空!");
		room.focus();
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
      <td height="108" colspan="2"><div align="center">起始周
        <input type="number" name="beginweek" id="beginweek" min="1" max="21">
        终止周<input type="number" name="endweek" id="endweek" min="1" max="21">
      </div></td>
      <td width="30%" rowspan="3"><div align="center">
      	<input type="hidden" name="command" id="command" value="">
        <input name="ckroom" id="ckroom" type="submit" value="查询合适教室" style="font-size:20px" onClick="addNumber()">
      </div></td>
    </tr>
    <tr>
    <td width="35%" height="108"><div align="right">
      <div align="right">星期
        <select name="weekday" id="weekday">
          <?php 
	  $i=1;
	  for($i = 1; $i < 8; $i++){ 
	  	if($i==1){  
			echo '<option selected value="'.$i.'">';
    		echo $i.'</option>'; 
		}
		else{
			echo '<option value="'.$i.'">';
			echo $i.'</option>';
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
<form name="form2" method="post" action="ckreservation.php" onSubmit="return checkreservation()">
  <table width="80%" height="203" border="1" align="center">
    <tr>
      <td width="36%" rowspan="2"><div align="center">
        <p><strong>可选教室</strong>
          <?php 
        error_reporting(E_ALL ^ E_DEPRECATED);
        if(isset($_POST['ckroom'])){
			$beginweek=$_POST['beginweek'];
			$endweek=$_POST['endweek'];
			$weekday=$_POST['weekday'];
			$interval=$_POST['interval'];
			$mincapacity=$_POST['number'];
			$kind=$_POST['kind'];
			$command=$_POST['command'];
			$offset=($beginweek-1)*7+$weekday-1; 
			echo $offset.'<br>';
			$date=date("2017-02-20");
			$now=date('Y-m-d');
			$date1_arr = explode("-",$date);  
			$date2_arr = explode("-",$now);  
			$day1 = mktime(0,0,0,$date1_arr[1],$date1_arr[2],$date1_arr[0]);  
			$day2 = mktime(0,0,0,$date2_arr[1],$date2_arr[2],$date2_arr[0]);  
			$days = round(($day2 - $day1)/3600/24);
			$offset=$offset-$days;
			//echo $offset.'<br>';  
			//echo $date.'<br>';
			//echo $now.'<br>';
			//echo $days.'<br>';
			if($offset>3)
			{
				mysql_connect('localhost','root','123456') or die(mysql_error());
				mysql_select_db('roomweb');
				mysql_query('set names utf8');
				$sql1="SELECT id,location,roomid,maxcapacity FROM rw_room WHERE maxcapacity>='$mincapacity' and kind='$kind' ORDER BY maxcapacity ASC,location ASC,roomid ASC";
				$rs1=mysql_query($sql1);
				$sq2="select location,roomid from rw_reservation where reservationinterval='$interval' and (reservationbeginweek<=$beginweek and reservationendweek>=$beginweek or reservationbeginweek<=$endweek and reservationendweek>=$endweek) and reservationweekday='$weekday' and reservationstate!='审核未通过'";
				$rs2=mysql_query($sq2);
				$array1=array();
				$array2=array();
				if(mysql_num_rows($rs1))
					while($rows1=mysql_fetch_assoc($rs1))
						$array1[]=$rows1;
				else $array1[]=0;
				if(mysql_num_rows($rs2))
					while($rows2=mysql_fetch_assoc($rs2))
						$array2[]=$rows2;
				else $array2[]=0;
				$num1=count($array1); 
				$num2=count($array2);  
				//print_r($array1);
				//print_r($array2);
				echo '<input type="hidden" name="beginweek" value="'.$beginweek.'"><br>';
				echo '<input type="hidden" name="endweek" value="'.$endweek.'"><br>';
				echo '<input type="hidden" name="weekday" value="'.$weekday.'"><br>';
				echo '<input type="hidden" name="interval" value="'.$interval.'"><br>';
				echo '<input type="hidden" name="command" id="command" value="'.$command.'">';
				echo '<select name="room" id="room">';
				echo '<option value=0 selected>请选择</option>';
				for($i1=0;$i1<$num1;$i1++)
				{
					$flag=0;
					for($i2=0;$i2<$num2;$i2++)
						if($array1[$i1]['location']==$array2[$i2]['location']&&$array1[$i1]['roomid']==$array2[$i2]['roomid'])	$flag=1;
					if($flag!=1) echo '<option value="'.$array1[$i1]['id'].'">'.$array1[$i1]['location'].$array1[$i1]['roomid']. $array1[$i1]['maxcapacity'].'座</option>';
				}
				echo '</select>';
			}
			else echo "<script>alert('长期预约必须在三天前预约!例如本周一最早可以预约在本周五的教室');</script>";
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
        <input type="submit" name="applyreservation" id="applyreservation" value="提交申请" style="font-size:20px">
      </div></td>
    </tr>
  </table>

</form>
</body>
</html>