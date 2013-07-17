<?php include 'conn_db_open.php'; ?>

<?php
session_start();

$name = $_POST['name'];
$password = md5($_POST['password']);
		
echo "<br>name:".$name;
echo "<br>password:".$password;

$result=mysql_query("SELECT * FROM pingche_user WHERE username='$name'", $con);
//echo "<br>sql error: ".mysql_error()."<br>";
$num_rows = mysql_num_rows($result);
if($num_rows >=1)
{
  $row = mysql_fetch_array($result);
	if($row['userpassword'] == $password)
	{
	  $_SESSION['pingche_userid'] = $row['userid'];
		$_SESSION['pingche_username'] = $row['username'];
		setcookie("pingche_username", $_SESSION['pingche_username'], time()+60*60*24*365); 
		$_SESSION['pingche_userlevel'] = $row['userlevel'];
	  $_SESSION['pingche_usercount'] = $row['usercount'];
	
	  header("Location: index.php");
	}
	else
	{
		echo "password error!";		
	}

}
else
{
	echo "username invalid!";
}
?>

<?php include 'conn_db_close.php'; ?>

