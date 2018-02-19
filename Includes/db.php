<?php
	$hostname = "imreboersma.nl";
	$database = "imrebzb198_Workshopinschrijving";
	$username = "imrebzb198_workshop";
	$password = "Webmaster2018";
<<<<<<< HEAD
	$port = "3306";
=======
	//zo dit is wel veilig denkek
>>>>>>> e4cc0596dfa1fb8780abc1aedd98495a244cbd10
	date_default_timezone_set('Europe/Amsterdam');
	$PM = mysqli_connect($hostname, $username, $password, $database, $port);
?>