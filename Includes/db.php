<?php
	$hostname = "localhost";
	$database = "groome1q_PM";
	$username = "groome1q_stg_grp";
	$password = "!polkadot1950";
	date_default_timezone_set('Europe/Amsterdam');
	$PM = mysqli_connect($hostname, $username, $password);
	if (!$PM) {
		trigger_error(mysqli_error($PM),E_USER_ERROR); 
	}
?>