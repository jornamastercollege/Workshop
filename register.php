<?php
# Includes #
	session_start();
	include './includes/db.php';
//	display_errors("1");
error_reporting(E_ERROR | E_PARSE);
# Background #

	$bg = array('bg-1.jpg', 'bg-2.jpg', 'bg-3.jpg', 'bg-4.jpg');
	$i = rand(0, count($bg)-1);
	$selectedBg = "$bg[$i]";

# Register #
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$FirstName = mysqli_real_escape_string($PM, $_POST['Voornaam']);
		$LastName = mysqli_real_escape_string($PM, $_POST['Achternaam']);
		$userName = mysqli_real_escape_string($PM, $_POST['Leerlingnummer']);
		$userPass = mysqli_real_escape_string($PM, $_POST['wachtwoord']);
		$sql = "INSERT INTO student (StudentNr, Wachtwoord, Voornaam, Achternaam) VALUES ('$userName', '$userPass', '$FirstName', '$LastName')";
		mysqli_select_db($PM, $database);
		$result = mysqli_query($PM, $sql);
		if (!$result)
		{
			echo mysqli_error($PM);
		}

		$sql = "SELECT * FROM student WHERE StudentNr = '$userName' AND Wachtwoord = '$userPass'";
		mysqli_select_db($PM, $database);
		$result = mysqli_query($PM, $sql);

		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$id = $row['ID'];
		
			$_SESSION['Beheerder']  = $rol;
			$_SESSION['login_user'] = $userName;
			$_SESSION['login_naam'] = $FirstName;
			$_SESSION['logged'] = true;
			$_SESSION['ID'] = $id;

			header("location: pages/OverzichtLeerling.php");
		
	}
?>
<!DOCTYPE html>
<html lang="nl">
	<head>
		<title>Registratie</title>
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Styles -->
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

		<!-- Favicon -->
		<link href="./img/Astrum_logo.png" rel="shortcut icon" type="image/vnd.microsoft.icon" />
		<style type="text/css" media="screen">
			body {
				background: url(img/<?php echo $selectedBg; ?>) no-repeat;
				height: 100%;
				width: 100%;
				max-height: 100%;
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
				background-color: #333e42;
				position: fixed;
			}
		</style>
	</head>

	<body>
		<div class="bg">
<!-- Login -->
			<div class="jumbotron login" id="login" style="background-color: #1ca382;">
				<img src="img/Astrum.png" alt="Logo" width="225" height="54">
				<form method="POST" action="">
					<div class="form-group ">
						<label class="control-label " for="gebruikersnaam">
							Voornaam:
                        </label>
                        <div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-user">
								</i>
							</div>
							<input class="form-control" id="Voornaam" name="Voornaam" placeholder="Uw Voornaam..." type="text" required/>
						</div>
                    </div>
					<div class="form-group ">
						<label class="control-label " for="wachtwoord">
							Achternaam:
						</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-user">
								</i>
							</div>
							<input class="form-control" id="wachtwoord" name="Achternaam" placeholder="Uw Achternaam..." type="text" required/>
						</div>
					</div>
					<div class="form-group ">
						<label class="control-label " for="wachtwoord">
							Leerlingnummer:
						</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-user">
								</i>
							</div>
							<input class="form-control" id="wachtwoord" name="Leerlingnummer" placeholder="Uw Leerlingnummer..." type="number" required/>
						</div>
					</div>
					<div class="form-group ">
						<label class="control-label " for="wachtwoord">
							Wachtwoord:
						</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-asterisk">
								</i>
							</div>
							<input class="form-control" id="wachtwoord" name="wachtwoord" placeholder="Uw wachtwoord..." type="password" required/>
						</div>
					</div>
					<div class="form-group">
						<div>
							<div class="checkbox">
								<p><a href="index.php" style="color: #cfde00;"> Terug naar inlog pagina! </a> </p>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div>
							<button class="btn btn-primary" name="submit" type="submit" style="background-color: #333e42;">
							Registreer
							</button>
						</div>
					</div>
				</form>
			</div>
<!-- ./Login -->
		</div>

<!--Scripts -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
	</body>
</html>