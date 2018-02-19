<?php
	$hostname = "imreboersma.nl";
	$database = "imrebzb198_Workshopinschrijving";
	$username = "imrebzb198_workshop";
	$password = "Webmaster2018";
	//zo dit is wel veilig denkek
	date_default_timezone_set('Europe/Amsterdam');
	$PM = mysqli_connect($hostname, $username, $password);
?>