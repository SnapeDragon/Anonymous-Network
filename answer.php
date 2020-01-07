
<?php
include 'data.php';
session_start();
$conn = new mysqli("localhost","root","","database");


if($_GET['index'] == 1)
{

	/* Accept Request */

	$aid = $_GET['aid'];
	$bid = $_GET['bid'];

	$insert = "insert into friend (aid,bid) values('$aid','$bid')";
	$delete = "delete from request where aid = '$aid'";

	mysqli_query($conn,$insert);
	mysqli_query($conn,$delete);
	header('Location: session.php');
}
else if($_GET['index'] == 0)
{

	/* Reject Request */

	$aid = $_GET['aid'];
	$bid = $_GET['bid'];

	$insert = "insert into friend (aid,bid) values('$aid','$bid')";
	$delete = "delete from request where aid = '$aid'";
	
	mysqli_query($conn,$delete);
	header('Location: session.php');
}
else if($_GET['index'] == 2)
{
	/* Send request */

	$user = $_SESSION['user'];
	$aid = mysqli_fetch_assoc(mysqli_query($conn,"select uid from user where username = '$user'"));
	$aid = $aid['uid'];

	$name = $_GET['name'];
	$surname = $_GET['surname'];

	$bid = mysqli_fetch_assoc(mysqli_query($conn,"select uid from user where name = '$name' and surname = '$surname'"));
	$bid = $bid['uid'];

	$script = "insert into request (aid,bid) values('$aid','$bid')";
	mysqli_query($conn,$script);
	header('Location: session.php');
}
else if($_GET['index'] == 3)
{
	/*Un-Friend */
	$aid = $_GET['aid'];
	$bid = $_GET['bid'];
	$script = "delete from friend where aid = $aid and bid = $bid or aid = $bid and bid = $aid";
	mysqli_query($conn,$script);
	header('Location: session.php');

}
else if($_GET['index'] == 5)
{
	$id = $_GET['id'];
	mysqli_query($conn,"delete from comment where id = $id");
	mysqli_query($conn,"delete from vote where cid = $id");
	header('Location: profile.php');
}

else if($_GET['index'] == 6)
{
	$id = $_GET['id'];
	$check = mysqli_query($conn,"select * from vote where cid = $id and uid = {$_SESSION['uid']}");
	if(mysqli_num_rows($check) == 0)
	{

		if($_GET['vote'] == 1)
		{
			mysqli_query($conn,"update comment set agree = agree + 1 where id = $id");
		}
		else if($_GET['vote'] == 0)
		{
			mysqli_query($conn,"update comment set disagree = disagree + 1 where id = $id");	
		}
		mysqli_query($conn,"insert into vote(uid,cid,vote) values({$_SESSION['uid']},$id,{$_GET['vote']})");
	}
	
	header('Location: profile.php');
}

?>