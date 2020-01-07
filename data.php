<?php
$conn = mysqli_connect("localhost","root","","database");

/* User Data who is still loged in */

if(isset($_SESSION['user']))
{
$user = $_SESSION['user'];
$pwd = $_SESSION['password'];

$script_get_data = "select * from user where username = '$user' and password = '$pwd'";
$run_query = mysqli_query($conn,$script_get_data);

$getdata = mysqli_fetch_assoc($run_query);

}

function getcmt($id)
{
	$conn = mysqli_connect("localhost","root","","database");
	$cmt_script = "select * from comment where bid = $id";
	$run = mysqli_query($conn,$cmt_script);
	return $run;
}


function insertdata($aid,$bid,$text)
{
	$conn = mysqli_connect("localhost","root","","database");
	$in_script = "insert into comment(aid,bid,text) values('$aid','$bid','$text')";
	mysqli_query($conn,$in_script);
	mysqli_close($conn);
}


?>