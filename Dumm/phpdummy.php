<html>
<head>
	<title>php for dummy</title>
</head>
<body>
<?php

$conn = new mysqli("localhost","root","","database");
$uid = 1013;
$script = "delete from user where uid = $uid";
mysqli_query($conn,$script);


mysqli_close($conn);

?>
</body>
</html>