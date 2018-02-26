<?php
include '../includes/db.php';
session_start();
$Username = "Gebruiker";


if($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $wsInput= $_POST["workshopselect"];
    $studentID = $_SESSION["ID"];


    $SQL = "INSERT INTO studentinschrijving (StudentID, WorkShopRondeID) VALUES ("$studentID", "$wsInput") ";

    mysqli_query($PM, $SQL);
}

?>
    <html>

    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ"
            crossorigin="anonymous">
        <script src="../includes/jquery.js" />
        <link href="style.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
            crossorigin="anonymous"></script>
        <title>Inlog pagina</title>

        <head>
            <!-- Favicon -->
            <link href="../Workshop/img/Astrum_logo.jpg" rel="shortcut icon" type="image/vnd.microsoft.icon" />
        </head>

        <body style="background-color: #333e42">

            <!-- Navbar -->
            <nav class="navbar navbar-light navbar-toggleable-md" style="background-color: #1ca382">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" />
                </button>
                <a class="navbar-brand">
                    <img src="../img/Astrum.png" width="150" height="36" class="d-inline-block align-top" alt="aaaaaa">
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    </ul>

                </div>
            </nav>

            <div class="container" style="background-color: #fff">

                <br>
                <br>
                <br>

                <h3 style="text-align: center;"> Overzicht voor leerlingen </h3>
                <i>
                    <h5 style="text-align: center;"> Welkom.
                    </h5>
                </i>
                <br>

                <form class="form-horizontal" method="POST">
                    <div class="form-group col-sm-12">
                        <label class="control-label col-sm-2">Activiteiten:</label>
                        <select id="workshopselect" class="form-control">
                            <option value="0">kies een optie</option>

                            <?php
                            
                            $SQL = "SELECT ID, Naam, Omschrijving FROM workshop";
                            mysqli_select_db($PM, $database);
                            $result = mysqli_query($PM, $SQL);
                            while($row = mysqli_fetch_array($result)){
                             echo "<option value='".$row['ID']."'>".$row['Naam']."</option>";   
                            }
                             ?>

                        </select>

                    </div>
                    <div class="form-group col-sm-12">
                        <label class="control-label col-sm-2">Ronde:</label>
                        <select class="form-control">
                            <option value="0">Kies een optie</option>

                            <?php
                            
                            $SQL = "SELECT Nummer FROM ronde";
                            mysqli_select_db($PM, $database);
                            $result = mysqli_query($PM, $SQL);
                            while($row = mysqli_fetch_array($result)){
                             echo "<option value='".$row['ID']."'>".$row['Nummer']."</option>";   
                            }
                             ?>

                        </select>

                    </div>

                    <div class="form-group col-sm-offset-2 col-sm-10" action="">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>

                </form>

                <br>
                <style type="text/css">
                    .tg {
                        border-collapse: collapse;
                        border-spacing: 0;
                        border-color: #1a9979;
                    }

                    .tg td {
                        font-family: Arial, sans-serif;
                        font-size: 14px;
                        padding: 10px 5px;
                        border-style: solid;
                        border-width: 1px;
                        overflow: hidden;
                        word-break: normal;
                        border-color: #aabcfe;
                        color: #ffffff;
                        background-color: #1a9979;
                    }

                    .tg th {
                        font-family: Arial, sans-serif;
                        font-size: 14px;
                        font-weight: normal;
                        padding: 10px 5px;
                        border-style: solid;
                        border-width: 1px;
                        overflow: hidden;
                        word-break: normal;
                        border-color: #aabcfe;
                        color: #ffffff;
                        background-color: #1a9979;
                    }

                    .tg .tg-baqh {
                        text-align: center;
                        vertical-align: top;
                        background-color: #1ca382
                    }

                    .tg .tg-mb3i {
                        background-color: #1eae8a;
                        vertical-align: top
                    }

                    .tg .tg-lqy6 {
                        vertical-align: top
                    }

                    .tg .tg-6k2t {
                        background-color: #1eae8a;
                        vertical-align: top
                    }

                    .tg .tg-yw4l {
                        vertical-align: top
                    }
                </style>
                <table class="tg col-sm-12">
                    <tr>
                        <th class="tg-baqh" colspan="6">Results</th>
                    </tr>
                    <tr>
                        <td class="tg-6k2t">No</td>
                        <td class="tg-6k2t">Competition</td>
                        <td class="tg-6k2t">John</td>
                        <td class="tg-6k2t">Adam</td>
                        <td class="tg-6k2t">Robert</td>
                        <td class="tg-6k2t">Paul</td>
                    </tr>
                    <tr>
                        <td class="tg-yw4l">1</td>
                        <td class="tg-yw4l">Swimming</td>
                        <td class="tg-lqy6">1:30</td>
                        <td class="tg-lqy6">2:05</td>
                        <td class="tg-lqy6">1:15</td>
                        <td class="tg-lqy6">1:41</td>
                    </tr>
                    <tr>
                        <td class="tg-6k2t">2</td>
                        <td class="tg-6k2t">Running</td>
                        <td class="tg-mb3i">15:30</td>
                        <td class="tg-mb3i">14:10</td>
                        <td class="tg-mb3i">15:45</td>
                        <td class="tg-mb3i">16:00</td>
                    </tr>
                    <tr>
                        <td class="tg-yw4l">3</td>
                        <td class="tg-yw4l">Shooting</td>
                        <td class="tg-lqy6">70%</td>
                        <td class="tg-lqy6">55%</td>
                        <td class="tg-lqy6">90%</td>
                        <td class="tg-lqy6">88%</td>
                    </tr>
                </table>
                <br>
            </div>


        </body>

    </html>