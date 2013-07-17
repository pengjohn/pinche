<?php include 'conn_db_open.php'; ?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="GENERATOR" content="Microsoft FrontPage 3.0">
<title>软二拼车系统</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<?php
session_start();
$userid = $_SESSION['pingche_userid'];

echo "======================================本月统计======================================<br>\n";
echo "[我是乘客]<br>\n";
$result=mysql_query("SELECT * FROM pingche_book WHERE userid='$userid' and date_format(`booktime`, '%Y%m')=date_format(curdate(), '%Y%m') order by booktime", $con);
$num_rows = mysql_num_rows($result);

while($row = mysql_fetch_array($result))
{
	 echo "　　[".date('m-d', strtotime($row['booktime']) )."] 搭 ".$row['bookdriver']." 的车<br>\n";
}
echo "　　<font color=red>合计：".$num_rows."</font><br><br>";

echo "[我是司机]<br>\n";
$result=mysql_query("SELECT * FROM pingche_book, pingche_seat WHERE pingche_book.seatid=pingche_seat.seatid and pingche_seat.userid='$userid' and date_format(`booktime`, '%Y%m')=date_format(curdate(), '%Y%m') order by pingche_book.booktime", $con);
$num_rows = mysql_num_rows($result);

while($row = mysql_fetch_array($result))
{
	 echo "　　[".date('m-d', strtotime($row['booktime']) )."] ".$row['bookpassenger']." 搭车<br>\n";
}
echo "　　<font color=red>合计：".$num_rows."</font><br><br>";


echo "======================================上月统计======================================<br>\n";
echo "[我是乘客]<br>\n";
$result=mysql_query("SELECT * FROM pingche_book WHERE userid='$userid' and (period_diff(date_format(now(), '%Y%m') ,date_format(booktime, '%Y%m'))=1) order by booktime", $con);
$num_rows = mysql_num_rows($result);

while($row = mysql_fetch_array($result))
{
	 echo "　　[".date('m-d', strtotime($row['booktime']) )."] 搭 ".$row['bookdriver']." 的车<br>\n";
}
echo "　　<font color=red>合计：".$num_rows."</font><br><br>";

echo "--[我是司机]---------------------------<br>\n";
$result=mysql_query("SELECT * FROM pingche_book, pingche_seat WHERE pingche_book.seatid=pingche_seat.seatid and pingche_seat.userid='$userid' and (period_diff(date_format(now(), '%Y%m') ,date_format(booktime, '%Y%m'))=1) order by pingche_book.booktime", $con);
$num_rows = mysql_num_rows($result);

while($row = mysql_fetch_array($result))
{
	 echo "　　[".date('m-d', strtotime($row['booktime']) )."] ".$row['bookpassenger']." 搭车<br>\n";
}
echo "　　<font color=red>合计：".$num_rows."</font><br><br>";

echo "[<a href=index.php>返回</a>]<br>";
?>

</body>
</html>
<?php include 'conn_db_close.php'; ?>