<?php

include 'data.php';
session_start();
$conn = mysqli_connect("localhost","root","","database");
	if(isset($_GET['id']))
	{
		
		$id = $_GET['id'];
		$_SESSION['fid'] = $id;
		$ind = $_GET['index'];
		$_SESSION['index'] = $ind;

	}
	else
	{
		$id = $_SESSION['fid'];
		$ind = $_SESSION['index'];
	}

	$script = "select * from user where uid = $id";
	$query = mysqli_query($conn,$script);
	$vdata = mysqli_fetch_assoc($query);
?>

<html>
<head>
	<title><?php echo "{$vdata['name']} {$vdata['surname']}"; ?></title>
	<link rel="stylesheet" type="text/css" href="css/layout.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet"> 
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
	<br><br>
	<div style="margin-left: 10px;"><a href="session.php">Home</a></div><br>
	<div style="margin-left: 10px">	

	<form action="profile.php" method="post">
	<textarea name="comment"></textarea>
	<br>
	<!--<input style="width: 100px;" type="submit" name="post" value="POST">-->
	<button class="share" type="submit" name="post"><i class="material-icons">
arrow_upward
</i></button>
	</form>
	<br><br>
	<?php
		
		if(isset($_POST['post']))
		{
			$cmnt = $_POST['comment'];
			if($cmnt!="")
			{
					$aid = $_SESSION['uid'];
					$bid = $id;
					insertdata($aid,$bid,$cmnt);
					//mysqli_query($conn,"insert into comment (aid,bid,text) values($aid,$bid,'$cmnt')");
				}
			
		}
		
		$run = getcmt($id);
		if(mysqli_num_rows($run) > 0)
		{
			echo "<div class=\"comment\"><ul>";
		}
		while($cmt = mysqli_fetch_assoc($run))
		{
			echo "<li>";
			echo "<p>";
			echo "{$cmt['text']}";
			if($cmt['aid'] == $_SESSION['uid'])
			{
			echo"&nbsp; &nbsp;<a href=\"answer.php?index=5&id={$cmt['id']}\"><i class=\"material-icons\" style=\"font-size:25px;float:right;margin-right:20px;\">close</i></a>";
			}
			echo "</p></li><br>";
			echo "<p class=\"box\">";
			if($cmt['aid'] != $_SESSION['uid'] && $cmt['bid']!=$_SESSION['uid'])
			{
				echo "<a href=\"answer.php?index=6&vote=1&id={$cmt['id']}&uid={$_SESSION['uid']}\">";
			}
			echo "Agree";
			if($cmt['aid'] != $_SESSION['uid'] && $cmt['bid']!=$_SESSION['uid'])
			{
				echo "</a>";
			}

			/*if($cmt['agree'] != 0 && $cmt['disagree'] == 0)
			{
				$agree =  ($cmt['agree']*100)/($cmt['agree'] + $cmt['disagree']);
				echo "<span> $agree  % </span>";
			}*/
			//else
				echo "<span>{$cmt['agree']}</span>";
			if($cmt['aid'] != $_SESSION['uid'] && $cmt['bid']!=$_SESSION['uid'])
			{
				echo "<a href=\"answer.php?index=6&vote=0&id={$cmt['id']}&uid={$_SESSION['uid']}\">";
			}
			echo " Disagree";
			if($cmt['aid'] != $_SESSION['uid'] && $cmt['bid']!=$_SESSION['uid'])
			{
				echo "</a>";
			}
			//$disagree = ($cmt['disagree']*100)/($cmt['agree'] + $cmt['disagree']);
			//echo "<span> $disagree </span>";
			echo "<span> {$cmt['disagree']} </span> </p>";
		
		}
		if(mysqli_num_rows($run) > 0)
		{
			echo "</ul></div>";
		}

	?>
</div>
</body>
</html>