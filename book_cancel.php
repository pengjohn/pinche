<?php include 'conn.php'; ?>
<?php include 'conn_db_open.php'; ?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<Script Language ="JavaScript">
function cancel_success(){
alert("ȡ�������ɹ���");
self.location='index.php';
}

function cancel_fail(){
alert("ȡ������ʧ�ܣ�");
self.location='book_today_user.php';
}

function cancel_timeout(){
alert("����17:30����ȡ������");
self.location='book_today_user.php';
}
</Script>
</Head>
<?php
if( is_timeout() )
{
	echo "<body onload=cancel_timeout()>";
	echo "</body>";
}
else
{
	session_start();
	$userid = $_SESSION['pingche_userid'];
  
	//ɾ������
	$sql = "DELETE FROM pingche_book WHERE userid='$userid' and date(pingche_book.booktime)=curdate()";
	mysql_query($sql, $con);
	//echo "sql error: ".mysql_error()."<br>";
	echo "<br>delete success!<br>";
	
	echo "<body onload=cancel_success()>";
	echo "</body>";
}
?>

</Html>
<?php include 'conn_db_close.php'; ?>