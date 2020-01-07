<html>
<head>
	<title>php for dummy</title>
</head>
<body>
<?php

$conn = new mysqli("localhost","root","","database");
$uid = 0;
$delete = "truncate table friend";
$delete1 = "truncate table request";
$insert1 = "insert into request (aid,bid) values(1015,1010)";
$insert2 = "insert into request (aid,bid) values(1012,1010)";
$insert3 = "insert into request (aid,bid) values(1011,1010)";
$insert4 = "insert into request (aid,bid) values(1014,1010)";

mysqli_query($conn,$delete);
mysqli_query($conn,$delete1);
mysqli_query($conn,$insert1);
mysqli_query($conn,$insert2);
mysqli_query($conn,$insert3);
mysqli_query($conn,$insert4);


mysqli_close($conn);

?>
</body>
</html>