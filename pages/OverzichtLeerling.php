<?php
    include '../includes/db.php';
    session_start();
    $Username = "Gebruiker";
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

    <html>

    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ"
            crossorigin="anonymous">
        <link href="style.css" />
        <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
            crossorigin="anonymous"></script>

        <script src="../Includes/jquery.js">
        </script>

        <title>HealthEvent -
            <?php echo $_SESSION['login_naam']; ?>
        </title>
        <link href="../img/Astrum_logo.png" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    </head>

    <body style="background-color: #333e42">

        <!-- NAVBAR -->
        <nav class="navbar navbar-light navbar-toggleable-md" style="background-color: #1ca382">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" />
            </button>
            <a class="navbar-brand">
                <img src="../img/Astrum.png" width="150" height="36" class="d-inline-block align-top" alt="Logo">
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Leerling overzicht
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                </ul>
                <p>
                    Welkom
                    <?php echo $_SESSION["login_naam"]; ?>&nbsp;
                    <button class="btn btn-secondary" onclick="window.location.href='../includes/logout.php';">Loguit</button>
                </p>
            </div>
        </nav>
        <!-- ./NAVBAR -->

        <!-- CONTAINER -->
        <div class="container" style="background-color: #fff">
            <br>
            <br>
            <br>

            <h3 style="text-align: center;"> Overzicht voor leerlingen </h3>

            <h5 style="text-align: center;"> Welkom
                <?php echo $_SESSION["login_naam"] ?>!</h5>
           
                <p style="color:red; text-align: center;">Na het inschrijven voor een workshop kan deze niet meer worden aangepast!!</p>
                <p style="color:red; text-align: center;">Je
                    <u>
                        <b>moet</b>
                    </u> je inschrijven voor 2 workshops!</p>

                <form class="form-horizontal" action="Action.php" method="POST" required>

                    <div class="form-group col-sm-12">

                        <label class="control-label col-sm-2">kies uw workshop tijdens ronde 1:</label>
                        <select name="workshopselect" id="workshopselect" class="form-control" required="required" onchange="getVal()">
                            <option value="0" disabled selected>Selecteer uw 1e workshop</option>

                            <?php

                                //
                                //hier beginnen de uitvoering van data naar dropdown 1:
                                //

                                $SQL = "SELECT `workshopronde`.`RondeID` AS Ronde, `workshopronde`.`ID` AS wsid, `workshop`.`Naam` AS `Workshop`, COUNT(`studentinschrijving`.`ID`) AS curent, `workshopronde`.`MaxDeelnemers` AS `Max`
                                FROM `workshopronde`
                                    LEFT JOIN `studentinschrijving` ON `studentinschrijving`.`WorkShopRondeID` = `workshopronde`.`ID`
                                    LEFT JOIN `workshop` ON `workshopronde`.`WorkShopID` = `workshop`.`ID`
                                    WHERE `workshopronde`.`RondeID` = 1
                                GROUP BY `workshopronde`.`ID`
                                ORDER BY `workshop`.`Naam`";

                                mysqli_select_db($PM, $database);
                                $result = mysqli_query($PM, $SQL); 

                                while($row = mysqli_fetch_array($result)) { //'for each' result
                                    
                                    $wsnaam = $row["Workshop"];
                                    $wsmax = $row["Max"];
                                    $regstudent = $row["curent"];
                                    $wsid = $row["wsid"];

                                    if($regstudent<=$wsmax){
                                        echo "<option value='$wsid'>$wsnaam - $regstudent / $wsmax </option>";
                                    }
                                    else
                                    {
                                        echo "<option disabled value=''>$wsnaam - $regstudent / $wsmax </option>";
                                    }

                                    
                                }
                                
                                //
                                //hier eindigen de uitvoering van data naar dropdown 1:
                                //

                                
                            ?>

                            </select>

                    </div>

                    <div class="workshopoms"></div>
                    <div class="form-group col-sm-12">

                        <br>
                        <label class="control-label col-sm-2">kies uw workshop tijdens ronde 2:</label>
                        <select name="workshopselect2" id="workshopselect2" class="form-control" required="required" onchange="getVal()">
                            <option value="0" disabled selected>Selecteer uw 2e workshop</option>

                            <?php

//
//hier beginnen de uitvoering van data naar dropdown 2:
//

