<?php

	include '../includes/db.php';
	
	session_start();
	$a = array();
	$a['date'] = date("d-m-Y");
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if ($_POST['toevoegen']) {
			
			$Map 		= $_POST['Map'];
			$Mapnaam 	= $_POST['Mapnaam'];
			$Offerte	= $_POST['Offerten'];
			$datum		= date("Y-m-d", strtotime($_POST['datum']));
			
			$Query = "	UPDATE PM_Mappen SET
						MAP_Naam='$Mapnaam', MAP_OFF_ID = '$Offerte', MAP_UitgifteOperation = '$datum'
						WHERE MAP_Nummer = '$Map'";
			mysqli_select_db($PM, $database_PM);
			$result = mysqli_query($PM, $Query);
		
			if ($result) {
				echo "
				<div class='alert alert-success alert-dismissible fade show' role='alert'>
				<a href='' class='close' data-dismiss='alert' aria-label='close'>X</a>De map is succesvol toegekend!
				</div>";
			}
		}
		if($_POST['EditMap']) {
			
			$MAPID 			= $_POST['EMAPID'];
			$MAPNummer 		= $_POST['EMAPNummer'];
			$Naam 			= $_POST['ENaam'];
			$Offerte 		= $_POST['EOfferte'];
			if(!empty($_POST['EUitgifte'])) {
				$Uitgifte 		= date("Y-m-d", strtotime($_POST['EUitgifte']));
			}
			else {
				$Uitgifte		= "0000-00-00";
			}
			if(!empty($_POST['EAfgehandeld'])) {
				$Afgehandeld 	= date("Y-m-d", strtotime($_POST['EAfgehandeld']));
			}
			else {
				$Afgehandeld	= "0000-00-00";
			}
			//MAX(MAPID) + 1;
			mysqli_select_db($PM, $database_PM);
			$max = "SELECT MAX(MAPID) + 1 AS Max FROM PM_Mappen";
			$resultmax = mysqli_query($PM, $max);
			if (!$resultmax) {
				printf("Error: %s\n", mysqli_error($PM));
				exit();
			}
			$row = mysqli_fetch_array($resultmax);
			$maxmapid = $row['Max'];
						
			$EditQuery = "	UPDATE PM_Mappen 
							SET MAPID = '$maxmapid',
							MAP_Nummer = '$MAPNummer',
							MAP_Naam = '$Naam',
							MAP_OFF_ID = '$Offerte',
							MAP_UitgifteOperation = '$Uitgifte',
							MAP_Afgehandeld = '$Afgehandeld'
							WHERE MAPID = '$MAPID'";
							
			mysqli_select_db($PM, $database_PM);
			$result = mysqli_query($PM, $EditQuery);
			if (!$result) {
				printf("Error: %s\n", mysqli_error($PM));
				exit();
			}
			if ($result) {
				echo "
				<div class='alert alert-success alert-dismissible fade show' role='alert'>
				<a href='' class='close' data-dismiss='alert' aria-label='close'>X</a>De map is succesvol aangepast!
				</div>";
			}
		}	
		if($_POST['DeleteMap']) {
			
			$mapid = $_POST['MAPID'];
			$waardesql = "SELECT MAP_Waarde FROM PM_Mappen WHERE MAPID = '$mapid'";
			mysqli_select_db($PM, $database_PM);
			$result = mysqli_query($PM, $waardesql);
			$row = mysqli_fetch_array($result);
			
			$MAPID 			= $_POST['DMAPID'];
			$MAPNummer 		= $_POST['DMAPNummer'];
			$Naam 			= $_POST['DNaam'];
			$Offerte 		= $_POST['DOfferte'];
			if(!empty($_POST['DUitgifte'])) {
				$Uitgifte 		= date("Y-m-d", strtotime($_POST['DUitgifte']));
			}
			else {
				$Uitgifte		= "NULL";
			}
			if(!empty($_POST['DAfgehandeld'])) {
				$Afgehandeld 	= date("Y-m-d", strtotime($_POST['DAfgehandeld']));
			}
			else {
				$Afgehandeld	= "NULL";
			}
			
			$NULLQuery = "	INSERT INTO PM_Mappen_OUD
							(MAPID, MAP_Nummer, MAP_Naam, MAP_OFF_ID, MAP_UitgifteOperation, MAP_Afgehandeld) VALUES 
							('$MAPID', '$MAPNummer', '$Naam', '$Offerte', '$Uitgifte', '$Afgehandeld')";
			mysqli_select_db($PM, $database_PM);
			$NULLresult = mysqli_query($PM, $NULLQuery);

			if ($NULLresult) {
							mysqli_select_db($PM, $database_PM);
			$max = "SELECT MAX(MAPID) + 1 AS Max FROM PM_Mappen";
			$resultmax = mysqli_query($PM, $max);
			if (!$resultmax) {
				printf("Error: %s\n", mysqli_error($PM));
				exit();
			}
			$row = mysqli_fetch_array($resultmax);
			$maxmapid = $row['Max'];
			
				$DeleteQuery = "UPDATE PM_Mappen 
								SET MAP_Naam = NULL, 
								MAPID = '$maxmapid',
								MAP_OFF_ID = NULL, 
								MAP_Waarde = NULL, 
								MAP_UitgifteOperation = NULL, 
								MAP_Afgehandeld = NULL 
								WHERE MAPID = '$MAPID'";
				mysqli_select_db($PM, $database_PM);
				$Deleteresult = mysqli_query($PM, $DeleteQuery);
				if($Deleteresult) {
					echo "
						<div class='alert alert-success alert-dismissible fade show' role='alert'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>X</a>De map is succesvol geleegd!
						</div>";
				}
				else {
				echo "FOUT IN DeleteQuery";
			}
			}
			else {
				echo "FOUT IN NULLQuery";
				echo mysqli_error($PM);
			}
		}
	}
	?>
