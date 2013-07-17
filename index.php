<?php include 'conn_db_open.php'; ?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="GENERATOR" content="Microsoft FrontPage 3.0">
<title>软二拼车系统</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
软二拼车系统<br>
<?php
session_start();

//如果SESSION为空 且 COOKIE不为空，说明是刚打开浏览器，则根据cookie自动登录
$cookiename = $_COOKIE['pingche_username'];
if($_SESSION['pingche_username']=="" && $cookiename!="" )
{
	$result=mysql_query("SELECT * FROM pingche_user WHERE username='$cookiename'", $con);
	$row = mysql_fetch_array($result);
  $_SESSION['pingche_userid'] = $row['userid'];
	$_SESSION['pingche_username'] = $row['username'];
	$_SESSION['pingche_userlevel'] = $row['userlevel'];
	$_SESSION['pingche_usercount'] = $row['usercount'];
}

//显示用户信息
if($_SESSION['pingche_username'] =="")
{ 
	echo "[<a href=user.php>登录</a>]　　[<a href=user_registe.php>注册</a>]<br><br>";
}
else
{
  echo "用户:".$_SESSION['pingche_username']."　　[<a href=user_logout.php>登出</a>]<br>";
  echo "[<a href=seat_add.php>我要提供车位</a>]<br><br>";
  echo "[<a href=book_cancel.php>取消我的拼车</a>]<br><br>";
  echo "[<a href=book_total.php>我的拼车统计</a>]<br>";

  if($_SESSION['pingche_userlevel'] >=10)
  {
  	echo "[<a href=admin_shop_add.php>店铺管理</a>]<br>";
  	echo "[<a href=admin_item_add.php>套餐管理</a>]<br>";
  	echo "[人员管理(暂缺)]<br>";
  }
}
?>


<!-- 显示倒计时 start-->
<form name="form_timer">  
<div align="center" align="center"> 
<input type="textarea" name="left" size="35" style="text-align: center; color:#FF0000; font-size:24px">
</div>  
</form>  
<script LANGUAGE="javascript">  
startclock()  
var timerID = null;  
var timerRunning = false;  
function showtime() {  
Today = new Date();  
var NowHour = Today.getHours();  
var NowMinute = Today.getMinutes();  
var NowMonth = Today.getMonth();  
var NowDate = Today.getDate();  
var NowYear = Today.getYear();  
var NowSecond = Today.getSeconds();  
if (NowYear <2000)  
NowYear=1900+NowYear;  
Today = null;  
Hourleft = 17 - NowHour  
Minuteleft = 30 - NowMinute  
Secondleft = 0 - NowSecond  
Yearleft = 2020 - NowYear  
Monthleft = 12 - NowMonth - 1
Dateleft = 31 - NowDate  
if (Secondleft<0)  
{  
Secondleft=60+Secondleft;  
Minuteleft=Minuteleft-1;  
}  
if (Minuteleft<0)  
{   
Minuteleft=60+Minuteleft;  
Hourleft=Hourleft-1;  
}  
if (Hourleft<0)  
{  
Hourleft=24+Hourleft;  
Dateleft=Dateleft-1;  
}  
if (Dateleft<0)  
{  
Dateleft=31+Dateleft;  
Monthleft=Monthleft-1;  
}  
if (Monthleft<0)  
{  
Monthleft=12+Monthleft;  
Yearleft=Yearleft-1;  
}  

//Temp=Yearleft+'年, '+Monthleft+'月, '+Dateleft+'天, '+Hourleft+'小时, '+Minuteleft+'分, '+Secondleft+'秒'
TimeRemain = Hourleft*3600+Minuteleft*60+Secondleft
if(TimeRemain >=(10*60*60+30*60) )
{
	Temp='今天的拼车时间已过'
}
else
{
	Temp='距离拼车截止还剩:'
	if(Hourleft<10)
		Temp=Temp+'0'+Hourleft+':'
	else
		Temp=Temp+Hourleft+':'
	
	if(Minuteleft<10)
		Temp=Temp+'0'+Minuteleft+':'
	else
		Temp=Temp+Minuteleft+':'

	if(Secondleft<10)
		Temp=Temp+'0'+Secondleft
	else
		Temp=Temp+Secondleft		
}

document.form_timer.left.value=Temp;  
timerID = setTimeout("showtime()",1000);  
timerRunning = true;  
}  
var timerID = null;  
var timerRunning = false;  
function stopclock () {  
if(timerRunning)  
clearTimeout(timerID);  
timerRunning = false;  
}  
function startclock () {  
stopclock();  
showtime();  
}  
</script>
<!-- 显示倒计时 end-->

<?php
$result=mysql_query("SELECT * FROM pingche_user, pingche_seat WHERE pingche_user.userid=pingche_seat.userid and date(pingche_seat.seatdate)=curdate()", $con);

$index = 1;
while($row = mysql_fetch_array($result))
{
	 echo "　　".$row['username']."的车子提供：".$row['seatnum']."个位子";

   $seatid=$row['seatid'];
   $resultbook=mysql_query("SELECT * FROM pingche_user, pingche_seat,pingche_book WHERE pingche_book.seatid='$seatid' and pingche_book.seatid=pingche_seat.seatid and pingche_book.userid=pingche_user.userid and date(pingche_seat.seatdate)=curdate()", $con);
   $num_rowsbook = mysql_num_rows($resultbook);
   echo ", 已有".$num_rowsbook."人预定:";
	 while($rowbook = mysql_fetch_array($resultbook))
	 {
	 	 echo $rowbook['username']."/";
	 }

   if($row['seatnum']==0)
   		echo "[<font color=red>已经取消</font>]";	 
	 else if($num_rowsbook ==$row['seatnum'])
	 		echo "[<font color=green>已经满员</font>]";
	 else if($num_rowsbook >$row['seatnum'])
	 		echo "[<font color=red>已经超员，需要协调</font>]";	 
	 else
	    echo "[<a href=book_save.php?seatid=".$row['seatid'].">预定</a>]";
	 
	 echo "出发时间:".$row['seatgotime'];
	 echo "<br><br>";
   $index = $index+1;
}
?>

</body>
</html>
<?php include 'conn_db_close.php'; ?>