<?php
    include '../includes/db.php';
    session_start();
    $Username = "Gebruiker";
    error_reporting(E_ERROR | E_PARSE);
    if ($_SESSION['logged'] == false) {
        echo("<script>location.href='../index.php';</script>");
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $wsInput = $_POST["workshopselect"];
        $rInput = $_POST["rondeselect"];
        $studentID = $_SESSION["ID"];

        $SQL = "SELECT * FROM workshopronde WHERE rondeID = $rInput AND workshopID = $wsInput";
        $result = mysqli_query($PM, $SQL);
        $row = mysqli_fetch_assoc($result);    
        $wrID = $row['ID'];
    
        $SQL2 = "INSERT INTO `studentinschrijving`(`StudentID`, `WorkShopRondeID`) VALUES ($studentID, $wrID)";
        mysqli_query($PM, $SQL2);
    }

?>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        
        <link href="style.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.js"></script>
            <script src="../includes/jquery.js" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <title>HealthEvent - <?php echo $_SESSION['login_naam']; ?></title>
        <link href="././img/Astrum_logo.png" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    </head>
    <body style="background-color: #333e42">

            <!-- NAVBAR -->
            <nav class="navbar navbar-light navbar-toggleable-md" style="background-color: #1ca382">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" />
                </button>
                <a class="navbar-brand">
                    <img src="../img/Astrum.png" width="150" height="36" class="d-inline-block align-top" alt="Logo">
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Leerling overzicht <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                        <p>
                            Welkom <?php echo $_SESSION["login_naam"]; ?>&nbsp;
                            <button class="btn btn-secondary" onclick="window.location.href='../Includes/logout.php';" >Loguit</button>
                        </p>
                </div>
            </nav>
            <!-- ./NAVBAR -->

            <!-- CONTAINER -->
            <div class="container" style="background-color: #fff">
                <br><br><br>

                <h3 style="text-align: center;"> Overzicht voor leerlingen </h3>
                <i>
                    <h5 style="text-align: center;"> Welkom <?php echo $_SESSION["login_naam"] ?>!</h5>
                </i>
                <br>

                <form class="form-horizontal" action="" method="POST" required>

                    <div class="form-group col-sm-12">
                        <label class="control-label col-sm-2">Activiteiten:</label>
                        <select name="workshopselect" id="workshopselect" class="form-control" required="required">
                            <option value="0" disabled selected>kies een workshop</option>
                            <?php
                                $SQL = "SELECT ID, Naam, Omschrijving FROM workshop";
                                mysqli_select_db($PM, $database);
                                $result = mysqli_query($PM, $SQL);
                                while($row = mysqli_fetch_array($result)) {
                                    echo "<option value='".$row['ID']."'>".$row['Naam']."</option>";   
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-sm-12">
                        <label class="control-label col-sm-2">Ronde:</label>
                        <select name="rondeselect" id="rondeselect" class="form-control" required="required">
                            <option value="0" disabled selected>Kies een ronde</option>
                            <?php
                                $SQL = "SELECT Nummer, ID FROM ronde";
                                mysqli_select_db($PM, $database);
                                $result = mysqli_query($PM, $SQL);
                                while($row = mysqli_fetch_array($result)) {
                                    echo "<option value='".$row['ID']."'>".$row['Nummer']."</option>";   
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-default" name="submit" />
                    </div>
                </form>
                <br/>
            </div>
            <!-- ./CONTAINER -->
            <?php
    $studentID = $_SESSION["ID"];
    $inschrijving_sql = "SELECT StudentID FROM studentinschrijving WHERE StudentID = $studentID";
    $inschrijving_result = mysqli_query($PM, $inschrijving_sql);
    $inschrijving_count = mysqli_num_rows($inschrijving_result);

    if ($inschrijving_count == 2) {
        //Script voor uitschakelen van invoervelden
        ?>
        <script>
            rondeselect.disabled = true;
            workshopselect.diabled = true;
        </script>
        <?php 
    }
    elseif ($inschrijving_count < 2) {
        //script voor te weinig inschrijvingen
        ?>
        <script>
            rondeselect.disabled = false;
            workshopselect.diabled = false;
        </script>
        <?php
    }
    elseif ($inschrijving_count > 2) {
        ?>
        <script>
            rondeselect.disabled = false;
            workshopselect.diabled = false;
        </script>
        <?php
    }
?>
    </body>
</html>