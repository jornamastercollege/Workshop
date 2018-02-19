<?php
	$hostname = "imreboersma.nl";
	$database = "imrebzb198_Workshopinschrijving";
	$username = "imrebzb198_workshop";
	$password = "Webmaster2018";
	$port = "3306";
	date_default_timezone_set('Europe/Amsterdam');
	$PM = mysqli_connect($hostname, $username, $password, $database, $port);
?>