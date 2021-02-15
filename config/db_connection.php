
<?php
	$dbname = "bdabashon_bdsoft";
	$hostname = "localhost";
	$username = "bdabashon_mamun";
	$password = "inventory";
	$con = mysqli_connect($hostname, $username, $password, $dbname );
	mysqli_set_charset($con, "utf8");
?>