$SQL = "SELECT `workshopronde`.`RondeID` AS Ronde, `workshopronde`.`ID` AS wsid, `workshop`.`Naam` AS `Workshop`, COUNT(`studentinschrijving`.`ID`) AS curent, `workshopronde`.`MaxDeelnemers` AS `Max`
FROM `workshopronde`
    LEFT JOIN `studentinschrijving` ON `studentinschrijving`.`WorkShopRondeID` = `workshopronde`.`ID`
    LEFT JOIN `workshop` ON `workshopronde`.`WorkShopID` = `workshop`.`ID`
    WHERE `workshopronde`.`RondeID` = 2
GROUP BY `workshopronde`.`ID`
ORDER BY `workshop`.`Naam`";

mysqli_select_db($PM, $database);
$result = mysqli_query($PM, $SQL); 

while($row = mysqli_fetch_array($result)) { //'for each' result
    
    $wsnaam = $row["Workshop"];
    $wsmax = $row["Max"];
    $regstudent = $row["curent"];
    $wsid = $row["wsid"];

    if($regstudent<=$wsmax){
        echo "<option value='$wsid'>$wsnaam - $regstudent / $wsmax </option>";
    }
    else
    {
        echo "<option disabled value=''>$wsnaam - $regstudent / $wsmax </option>";
    }

    
}

//
//hier eindigen de uitvoering van data naar dropdown 2:
//


?>
</select>
</div>

 <div class="form-group col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="submit" />
                </div>
                </form>

<br>

                                <table style="width:100%;" class="table">
                                    <label class="control-label col-sm-2">U staat ingeschreven:</label>
                                    <thead class=" thead-dark">
                                        <th>Workshop</th>
                                        <th>Ronde</th>
                                        <th>Ronde Tijd</th>

                               

                                    </thead>

                                    <tbody>

                                        <?php

                    $SQL3 = "SELECT `ronde`.`Nummer` AS `nummy`, `student`.`ID` AS `ID`, `workshop`.`Naam` AS `naam`, `ronde`.`Aanvangstijd` AS `aanvang`
                    FROM `workshop`
                        LEFT JOIN `workshopronde` ON `workshopronde`.`WorkShopID` = `workshop`.`ID`
                        LEFT JOIN `ronde` ON `workshopronde`.`RondeID` = `ronde`.`ID`
                        LEFT JOIN `studentinschrijving` ON `studentinschrijving`.`WorkShopRondeID` = `workshopronde`.`ID`
                        LEFT JOIN `student` ON `studentinschrijving`.`StudentID` = `student`.`ID`
                        WHERE `student`.`ID` = $studentID    
                ";            

                    $result = mysqli_query($PM, $SQL3) or die(mysqli_error());
                        while($row = mysqli_fetch_array($result)) {
                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['naam']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['nummy']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['aanvang']; ?>
                                                </td>
                                            </tr>
                                            <?php
}
?>
                                    </tbody>

                                </table>
                    </div>

                    <br>
                    <br>
                    <br>
                    <!-- ./CONTAINER -->
                    <?php

    $studentID = $_SESSION["ID"];
    $inschrijving_sql = "SELECT StudentID FROM studentinschrijving WHERE StudentID = $studentID";
    $inschrijving_result = mysqli_query($PM, $inschrijving_sql);
    $inschrijving_count = mysqli_num_rows($inschrijving_result);
    echo $inschrijving_count;

    if ($inschrijving_count >= 2) {
        //Script voor uitschakelen van invoervelden
        ?>
                        <script>
                            document.getElementById("workshopselect2").disabled = true;
                            document.getElementById("workshopselect").disabled = true;
                        </script>
                        <?php 
    }
    else {
      
        ?>
                        <script>
                           document.getElementById("workshopselect2").disabled = false;
                            document.getElementById("workshopselect").disabled = false;
                        </script>
                        <?php
    }
?>
                                </select>
        </div>
        </form>
        <br/>
        </div>

        <script type="text/javascript">
            function getVal() {
                var str = document.getElementById("workshopselect").value;
                showOms(str);
            }

            function showOms(str) {

                if (str == "") {
                    document.getElementById("workshopoms").innerHTML = "";
                    return;
                } else {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // Voor Laurens :3
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("workshopoms").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "getoms.php?q=" + str, true);
                    xmlhttp.send();
                }
            }
        </script>
        <br>
        <br>
    </body>

    </html>