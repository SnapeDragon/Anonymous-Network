<html>
<head>
	<?php
		ini_set('session.cache_limiter','public');
		session_cache_limiter(false);
		session_start();
$conn = new mysqli("localhost","root","","database");



if(isset($_POST['submit']))
{
	$user = $_POST['user'];
	$pwd = $_POST['password'];
}
else
{
	$user = $_SESSION['user'];
	$pwd = $_SESSION['password'];
}
$script = "select * from user where username = '$user' and password = '$pwd'";

$result = mysqli_query($conn,$script);
if(isset($_SESSION['user']))
{
	$data = mysqli_fetch_assoc($result);
	$_SESSION['uid'] = $data['uid'];
}

else
{
	if(mysqli_num_rows($result) == 0)
	{
		//echo "<script>window.alert(\"Wrong Password\")</script>";
		//header('Location: login.html');
		echo ("<script LANGUAGE='JavaScript'>
    		window.alert('There is something wrong please check username or password');
    		window.location.href='login.html';
    		</script>");
	}
	else
	{
		$_SESSION['user'] = $user;
		$_SESSION['password'] = $pwd;
		$data = mysqli_fetch_assoc($result);
		$_SESSION['uid'] = $data['uid'];
	}
}


?>
	<title><?php echo "{$data['name']} {$data['surname']}" ?></title>
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet"> <meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<meta name="description" content="Blueprint: A basic template for a responsive multi-level menu" />
	<meta name="keywords" content="blueprint, template, html, css, menu, responsive, mobile-friendly" />
	<meta name="author" content="Codrops" />
	
	<!-- food icons -->
	
	<!-- demo styles -->
	<link rel="stylesheet" type="text/css" href="css/demo.css" />
	<!-- menu styles -->
	<link rel="stylesheet" type="text/css" href="css/component.css" />
	<script src="js/modernizr-custom.js"></script>

	<link rel="stylesheet" type="text/css" href="css/layout.css">		
	
</head>
<body>

<header>
	<!-- UnderDevelopment --> 
<a href="session.php">	<section id="title"><span style="font-size: 45px;"><b><u>O</u></b></span>rbit</section> </a>
	<div class="welcome">
		<label id="wish"></label>

		<script>
			var list = ["Good Morning","Good Afternoon","Good Evening"];
			var d = new Date();
			var hr = d.getHours();
			var flag = 1;
			var greet = document.getElementById('wish');
			
			if(hr >= 16  || hr <= 4)
				greet.innerHTML = list[2];
			else if(hr>=5 && hr <12)
				greet.innerHTML = list[0];
			else if(hr>=12 && hr<=15)
				greet.innerHTML = list[1];	
			
		</script>


		<?php
			echo "<b><a href=\"profile.php?id={$data['uid']}&index=1\">{$data['name']} {$data['surname']}</a></b>";
			
		?>
		<br>
		 
	</div>
	
</header>
<div style="position: relative;text-align: left;bottom: 30px;left: 20px">
		<form action="session.php" method="get">
		<input type="text" class="text" name="search" placeholder="Search">
		<input type="submit" name="submit" value="Go" class="search">
		</form>
	</div>
	<a href="logout.php" class="logout"><button class="button">Log out</button></a>
<br>
<button class="action action--open" aria-label="Open Menu"><span class="icon icon--menu"></span></button>
		<nav id="ml-menu" class="menu">
			<button class="action action--close" aria-label="Close Menu"><span class="icon icon--cross"></span></button>
			<div class="menu__wrap">
				<ul data-menu="main" class="menu__level" tabindex="-1" role="menu" aria-label="All">
					
					<li class="menu__item" role="menuitem"><a class="menu__link" data-submenu="submenu-1" aria-owns="submenu-1" href="#">Friends</a></li>
					<li class="menu__item" role="menuitem"><a class="menu__link" data-submenu="submenu-2" aria-owns="submenu-2" href="#">Request</a></li>
					
				</ul>
				<!-- Submenu 1 -->
				<ul data-menu="submenu-1" id="submenu-1" class="menu__level" tabindex="-1" role="menu" aria-label="Vegetables">
				<?php 
					$script = "select * from friend where aid = {$data['uid']} or bid = {$data['uid']}";
					$result = mysqli_query($conn,$script);
					$counter = 0;
						while($run = mysqli_fetch_assoc($result))
						{
							
							$counter += 1;
							if($run['aid'] == $data['uid'])
								$seek = $run['bid'];
							else if($run['bid'] == $data['uid'])
								$seek = $run['aid'];
							$script = "select uid, name,surname from user where uid = $seek";
							$go = mysqli_query($conn,$script);
							$frnd = mysqli_fetch_assoc($go);
							echo "<li class=\"menu__item response\" role=\"menuitem\"><a href=\"#\"></a>";
							echo "&nbsp; <a href=\"profile.php?id={$frnd['uid']}&index=2\"> $counter.{$frnd['name']} {$frnd['surname']} </a> ";
							echo "<a class=\" menu__link\" href=\"answer.php?aid={$data['uid']}&bid={$frnd['uid']}&index=3\" style=\"margin-left:20px;font-size:15px;\"> UnFriend </a></li>";
		
							}
							if(mysqli_num_rows($result) == 0)
							{
								echo "<li class=\"menu__item\" role=\"menuitem\"><a class=\"menu__link\" href=\"#\"></a></li>";
								echo "<li class=\"menu__item\">&nbsp; &nbsp;0 Friend !!PleaseMake Friends</li>";
							}

						?>

				</ul>
				
				<!-- Submenu 2 -->
				<ul data-menu="submenu-2" id="submenu-2" class="menu__level" tabindex="-1" role="menu" aria-label="Fruits">
					<?php 

						$script  = "select * from user u,request r where r.bid = {$data['uid']} and r.aid = u.uid";
						$result = mysqli_query($conn,$script);
						while($run = mysqli_fetch_assoc($result))
						{
							
							echo"<li class=\"menu__item response\" role=\"menuitem\" style=\"color:white\"> &nbsp; &nbsp; {$run['name']} {$run['surname']}";
							echo "<a href=\"#\"></a>";
							echo "<a class=\"menu__link\" href=\"answer.php?aid={$run['aid']}&bid={$run['bid']}&index=1\">Accept</a>";
							echo "<a class=\"menu__link\" href=\"answer.php?aid={$run['aid']}&bid={$run['bid']}&index=0\">Reject</a></li>";
							
						}
						
						if(mysqli_num_rows($result) == 0)
							{
								echo "<li class=\"menu__item\" role=\"menuitem\"><a class=\"menu__link\" href=\"#\"></a></li>";
								echo "<li class=\"menu__item\" style=\"color:white\">&nbsp; &nbsp;Not any request in pending</li>";
							}

						?>

				</ul>
				
			</div>
		</nav>
	
	<!-- /view -->
	<script src="js/classie.js"></script>
	<script src="js/dummydata.js"></script>
	<script src="js/main.js"></script>
	<script>
	(function() {
		var menuEl = document.getElementById('ml-menu'),
			mlmenu = new MLMenu(menuEl, {
				// breadcrumbsCtrl : true, // show breadcrumbs
				// initialBreadcrumb : 'all', // initial breadcrumb text
				backCtrl : false, // show back button
				// itemsDelayInterval : 60, // delay between each menu item sliding animation
				onItemClick: loadDummyData // callback: item that doesn´t have a submenu gets clicked - onItemClick([event], [inner HTML of the clicked item])
			});

		// mobile menu toggle
		var openMenuCtrl = document.querySelector('.action--open'),
			closeMenuCtrl = document.querySelector('.action--close');

		openMenuCtrl.addEventListener('click', openMenu);
		closeMenuCtrl.addEventListener('click', closeMenu);

		function openMenu() {
			classie.add(menuEl, 'menu--open');
			closeMenuCtrl.focus();
		}

		function closeMenu() {
			classie.remove(menuEl, 'menu--open');
			openMenuCtrl.focus();
		}

		// simulate grid content loading
		var gridWrapper = document.querySelector('.content');

		function loadDummyData(ev, itemName) {
			ev.preventDefault();

			closeMenu();
			gridWrapper.innerHTML = '';
			classie.add(gridWrapper, 'content--loading');
			setTimeout(function() {
				classie.remove(gridWrapper, 'content--loading');
				gridWrapper.innerHTML = '<ul class="products">' + dummyData[itemName] + '<ul>';
			}, 700);
		}
	})();
	</script>

<!-- // Send Request || Search result -->
<center>
<div>
	<?php

	if(isset($_GET['submit']))
	{
	$name = $_GET['search'];
	if(strpos($name, " ") > 0)
		{	
			$name = explode(" ", $name);
			$script = "select name,surname,uid from user where name = '$name[0]' and surname = '$name[1]'";
			$result = mysqli_query($conn,$script);
			
		}
		else
		{
			$script = "select name,surname,uid from user where name = '$name'";
			$result = mysqli_query($conn,$script);
		}
		if(mysqli_num_rows($result) > 0)
		{
			echo "<div style=\"padding:10px;color:#454345;font-size:20px;width:400px;border:3px solid gray;border-radius:20px;margin-left:10px;color:black\">Search Result<br>".
			"<div style=\"font-family:calibri\"><ol style=\"padding:10px;margin-bottom:0px\"><table>";
		}
		while($run = mysqli_fetch_assoc($result))
			{
				$flag = 0;
				$idd = $run['uid'];
				if($idd == $data['uid'])
				{
					echo "It's You  {$data['name']} {$data['surname']}";
				}
				else
				{

				echo "<tr><td>{$run['name']} {$run['surname']} </td>";

				$vrify = "select * from request";
				$vrifyquery = mysqli_query($conn,$vrify);
				while($checkrequest = mysqli_fetch_assoc($vrifyquery))
				{
					$split = 0;
					if(($data['uid'] == $checkrequest['aid'] && $checkrequest['bid'] == $idd && $split = 1) || ($data['uid'] == $checkrequest['bid'] && $checkrequest['aid'] == $idd && $split = 2))
					{
							if($split == 1)
							{
							echo "<td><button style=\"width:150px;padding:10px 0px;border-radius:20px;margin-left:10px;border:none\"> Already Sent </button></td></tr>";
							}
							else if($split == 2)
							{
								echo "<td><button style=\"width:150px;padding:10px 0px;border-radius:20px;margin-left:10px;border:none\"> Already Recieved </button></td></tr>";	
							}
							$flag = 1;
					}
					

				}

				$vrify = "select * from friend";
				$vrifyquery = mysqli_query($conn,$vrify);

				while($checkrequest = mysqli_fetch_assoc($vrifyquery))
				{
					if(($data['uid'] == $checkrequest['aid'] && $checkrequest['bid'] == $idd) || ($data['uid'] == $checkrequest['bid'] && $checkrequest['aid'] == $idd))
					{
						echo "<td><button style=\"width:150px;padding:10px 0px;border-radius:20px;margin-left:10px;border:none\"> Already Friend </button></td></tr>";
						$flag = 1;
					}
				}

				if($flag != 1 && $_GET['search']!= "")
				{
				echo "<td><a href=\"answer.php?name={$run['name']}&surname={$run['surname']}&index=2\"> <button class=\"res\" style=\"width:100px\"> Send Request</button> </a></td></tr>";
				}
				
			}
		}

		if(mysqli_num_rows($result) > 0)
		{
			echo "</table></ol></div></div><br>";
		}
	}
	?>
</div>
</center>
<div>
	<?php
	mysqli_close($conn);
	?>
</div>
</body>
</html>