<?php
 include '../includes/db.php';
 session_start();
 $studentID = $_SESSION["ID"];
 error_reporting(E_ERROR | E_PARSE);
 if ($_SESSION['logged'] == false) {
     echo("<script>location.href='../index.php';</script>");
 }

   #Andres: ik ga een overzicht maken van de workshops waar lerling ingeschreven staat

    $wsInput = $_POST["workshopselect"];
    $rInput = $_POST["rondeselect"];
    $studentID = $_SESSION["ID"];

    echo $SQL = "SELECT * FROM workshopronde WHERE rondeID = $rInput AND workshopID = $wsInput";
    $result = mysqli_query($PM, $SQL);
    $row = mysqli_fetch_assoc($result);    
    $wrID = $row['ID'];

    echo $SQL2 = "INSERT INTO `studentinschrijving`(`StudentID`, `WorkShopRondeID`) VALUES ($studentID, $wrID)";
    mysqli_query($PM, $SQL2);

    $SQL3 = "SELECT ID, Naam, Omschrijving, MaxDeelnemers, CurrentDeeln FROM workshop WHERE ID = $wrID";
    mysqli_select_db($PM, $database);
    $result3 = mysqli_query($PM, $SQL3);
    $row3 = mysqli_fetch_array($result3);
    $currentaantal = $row3['CurrentDeeln'] + 1;
    echo $SQL4 = "UPDATE workshop SET CurrentDeeln = '$currentaantal' WHERE ID = '$wsInput'";
    $result4 = mysqli_query($PM, $SQL4);
header("Location: OverzichtLeerling.php");
?>