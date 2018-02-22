<?php
	$hostname = "localhost";
	$database = "imrebzb198_workshopinschrijving";
	$username = "root";
	$password = "";
	$port = "3306";
	date_default_timezone_set('Europe/Amsterdam');
	$PM = mysqli_connect($hostname, $username, $password, $database, $port);
?>