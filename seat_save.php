<?php include 'conn_db_open.php'; ?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<Script Language ="JavaScript">
function new_success(){
alert("添加成功！");
self.location='index.php';
}

function edit_success(){
alert("修改成功！");
self.location='index.php';
}

</Script>

</Head>

<?php
session_start();
$action = $_POST['action'];
$seatid = $_POST['seatid'];
$seatnum = $_POST['seatnum'];
$seatgotime = $_POST['seatgotime'];
$userid = $_SESSION['pingche_userid'];

$result=mysql_query("SELECT * FROM pingche_seat WHERE pingche_seat.userid='$userid' and date(pingche_seat.seatdate)=curdate()", $con);
$num_rows = mysql_num_rows($result);
if($num_rows >=1)
  $action = "edit";
else
	$action = "new";

if($action == "new")
{
    echo "<br>goto new";
    $sql = "INSERT INTO pingche_seat (seatid, userid, seatnum, seatgotime, seatdate) VALUES (NULL, '$userid', '$seatnum', '$seatgotime', NOW())";
    mysql_query($sql, $con);
    echo "<br>sql error: ".mysql_error();
    echo "<br>New success!<br>";

		echo "<body onload=new_success()>";
		echo "</body>";    
}
else if($action == "edit")
{
    echo "<br>goto edit";
    $sql = "UPDATE pingche_seat Set seatnum='$seatnum',seatgotime='$seatgotime' WHERE pingche_seat.userid='$userid' and date(pingche_seat.seatdate)=curdate()";
    mysql_query($sql, $con);
    //echo "<br>sql error: ".mysql_error();
    echo "<br>Edit success!<br>";

		echo "<body onload=edit_success()>";
		echo "</body>";    

}
?>
</Html>
<?php include 'conn_db_close.php'; ?>

