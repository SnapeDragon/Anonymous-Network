<html>
<head>
	<title>Welcome</title>
	<style>
		header
		{
			
			background: black;
			opacity: 0.7;
			font-family: Calibri;
			color: white
		}
		#title
		{
			padding: 20px;
			font-size: 35px;
			text-align: center;
		}
		body
		{
			margin:0;
		}
	</style>
</head>
<body>
<?php 

$conn = new mysqli("localhost","root","","database");
$user = $_POST['user'];
$pwd = $_POST['password'];
$script = "select * from user where username = '$user' and password = '$pwd'";

$result = mysqli_query($conn,$script);
if(mysqli_num_rows($result) == 0)
	{
		header('Location: login.html');
		echo "Sorry Login again";
	}
else
{
	//echo "<h1 style=\"text-align:center;font-family:calibri\">Welcome</h1>";
	$data = mysqli_fetch_assoc($result);
}
mysqli_close($conn);
?>

<header>
	<section id="title"><span style="font-size: 45px;"><b><u>O</u></b></span>rbit</section>
	<div style="position: relative;right:20px; text-align: right;bottom: 50px;">
		<?php
			echo "Welcome <b><i>{$data['name']} {$data['surname']}</i></b>";
		 ?>
	</div>
</header>
</body>
</html>