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
echo "[乘客统计]<br>\n";
$result=mysql_query("SELECT * FROM pingche_book WHERE date_format(`booktime`, '%Y%m')=date_format(curdate(), '%Y%m') order by bookpassenger", $con);
$num_rows = mysql_num_rows($result);

$totalpassenger = 0;
$total = 0;
$bookpassenger = "";
while($row = mysql_fetch_array($result))
{
	 if($bookpassenger == $row['bookpassenger'])
	 {
	 	 $total ++;
	 }
	 else
	 { 
	 	 if($total != 0)
	 	 {
	 	 		echo $bookpassenger.":".$total."<br>\n";
	 	 		$totalpassenger = $totalpassenger+$total;
	 	 }
	 	 $total = 1;
	 	 $bookpassenger = $row['bookpassenger'];
	 }
}
echo $bookpassenger.":".$total."<br>\n";
$totalpassenger = $totalpassenger+$total;
echo "<font color=red>统计:".$totalpassenger."</font><br>\n";

echo "<br>\n";
echo "<br>\n";
echo "[司机统计]<br>\n";
$result=mysql_query("SELECT * FROM pingche_book WHERE date_format(`booktime`, '%Y%m')=date_format(curdate(), '%Y%m') order by bookdriver", $con);
$num_rows = mysql_num_rows($result);

$totaldriver = 0;
$total = 0;
$bookdriver = "";
while($row = mysql_fetch_array($result))
{
	 if($bookdriver == $row['bookdriver'])
	 {
	 	 $total ++;
	 }
	 else
	 {
	 	 if($total != 0)
	 	 {
	 	 	  $totaldriver = $totaldriver + $total;
	 	 		echo $bookdriver.":".$total."<br>\n";
	 	 }
	 	 $total = 1;
	 	 $bookdriver = $row['bookdriver'];
	 }
}
echo $bookdriver.":".$total."<br>\n";
$totaldriver = $totaldriver + $total;
echo "<font color=red>统计:".$totaldriver."</font><br>\n";


echo "======================================上月统计======================================<br>\n";
echo "[乘客统计]<br>\n";
$result=mysql_query("SELECT * FROM pingche_book WHERE (period_diff(date_format(now(), '%Y%m') ,date_format(booktime, '%Y%m'))=1)  order by bookpassenger", $con);
$num_rows = mysql_num_rows($result);

$totalpassenger = 0;
$total = 0;
$bookpassenger = "";
while($row = mysql_fetch_array($result))
{
	 if($bookpassenger == $row['bookpassenger'])
	 {
	 	 $total ++;
	 }
	 else
	 { 
	 	 if($total != 0)
	 	 {
	 	 		echo $bookpassenger.":".$total."<br>\n";
	 	 		$totalpassenger = $totalpassenger+$total;
	 	 }
	 	 $total = 1;
	 	 $bookpassenger = $row['bookpassenger'];
	 }
}
echo $bookpassenger.":".$total."<br>\n";
$totalpassenger = $totalpassenger+$total;
echo "<font color=red>统计:".$totalpassenger."</font><br>\n";

echo "<br>\n";
echo "<br>\n";
echo "[司机统计]<br>\n";
$result=mysql_query("SELECT * FROM pingche_book WHERE (period_diff(date_format(now(), '%Y%m') ,date_format(booktime, '%Y%m'))=1) order by bookdriver", $con);
$num_rows = mysql_num_rows($result);

$totaldriver = 0;
$total = 0;
$bookdriver = "";
while($row = mysql_fetch_array($result))
{
	 if($bookdriver == $row['bookdriver'])
	 {
	 	 $total ++;
	 }
	 else
	 {
	 	 if($total != 0)
	 	 {
	 	 	  $totaldriver = $totaldriver + $total;
	 	 		echo $bookdriver.":".$total."<br>\n";
	 	 }
	 	 $total = 1;
	 	 $bookdriver = $row['bookdriver'];
	 }

}
echo $bookdriver.":".$total."<br>\n";
$totaldriver = $totaldriver + $total;
echo "<font color=red>统计:".$totaldriver."</font><br>\n";

echo "<br>\n";
echo "<br>\n";
echo "[<a href=index.php>返回</a>]<br>";
?>


</body>
</html>
<?php include 'conn_db_close.php'; ?>