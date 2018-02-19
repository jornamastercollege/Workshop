<?php
//include '../includes/db.php';
session_start();
?>
    <html>

    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ"
            crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
            crossorigin="anonymous"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
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
                    <form class="form-inline" method="post">
                        <label class="sr-only" for="inlineFormInput">E-mail</label>
                        <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" placeholder="E-mail" name="emaillog">

                        <label class="sr-only" for="inlineFormInputGroup">Wachtwoord</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <input type="password" class="form-control" id="inlineFormInputGroup" placeholder="Wachtwoord" name="passwordlog">
                        </div>

                        <span class="nav-link"> </span>

                        <input type="submit" name="log" class="btn btn-outline-secondary my-2 my-sm-0" value="Aanmelden" style="color: white;" />

                    </form>
                </div>
            </nav>
        </body>

    </html>