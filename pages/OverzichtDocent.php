<?php
include '../includes/db.php';
session_start();
$Username = "Gebruiker";

error_reporting(E_ERROR | E_PARSE);

?>
    <html>

    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ"
            crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
            crossorigin="anonymous"></script>
        <title>Inlog pagina</title>

        <head>
            <!-- Favicon -->
            <link href="../Workshop/img/Astrum_logo.jpg" rel="shortcut icon" type="image/vnd.microsoft.icon" style="background: #fff" />
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
                    <ul class="navbar-nav mr-auto"></ul>
                    <h4>Welkom <?php echo $_SESSION["login_naam"]; ?>&nbsp;</h4>
                    <button class="btn btn-secondary">Uitloggen</button>
                </div>
            </nav>
            <div class="container" style="background-color: white;">
                <div class="row">
                    <div class="col-md-3 align-self-end" align="right">
                    </br>
                        <input type="search" class="form-control">
                    </div>
                </div>
            </div>
        </body>
    </html>