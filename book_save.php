<?php include 'conn.php'; ?>
<?php include 'conn_db_open.php'; ?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<Script Language ="JavaScript">
function book_please_login(){
alert("���ȵ�¼��");
self.location='index.php';
}

function book_success(){
alert("��ϲ��ƴ����ɣ�");
self.location='index.php';
}

function book_timeout(){
alert("�����ƴ��ʱ���ѹ���");
self.location='index.php';
}

function book_repeat(){
alert("������Ѿ�Ԥ����");
self.location='index.php';
}

function book_full(){
alert("λ���Ѿ�����");
self.location='index.php';
}

function book_is_owner(){
alert("����˾��...");
self.location='index.php';
}

</Script>
</Head>

<?php
if( is_timeout() )
{
		echo "<body onload=book_timeout()>";
		echo "</body>";
}
else
{	
		session_start();
		$userid = $_SESSION['pingche_userid'];
		$bookpassenger = $_SESSION['pingche_username'];
		$seatid = $_GET['seatid'];

    if($userid <=0)
    {
			echo "<body onload=book_please_login()>";
			echo "</body>";    	
    }
		//�ж��Ƿ��Ѿ�������
		$result=mysql_query("SELECT * FROM pingche_book WHERE pingche_book.userid='$userid' and date(pingche_book.booktime)=curdate()", $con);
		$num_rows = mysql_num_rows($result);

		//�ж��Ƿ���˾��
		$result_owner=mysql_query("SELECT * FROM pingche_seat WHERE pingche_seat.userid='$userid' and date(pingche_seat.seatdate)=curdate()", $con);
		$num_rows_owner = mysql_num_rows($result_owner);
		if($num_rows_owner>=1)
		{
			$row_owner = mysql_fetch_array($result_owner);
			if($row_owner['seatnum'] == 0)
				$num_rows_owner=0;
		}

		//��ȡλ������
		$result_seat=mysql_query("SELECT * FROM pingche_seat,pingche_user WHERE pingche_user.userid=pingche_seat.userid and pingche_seat.seatid='$seatid' and date(pingche_seat.seatdate)=curdate()", $con);
		echo "<br>sql: ".mysql_error();
		$row_seat = mysql_fetch_array($result_seat);
		$num_rows_seat = $row_seat['seatnum'];
		$bookdriver = $row_seat['username'];
		echo $num_rows_seat."<br>";

		//��ȡ�˳��ѱ�Ԥ��������
		$result_book=mysql_query("SELECT * FROM pingche_book WHERE pingche_book.seatid='$seatid' and date(pingche_book.booktime)=curdate()", $con);
		$num_rows_book = mysql_num_rows($result_book);
		echo $num_rows_book."<br>";

		if($num_rows_owner >=1)
		{
			echo "<body onload=book_is_owner()>";
			echo "</body>";
		}
		else if($num_rows >=1)
		{
			echo "<body onload=book_repeat()>";
			echo "</body>";
		}
		else if($num_rows_book>=$num_rows_seat)
		{
			echo "<body onload=book_full()>";
			echo "</body>";			
		}
		else
		{
			//���Ӷ�������
			$sql = "INSERT INTO pingche_book (bookid, seatid, userid, bookdriver, bookpassenger, booktime) VALUES (NULL, '$seatid', '$userid', '$bookdriver', '$bookpassenger', NOW())";
			mysql_query($sql, $con);
			//echo "<br>sql error: ".mysql_error();
			//echo "<br>New success!<br>";
			
			echo "<body onload=book_success()>";
			echo "</body>";
		}
}
?>
</Html>		


<?php include 'conn_db_close.php'; ?>

