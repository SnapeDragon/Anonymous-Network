<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
session_start();

if(isset($_SESSION['user']))
{
	session_destroy();
	//echo "<script>location.href='login.html'</script>";
	header('location:login.html');
}
else
{
	//echo "<script>location.href='login.html'</script>";	
	header('location:login.html');
}

 ?>
</body>
</html>