<html id="html">
	<head>
		<title>Invoering uren</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<!-- Styles -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<!-- Favicon -->
		<link href="http://groomecs.com/2013/templates/beez_20/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
		<style>
		.table-hover tbody tr:hover {
			background-color: rgba(91, 144, 229, 0.3)!important;
		}
		.table-striped > tbody > tr:nth-child(even) > td, .table-striped > tbody > tr:nth-child(even) > th {
			background-color: rgba(196, 196, 196, 0.96);
		}
		.table-striped > tbody > tr:nth-child(odd) > td, .table-striped > tbody > tr:nth-child(odd) > th {
			background-color: rgba(196, 196, 196, 0.39);
		}
		tr td:nth-child(7) {
			background: rgba(196, 196, 196, 0.39) !important;
		}
		</style>
		<!-- Scripts -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.1.4/js.cookie.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
	</head>
	<body>
		<!-- Navbar -->
		<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand" href="#">
			<img src="../images/logo.png" width="150" height="36" class="d-inline-block align-top" alt="logo">
			</a>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="beheeruren.php">Uren invoering</a>
				</li>
				<?php 
					ob_start();
					if ($_SESSION['logged'] == true) {
                                $med = $_SESSION['login_user'];
$sql9 = "SELECT ID, Naam, Rol FROM PM_Medewerkers WHERE Gebruikersnaam = '$med'";
mysqli_select_db($PM, $database_PM);
$result9 = mysqli_query($PM, $sql9);
if (!$result9) {
                                die('SQL Error: ' . mysqli_error($PM));
                }
while ($row = mysqli_fetch_array($result9))
{
							$medid = mysqli_escape_string($PM, $_SESSION['ID']);
							if ($row['Rol'] == "Beheerder") {
								?>
							<li class="nav-item">
								<a class="nav-link" href="beheerder.php">Beheerpaneel</a>
							</li>
							<li class="nav-item active">
								<a class="nav-link" href="AddMap.php">Map overzicht </a>
							</li>	
							<li class="nav-item">
								<a class="nav-link" href="SelectMap.php">Map toekennen</a>
							</li>
									<li class="nav-item">
                        <a class="nav-link" href="OverzichtDag.php">Dag overzicht</a>
                    </li>						
						  </ul>
						  <span class="nav-link"><?php echo $row['Naam']; ?></span>
                        <a class="btn btn-primary" href="logout.php">
                          <span>logout</span>
                        </a>
						<?php
							} 
							else {
						?>
								</ul> <span class="nav-link"> <?php echo $row['Naam']; ?>
								</span>
								<a class="btn btn-primary" href="logout.php">
								<span>logout</span>
								</a>
								<?php
							}				
						}
					}
					if ($_SESSION['logged'] == false) {
						echo("
							<script>location.href='http://groomecs.nl/KDB/PM/uren/index.php';</script>");
					}
					?>
			</div>
		</nav>
		</br>
		<div width="100%">
			<table class="table table-bordered table-hover table-sm table-striped">
			
				<thead>
					<tr>
						<td colspan="6"></td>
						<td nowrap="nowrap"><button class="btn btn-primary btn-block" value="A" data-toggle="modal" data-target="#AddModal">Toevoegen</button></td>
					</tr>
					<tr>
						<th width="12">MapID</th>
						<th width="13">Nr.</th>
						<th>Map Naam</th>
						<th width="25" align="center">Offerte</th>
						<th width="90">Operations</th>
						<th width="90">Afgehandeld</th>
						<th nowrap="nowrap">Functie</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						mysqli_select_db($PM, $database_PM);
						$Mappenquery = mysqli_query($PM, "	SELECT * 
															FROM PM_Mappen 
															ORDER BY MAP_Nummer ASC"
												);
						if (!$Mappenquery) {
							die('SQL Error: ' . mysqli_error($PM));
						}
						while ($row = mysqli_fetch_array($Mappenquery))
						{
					?>	
					<tr class="item">
						<td class="MAPID" align="center"><?php echo $row['MAPID']; ?></td>
						<td class="MAP_Nummer" align="center"><?php echo $row['MAP_Nummer']; ?></td>
						<td class="MAP_Naam" align="left"><?php echo $row['MAP_Naam']?></td>
						<td class="MAP_OFF_ID" align="center">
							<?php 
								if(!empty($row['MAP_OFF_ID']))
								{
									echo $row['MAP_OFF_ID']; 
								}
							?>
						</td>
						<td class="MAP_UitgifteOperation" align="center">
							<?php  
										if($row['MAP_UitgifteOperation'] == "0000-00-00" || empty($row['MAP_UitgifteOperation']) || $row['MAP_UitgifteOperation'] == "0000-00-00 00:00:00")
										{
											echo"";
										}
									
									else{
										echo date('d-m-Y',strtotime($row['MAP_UitgifteOperation']));
									}
							?>
						</td>
						<td class="MAP_Afgehandeld" align="center">
							<?php  
										if($row['MAP_Afgehandeld'] == "0000-00-00" || empty($row['MAP_Afgehandeld']) || $row['MAP_Afgehandeld'] == "0000-00-00 00:00:00")
										{
											echo"";
										}
									
									else{
										echo date('d-m-Y',strtotime($row['MAP_Afgehandeld']));
									}
							?>
						</td>
						<td class="Functie" align="center">
			
							<button type="button" class="btn btn-outline-success btn-sm Edit" value="E" data-toggle="modal" data-target="#EditModal"/><span class="fa fa-pencil"></span></button>
							<button type="button" class="btn btn-outline-danger btn-sm Delete" value="X" data-toggle="modal" data-target="#DeleteModal" onclick=" var $row = $(this).closest('tr'); var $mapnr = $row.find('.MAP_Nummer').text(); showUser2($mapnr);" /><span class="fa fa-trash"></span></button>
							<button type="button" class="btn btn-outline-primary btn-sm History" value="H" data-toggle="modal" data-target="#HistoryModal" onclick=" var $row = $(this).closest('tr'); var $mapidoud = $row.find('.MAP_Nummer').text(); showUser($mapidoud);"/><span class="fa fa-clock-o"></span></button>
							</form>
						</td>
					</tr>
				<?php
					}
				?>
				</tbody>
			</table>
		</div>
		
		<!-- MODAL ADD -->
		<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Map toevoegen</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="" method="post" target="_self" id="AddMap">
				<div class="form-group" id="Load">
					<label for="Map">Map nr.:</label>
					<br />
					<select class='selectpicker form-control' name='Map' id="Map" style="display: block" required="">
						<option disabled selected>selecteer Mapnummer...</option>
					<?php
						$sql = "SELECT MAPID, MAP_Nummer, MAP_Naam
								FROM PM_Mappen
								WHERE NOT MAPID = '6'
								AND PM_Mappen.MAP_OFF_ID = '0'
								OR PM_Mappen.MAP_OFF_ID IS NULL
								ORDER BY MAP_Nummer";
						mysqli_select_db($PM, $database_PM);
						$result = mysqli_query($PM, $sql);
						while ($row = mysqli_fetch_array($result)) {
							echo "
							<option class='map' value='".$row['MAP_Nummer']."'>".$row['MAP_Nummer']."</option>";
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="Mapnaam">Mapnaam:</label>
					<input type="text" class="form-control" id="Mapnaam" aria-describedby="Mapnaam" placeholder="Vul de Mapnaam in" name="Mapnaam" required="">
				</div>
				<!-- Opdrachten -->
				<div id="Offertes">
					<div class='form-group' id='offertepositie'>
						<label for='Offerten'>Offerte:</label>
						<br />
						<select class='selectpicker form-control' name='Offerten' id='Offerten' required="">
						<option disabled selected>selecteer Offerte...</option>
						<?php 
							$sql = "SELECT DISTINCT OFFID, REGTitel, OFFDatum
									FROM OFFenREG
									WHERE REGTitel IS NOT NULL 
									AND NOT REGTitel = '' 
									AND OFFID IS NOT NULL
									AND NOT OFFID = ''
									GROUP BY OFFID 
									ORDER BY OFFID DESC";
							mysqli_select_db($PM, $database_PM);
							$result = mysqli_query($PM, $sql);
							printf($sql);
							if (!$result) {
								printf("Error: %s\n", mysqli_error($PM));
								exit();
							}
							while ($row = mysqli_fetch_array($result)) {
								
								$REGTitel = substr($row['REGTitel'], 0, 80);
								if (strlen($row['REGTitel']) >= 80) {
									$REGTitel .= '..';
								}
								
								echo "
								<option class='map' value='".$row['OFFID']."'>".$row['OFFID']." - ".$REGTitel."</option>";
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="datum">Uitgifte aan operations:</label>
					<input type="text" class="form-control datum" id="datum" aria-describedby="datum" name="datum" required="" value="<?php echo date("d-m-Y")?>">
				</div>
				
					</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
								<input type="submit" value="Toevoegen" name="toevoegen" id="toevoegen" class="btn btn-primary" />
							</div>
						</form>
				</div>
			</div>
		</div>
		
		<!-- MODAL EDIT -->
		<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Bewerk map</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="" target="_self" id="EDITMAP" method="POST">
							<div class="form-group">
								<label for="MAPID" style="display: none;">MAPID:</label>
								<input type="text" class="form-control" id="EMAPID" name="EMAPID" readonly required="" style="display: none;">
							</div>
							<div class="form-group">
								<label for="MAPNummer">MAP Nummer:</label>
								<input type="text" class="form-control" id="EMAPNummer" name="EMAPNummer" readonly required="">
							</div>
							<div class="form-group">
								<label for="Naam">Naam:</label>
								<input type="text" class="form-control" id="ENaam" name="ENaam" required="">
							</div>
							<div class="form-group">
								<label for="Offerte">Offerte:</label>
								<select class='selectpicker form-control' name='EOfferte' id='EOfferte' required="">
						<option disabled selected>selecteer Offerte...</option>
						<?php 
							$sql = "SELECT DISTINCT OFFID, REGTitel
									FROM OFFenREG
									WHERE REGTitel IS NOT NULL 
									AND NOT REGTitel = '' 
									AND OFFID IS NOT NULL
									AND NOT OFFID = ''
									GROUP BY OFFID 
									ORDER BY OFFID DESC";
							mysqli_select_db($PM, $database_PM);
							$result = mysqli_query($PM, $sql);
							printf($sql);
							if (!$result) {
								printf("Error: %s\n", mysqli_error($PM));
								exit();
							}
							while ($row = mysqli_fetch_array($result)) {
								
								$REGTitel = substr($row['REGTitel'], 0, 80);
								if (strlen($row['REGTitel']) >= 80) {
									$REGTitel .= '..';
								}
								
								echo "
								<option class='map' value='".$row['OFFID']."'>".$row['OFFID']." - ".$REGTitel."</option>";
							}
							?>
						</select>
							</div>
							<div class="form-group">
								<label for="Uitgifte">Uitgifte Operations:</label>
								<input type="text" class="form-control datum" id="EUitgifte" name="EUitgifte">
							</div>
							<div class="form-group">
								<label for="Afgehandeld">Afgehandeld:</label>
								<input type="text" class="form-control datum" id="EAfgehandeld" name="EAfgehandeld" value="<?php echo date("d-m-Y")?>">
							</div>
					</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
								<input type="submit" class="btn btn-primary" value="Map Opslaan" name="EditMap" id="EditMap"/>
							</div>
						</form>
				</div>
			</div>
		</div>
		
		<!-- MODAL DELETE -->
		<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Vrijgeven map</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample22" aria-expanded="false" aria-controls="collapseExample">
    <i class="fa fa-arrow-down" aria-hidden="true"></i>
 <i class="fa fa-arrow-up" aria-hidden="true"></i>
  </button>
						 <form action="" method="POST">
						
</p>
<div class="collapse" id="collapseExample22">
  <table class="table table-bordered table-sm" id="txtHint2" width="100%">

					</table>
     
</div>
						
					<div id="cookie"></div>		
							
   
	<label for="MAPID" style="display: none;">MAPID:</label>
      <input type="text" class="form-control" id="DMAPID" name="DMAPID" readonly required="" style="display: none;">
    
     <div class="form-group">
	<label for="DMAPNummer">Mapnummer:</label>
      <input type="text" class="form-control" id="DMAPNummer" name="DMAPNummer" readonly required="">
    </div>
  
								
								
								
								
				
							<div class="form-group">
								<label for="Naam">Naam:</label>
								<input type="text" class="form-control" id="DNaam" name="DNaam" readonly required="">
							</div>
							<div class="form-group">
								<label for="Offerte">Offerte:</label>
								<input type="text" class="form-control" id="DOfferte" name="DOfferte" readonly required="">
							</div>
							<div class="form-group">
								<label for="Uitgifte">Uitgifte Operations:</label>
								<input type="text" class="form-control" id="DUitgifte" readonly name="DUitgifte">
							</div>
							<div class="form-group">
								<label for="Afgehandeld">Afgehandeld:</label>
								<input type="text" class="form-control datum" id="DAfgehandeld" name="DAfgehandeld" value="">
							</div>
					</div>
					
					
				
				<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
								<input type="submit" class="btn btn-primary" value="Map vrijgeven" name="DeleteMap" id="DeleteMap"/>
							</div>
						</form>
				</div>
			</div>
			</div>
		<!-- History -->
		<div class="modal fade" id="HistoryModal" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Map historie</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-bordered table-sm table-striped" id="txtHint" width="100%">
						
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
				</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
$(document).ready(function () {

				var now = new Date();
				var year = now.getFullYear();
				var month = now.getMonth() + 1;
				var day = now.getDate();
				if (month.toString().length == 1) {
					var month = '0' + month;
				}
				if (day.toString().length == 1) {
					var day = '0' + day;
				}
				var dateTime = day + '-' + month + '-' + year;

				$(function () {
					$(".datum").datepicker({
						dateFormat: 'dd-mm-yy',

					});
				});

				$("#Map").on("click", function () {
					var $MAP = $("#Map").val();
					Cookies.set("MAP_Nummer", $MAP, {
						expires: 10
					});
				});
				var mapcookie = Cookies.get("MAP_Nummer")
					$("#Map").val(mapcookie);

				$(".Edit").click(function () {
					var $row = $(this).closest("tr");
					var $mapid = $row.find(".MAPID").text();
					var $nummer = $row.find(".MAP_Nummer").text();
					var $naam = $row.find(".MAP_Naam").text();
					var $mapoffid = $row.find(".MAP_OFF_ID").text();
					var $offid = $.trim($mapoffid);
					var $Operations = $row.find(".MAP_UitgifteOperation").text();
					var $uitgifte = $.trim($Operations);
					var $af = $row.find(".MAP_Afgehandeld").text();
					var $afgehandeld = $.trim($af);

					$('#EditModal').on('shown.bs.modal', function () {
						$("#EMAPID").val($mapid);
						$("#EMAPNummer").val($nummer);
						$("#ENaam").val($naam);
						$("#EOfferte").val($offid);
						$("#EUitgifte").val($uitgifte);
						$("#EAfgehandeld").val($afgehandeld);
					});
				});
				$(".Delete").click(function () {

					var $row = $(this).closest("tr");
					var $mapid = $row.find(".MAPID").text();
					var $nummer = $row.find(".MAP_Nummer").text();
					var $naam = $row.find(".MAP_Naam").text();
					var $mapoffid = $row.find(".MAP_OFF_ID").text();
					var $offid = $.trim($mapoffid);
					var $Operations = $row.find(".MAP_UitgifteOperation").text();
					var $uitgifte = $.trim($Operations);
					var $af = $row.find(".MAP_Afgehandeld").text();
					if ($af == "") {
						var $afgehandeld = dateTime;
					} else {
						var $afgehandeld = $.trim($af);
					}
					Cookies.set("MAPNummer", $nummer);

					$('#DeleteModal').on('shown.bs.modal', function () {
						$("#DMAPID").val($mapid);
						$("#DMAPNummer").val($nummer);
						$("#DNaam").val($naam);
						$("#DOfferte").val($offid);
						$("#DUitgifte").val($uitgifte);
						$("#DAfgehandeld").val($afgehandeld);
						$koekje = Cookies.get('optellen');
						$aantal = parseInt($koekje);
						if ($aantal > 0) {
							document.getElementById("DeleteMap").disabled = true;
						}
						else {
							document.getElementById("DeleteMap").disabled = false;
						}
					});
				});
				$('#DeleteModal').on('hidden.bs.modal', function () {
					Cookies.remove('optellen', { path: '' });
				});
				

				$(".History").click(function () {
					var $row = $(this).closest("tr");
					var $mapidoud = $row.find(".MAP_Nummer").text();

					Cookies.set("mapidoud", $mapidoud, {
						expires: 7
					});
					Cookies.set("exe", "true");

					setInterval(function () {
						Cookies.remove('exe');
					}, 9000);
					$("#txtHidden").text($mapidoud);

				});
			});

			function showUser(str) {
				if (str == "") {
					document.getElementById("txtHint").innerHTML = "";
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
							document.getElementById("txtHint").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET", "getmapid.php?q=" + str, true);
					xmlhttp.send();
				}
			}
			function showUser2(str) {
				if (str == "") {
					document.getElementById("txtHint2").innerHTML = "";
					return;
				} else {
					if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
					} else {
						// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange = function () {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("txtHint2").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET", "getmapnr.php?q=" + str, true);
					xmlhttp.send();
				}
			}
		</script>
		<?php include("version.html");?>
	</body>
</html>
