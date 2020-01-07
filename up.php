<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		a
		{
			text-decoration: none;
			
			transition-duration: 0.5s;
		}
		a:hover
		{
			word-spacing: -5px;
		}
	</style>
</head>
<body>
<?php
$conn = new mysqli("localhost","root","","database");

$getid = "select max(uid) \"uid\" from user";
$result = mysqli_query($conn,$getid);
$data = mysqli_fetch_assoc($result);

$uid = $data['uid'];

$uid = $uid + 1	;
$user = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];
$sname = $_POST['sname'];

$check = "select username  from user where username = '$user'";

if(mysqli_num_rows(mysqli_query($conn,$check)) > 0)
	{
		echo "<h2 style=\"text-align:center;font-family:calibri\">Username have been taken".
	 	"<a href=\"signup.html\"> Go Back </a></h2>";
	}
else
{

$script = "insert into user (uid,name,surname,username,password) values($uid,'$name','$sname','$user','$password')";
if(mysqli_query($conn,$script))
	//echo "<h1 style=\"text-align:center;font-family:calibri\">Process Successfull</h1>";
	echo "<script LANGUAGE='JavaScript'>window.alert('Let's Login)".
	"window.location.href='login.html'</script>";
else
	echo "Sorry" . mysqli_error($conn);
}
mysqli_close($conn);
?>
</body>
</html>