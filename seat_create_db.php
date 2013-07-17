<?php include 'conn_db_open.php'; ?>
<?php
$wechatObj = new wechatCallbackapiTest();
$wechatObj->CreateDB();
//$wechatObj->InsertDB();

class wechatCallbackapiTest
{	
	public function CreateDB()
	{
		echo "CreateDB...<br>";
		$sql = "CREATE TABLE pingche_seat
		(
   			seatid int NOT NULL AUTO_INCREMENT, 
  			PRIMARY KEY(seatid),
        userid int,
        seatnum int,
        seatgotime varchar(64),
        seatdate datetime
		)";

		mysql_query($sql,$con);
		echo "sql error: ".mysql_error()."<br>";
		mysql_close($con);

    return $contentStr;		
	}

}

?>