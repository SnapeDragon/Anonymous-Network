<html>
<head>
	<title>sign up</title>
</head>
<body>

<table>
	<form action="up.php" method="post">
		<tr>
			<td>
				<label>Name</label>
			</td>
			<td> <input type="text" name="name" placeholder="Jon"> </td>
		</tr>
		<tr>
			<td>
				<label>Surame</label>
			</td>
			<td> <input type="text" name="sname" placeholder="Snow"> </td>
		</tr>
		<tr>
			<td>
				<label>Userame</label>
			</td>
			<td> <input type="text" name="username" placeholder="jonsnow"> </td>
			<?php
			$conn = new mysqli("localhost","root","","database");
			$script = "select * from user where username = '$_POST['username']'";
			if(mysqli_query($conn,$script))
				echo "Change username";
			?>
		</tr>
		<tr>
			<td>
				<label>Password</label>
			</td>
			<td><input type="password" name="password" placeholder="Winter is coming"></td>
		</tr>
		<tr>
			
			<td colspan="2"  style="text-align: center"> <input type="submit" name="submit" value="Submit"> </td>
		</tr>

	</form>

</table>
</body>
</html>