<?php
 include '../includes/db.php';
 session_start();
 $studentID = $_SESSION["ID"];
 error_reporting(E_ERROR | E_PARSE);
 if ($_SESSION['logged'] == false) {
     echo("<script>location.href='../index.php';</script>");
 }
 if($_SERVER["REQUEST_METHOD"] == "POST") {

    $wsInput = $_POST["workshopselect"];
    $wsInput2 = $_POST["workshopselect2"];
    $studentID = $_SESSION['ID'];

    $insertInschrijving = "INSERT INTO `studentinschrijving` (`StudentID`, `WorkShopRondeID`) VALUES ($studentID, $wsInput)";
    $insertInschrijving2 = "INSERT INTO `studentinschrijving` (`StudentID`, `WorkShopRondeID`) VALUES ($studentID, $wsInput2)";

    mysqli_select_db($PM, $database);

    $inschrijvingResult = mysqli_query($PM, $insertInschrijving);
    $inschrijvingResult2 = mysqli_query($PM, $insertInschrijving2);

    if (!$inschrijvingResult || !$inschrijvingResult2) {
        echo mysqli_error($PM);
    } else {
        header("Location: OverzichtLeerling.php");
    }
}
?>