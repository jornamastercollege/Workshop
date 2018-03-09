<?php
	include '../Includes/db.php';
	session_start();
   $q = intval($_GET['q']);
   
   
   mysqli_select_db($PM, $database);
   $sql = "SELECT `workshop`.`Omschrijving` AS `omschrijving`, `workshop`.`ID` AS `ID`
   FROM `workshop`
   WHERE (`workshop`.`ID` = '$q')";

   $result = mysqli_query($PM, $sql);
   $row = mysqli_fetch_array($result);

   echo $row['omschrijving'];
   echo $q;
