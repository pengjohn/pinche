<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="GENERATOR" content="Microsoft FrontPage 3.0">
<title>软二拼车系统</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<br>车主管理<br><br><br>
<form method="POST" action="seat_save.php">
<input type="hidden" name=action value="new">
	<table border="0" cellspacing="1" width=800>
		<tr>
			<td align="right" height="30">我今天可以提供:</td>
			<td height="30">
				<select name="seatnum" size="1">
						<option value=0> = 0 = </option>
						<option value=1> = 1 = </option>
						<option value=2> = 2 = </option>
						<option value=3> = 3 = </option>
						<option value=4> = 4 = </option>
				</select> 个座位
			</td>
		</tr>
		<tr>
			<td align="right" height="30" width=100>出发时间</td>
			<td height="30"><input type="text" name="seatgotime" size="32"></td>
		</tr>
		<tr>
			<td align="right" height="30"></td>
			<td height="30">
		  	<input type="submit" value=" 添 加 " name="cmdok"style="background-color: rgb(0,0,0); color: rgb(255,255,255); border: 1px dotted rgb(255,255,255)">&nbsp;
			</td>
		</tr>		
	</table>
</form>

</body>
</html>
