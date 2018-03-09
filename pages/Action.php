<?php
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    #Andres: ik ga een overzicht maken van de workshops waar leerling ingeschreven staat

    $wsInput = $_POST["workshopselect"];
    $rInput = $_POST["rondeselect"];
    $studentID = $_SESSION["ID"];

    $SQL = "SELECT * FROM workshopronde WHERE rondeID = $rInput AND workshopID = $wsInput";
    $result = mysqli_query($PM, $SQL);
    $row = mysqli_fetch_assoc($result);    
    $wrID = $row['ID'];

    $SQL2 = "INSERT INTO `studentinschrijving`(`StudentID`, `WorkShopRondeID`) VALUES ($studentID, $wrID)";
    mysqli_query($PM, $SQL2);

    $SQL3 = "SELECT ID, Naam, Omschrijving, MaxDeelnemers, CurrentDeeln FROM workshop WHERE ID = '$wrID'";
    mysqli_select_db($PM, $database);
    $result3 = mysqli_query($PM, $SQL3);
    $row3 = mysqli_fetch_array($result3);
    $currentaantal = $row3['CurrentDeeln'] + 1;
    $SQL4 = "UPDATE workshop SET CurrentDeeln = '$currentaantal' WHERE ID = '$wsInput'";
    $result4 = mysqli_query($PM, $SQL4);

    if (!$result4)
    {
        echo "ERROR:". mysqli_error($PM);
    }
}
header("Location : OverzichtLeerling.php")
?>