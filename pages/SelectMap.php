<?php
	include '../includes/db.php';

	session_start();
	$a = array();
	$a['date'] = date("d-m-Y");

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if ($_POST['toevoegen']) {
			$werkzaamheid	= $_POST['Werkzaamheid'];
			$Afgerondedag 	= date("Y-m-d", strtotime($_POST['Date']));
			$daguren		= $_POST['Uren'];
			$mapnmr 		= $_POST['MapTicket2'];
			$afgerond 		= $_POST['Afgerond'];
			$medewerker 	= $_POST['Medewerkers'];
			$REG			= $_POST['Offerte'];
			$Ticket			= $_POST['Ticket'];
			
			mysqli_select_db($PM, $database_PM);
			
			
				$T_Query = "INSERT INTO PM_ToegekendeUren(TU_REG, TU_Medewerker, TU_Werkzaamheid, TU_Uren, TU_MAPID, TU_Afgesloten, TU_DueDate) VALUES('$REG','$medewerker','$werkzaamheid','$daguren','$mapnmr', '','$Afgerondedag')";
				if (mysqli_multi_query($PM,$T_Query))
				{
					
					do
					{
						if ($T_result = mysqli_store_result($PM)) {
							while ($row = mysqli_fetch_row($T_result))
							{
								printf("%s\n",$row[0]);
							}
						mysqli_free_result($T_result);
						}
					}
					
						while (mysqli_more_results($PM) && mysqli_next_result($PM));
	
				}			
				
			

			if ($T_result) {
				echo "
					<div class='alert alert-success alert-dismissible fade show' role='alert'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>×</a>De uren zijn succesvol toegevoegd!
					</div>";
			} 
		}

		if ($_POST['bijwerken']) {
			$hid			= intval($_POST['hid']);
			$werkzaamheid 	= strval($_POST['WerkzaamheidE']);
			$medewerker 	= intval($_POST['MedewerkersE']);
			$uren 			= floatval($_POST['UrenE']);
			$mapnr 			= intval($_POST['MapnummerE']);
			if(!empty($_POST['AfgeslotenE']))
			{
				$afgesloten 	= "1";
			}
			else {
				$afgesloten		= "0";
			}
			$date 			= date("Y-m-d", strtotime($_POST['DueDateE']));
			
			$T_Query = "UPDATE PM_ToegekendeUren 
			SET TU_Medewerker = '$medewerker',
			TU_Werkzaamheid = '$werkzaamheid',
			TU_Uren = '$uren',
			TU_Afgesloten = '$afgesloten',
			TU_DueDate = '$date' 
			WHERE PMTUID = '$hid'";
		
			
			mysqli_select_db($PM, $database_PM);
			$T_result = mysqli_query($PM, $T_Query);
		
			if (!$T_result) {
				printf("Error: ", mysqli_error($PM));
				exit();
			}

			if ($T_result) {
				echo "
					<div class='alert alert-success alert-dismissible fade show' role='alert'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>X</a>De wijziging is succesvol ingevoerd!
					</div>";
			} else {
				echo "Error updating record: ".$PM->error;
			}
		}
	}
	?>
<!DOCTYPE html>
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
		tr td:nth-child(11) {
			background: rgba(196, 196, 196, 0.39) !important;
		}
		.DatePickerShow {
			z-index: 9999999999999 !important;
		}
		</style>
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
                          
                        
                        <?php 

					if ($_SESSION['logged'] == true) {
		$med = $_SESSION['login_user'];
$sql9 = "SELECT ID, Naam, Rol FROM PM_Medewerkers WHERE Gebruikersnaam = '$med'";
mysqli_select_db($PM, $database_PM);
$result9 = mysqli_query($PM, $sql9);
if (!$result9) {
		die('SQL Error: ' . mysqli_error($PM));
	}
while ($row = mysqli_fetch_array($result9)) {
							$medid = mysqli_escape_string($PM, $_SESSION['ID']);
							if ($row['Rol'] == "Beheerder") {
								?>
								
								<li class="nav-item">
                            <a class="nav-link" href="beheeruren.php">Uren invoering</a>
                          </li>
						  
							<li class="nav-item">
								<a class="nav-link" href="beheerder.php">Beheerpaneel</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="AddMap.php">Map overzicht</a>
							</li>	
							<li class="nav-item active">
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
						
						?>
								<?php if ($row['Rol'] == "Planner") { ?>
								
							
								
							<li class="nav-item">
                            <a class="nav-link" href="planner.php">Uren invoering</a>
                          </li>
						  <li class="nav-item active">
								<a class="nav-link" href="SelectMap.php">Map toekennen</a>
							</li>
							<li class="nav-item">
                        <a class="nav-link" href="OverzichtDag.php">Dag overzicht</a>
                  	  </li>		
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
                  
                  <button type="button" class="btn btn-primary float-right" data-toggle="collapse" data-target="#Toevoegen"><i class="fa fa-arrow-down" aria-hidden="true"></i>
 <i class="fa fa-arrow-up" aria-hidden="true"></i>
</button>
                  <div class="container">
                  <!-- Modal load voor test button -->
                    <div id="Toevoegen" class="out collapse show">
            
                    <div class="row">
                      <div class="col-md-5">
                        <!-- Uren invoering -->
						<form action="" method="post" target="_self" id="form2">
                          <div class="form-group">
                            <label for="exampleText1">Map:</label>
                            <br />
                            <select class='selectpicker form-control' name='MapTicket2' id="MapTicket2" onchange="this.form.submit();" style="display: block" value="" required="">
                                <?php
									
										echo "
                              <optgroup label='Mappen'>";
										$med = mysqli_escape_string($PM, $_SESSION['login_user']);
										$medid = mysqli_escape_string($PM, $_SESSION['ID']);
										$map = $_COOKIE['MapTicket2'];
										$sql = "SELECT MAP_Nummer, MAP_Naam, MAPID
FROM PM_Mappen
WHERE (PM_Mappen.MAP_Naam IS NOT NULL
OR PM_Mappen.MAP_Naam = '0')
ORDER BY PM_Mappen.MAP_Nummer
LIMIT 1,100
";
										mysqli_select_db($PM, $database_PM);

										$result = mysqli_query($PM, $sql);
										while ($row = mysqli_fetch_array($result)) {
											echo "
                                <option class='map' value='".$row['MAPID']."'>".$row['MAP_Nummer']."- ".$row['MAP_Naam']."</option>";
										}
										echo "
                              </optgroup>";
									?>
                            </select>
                          </div>
						 
                         
                          <!-- Offerte -->
                    <div class="form-group">
                            <label for="exampleInputEmail1">Medewerker:</label>
                            <select class="selectpicker form-control" name="Medewerkers" id="Medewerkers" required="">
							<option class="form-group" selected disabled />
                            <?php
                            				$med = mysqli_escape_string($PM, $_SESSION['login_user']);
										$medid = mysqli_escape_string($PM, $_SESSION['ID']);
										$map = $_COOKIE['MapTicket2'];
										$sql = "SELECT Naam, ID
FROM PM_Medewerkers
";
										mysqli_select_db($PM, $database_PM);

										$result = mysqli_query($PM, $sql);
										while ($row = mysqli_fetch_array($result)) {
											echo "
                                <option class='map' value='".$row['ID']."'>".$row['Naam']."</option>";
										}
										?>
										</select>
										
                            
                            </div>
                           
                          
                          
                            <!-- Toevoegen -->
                             <div class="form-group">
                            	<label>Toekennen uren:</label>
                            	<input type="number" class="form-control" min="0" step="0.25" id="Uren" aria-describedby="Uren" name="Uren" required=""/>
                            </div>
                            </div>
                            <div class="col-md-6">
                             <div class='form-group'>
                              <label for='exampleText1'>Offerte:</label>
                              <br />
                                <select class='selectpicker form-control' name='Offerte' id='Offerte' required="">
                                  <?php 
										$itemcookie_value = isset($_POST['MapTicket2']) ? $_POST['MapTicket2'] : $_COOKIE["MapTicket2"];
										$uid = $_POST['MAPID'];
										$medid = mysqli_escape_string($PM, $_SESSION['ID']);
										
										$sql = "SELECT MAP_Nummer, MAP_Naam, OFFID, REGID,OFFREGID, REGTitel
FROM OFFenREG, PM_Mappen
WHERE  
PM_Mappen.MAP_OFF_ID = OFFenREG.OFFID 
AND PM_Mappen.MAPID = '$itemcookie_value'
ORDER BY OFFenREG.OFFID, OFFenREG.REGID";
										mysqli_select_db($PM, $database_PM);
											
										$result123456 = mysqli_query($PM, $sql);
										
										if (!$result123456) {
				printf("Error: ", mysqli_error($PM));
				exit();
			
}
			
										
										while ($row = mysqli_fetch_array($result123456)) {
											echo "	
									<option class='map' value='".$row['OFFREGID']."'>".$row['OFFID']." - ".$row['REGID']." - ".$row['REGTitel']."</option>";
										}
										echo $itemcookie_value;
										?>
                                </select>
                            </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Uit te voeren werk:</label>
                            <input type="text" class="form-control" id="Werk" aria-describedby="emailHelp" placeholder="Voer hier in wat de medewerker moet gaan doen" name="Werkzaamheid" required="">
                            </div>
                            
                           
                            
                           <div class="form-group">
                                <label for="Date">Due Date:</label>
                                <input type="text" class="form-control Date" id="Date" name="Date"/>
                                </div>
							 </div>	<div class="form-group">
                          <input type="submit" value="Toevoegen" name="toevoegen" id="toevoegen" class="btn btn-primary" />
                                </div>
                        </form>
                           
                            </div>
                            </div>
                    </div>
                  </br>
                            <!-- Table -->
                            <div width="100%">
                              <table class="table table-bordered table-hover table-sm table-striped" id="countit">
                                <thead>
                                  <tr class="header">
								  <th class="klant text-center"  align="center" style="display: none;">
								ID
							</th>
								  <th class="mapnummer text-center"  align="center">
								Nr.
							</th>
                                    
                                    
                                    <th class="Uren text-center"  align="center" width="120">
								Offerte
							</th>
                                    <th class="werkelijkestatus text-center">
								Opdrachtgever
							</th>
                                    <th class="berekendestatus text-center">
								Titel
							</th>
							<th class="text-center">
									Medewerker
									</th>
                                    <th class="text-center">
								Werk
							</th>
                                    <th class="Edit text-center"  align="center">
								Uren
							</th>
							<th class="Edit text-center"  align="center">
								Duedate
							</th>
							<th colspan="2" class="Edit text-center"  align="center">
								F
							</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "SELECT DISTINCT MAP_Nummer, PMTUID, OFFID, ID, REGID, BEDRNaam, REGTitel, Naam, TU_Werkzaamheid, TU_Uren, TU_DueDate, MAPID
                                FROM OFFenREG, PM_Mappen, PM_Medewerkers, PM_ToegekendeUren
                                WHERE PM_ToegekendeUren.TU_MAPID = PM_Mappen.MAPID
                                AND PM_ToegekendeUren.TU_Medewerker = PM_Medewerkers.ID
                                AND PM_ToegekendeUren.TU_REG = OFFenREG.OFFREGID
                                AND PM_ToegekendeUren.TU_Afgesloten = '0'
                                ORDER BY PM_Mappen.MAP_Nummer, OFFenREG.REGID";
                                
                                mysqli_select_db($PM, $database_PM);

										$result123 = mysqli_query($PM, $sql);
										if (!$result123) {
    printf("Error: %s\n", mysqli_error($PM));
    exit();
}
										while ($row = mysqli_fetch_array($result123)) {
											echo '
                                <tr>
								<td class="pmutid" style="display: none;">'.$row['PMTUID'].'</td>
                                <td class="MAPID" align="center" style="display: none;">'.$row['MAPID'].'</td>
                                <td class="MAPNMR" align="center">'.$row['MAP_Nummer'].'</td>
                                <td class="OFFERTE" align="center" width="120">';echo $row['OFFID']; echo ' - '.$row['REGID'].'</td>
                                <td class="Opdrachtgever">'.$row['BEDRNaam'].'</td>
                                <td class="Title">'.$row['REGTitel'].'</td>
                                <td class="Medewerker">'.$row['Naam'].'<a class="Medewerkerhidden" style="display: none;">'.$row['ID'].'</a></td>
                                <td class="Werken">'.$row['TU_Werkzaamheid'].'</td>
                                <td class="UrenRow" align="center">'.$row['TU_Uren'].'</td>
                                <td class="DueDate" align="center">';
								if($row['TU_DueDate'] == "0000-00-00" || empty($row['TU_DueDate']) || $row['TU_DueDate'] == "1970-01-01")
										{
											echo"";
										}
									
									else{
										echo date('d-m-Y',strtotime($row['TU_DueDate']));
									}
								echo'</td>
                                <td align="center"><button type="button" class="btn btn-outline-success btn-sm Edit" data-toggle="modal" data-target="#EditModal"/><span class="fa fa-pencil"></span></button></td>
                                </tr>';
										}
                                ?>
                                    </tbody>
                              </table>
                            </div>
                            
                          
            
                      </br>
                            </div>
                    </br>
                    
		<!-- Modal2 -->
		<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Toekenning uren edit</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="" method="POST"  target="_self" id="form3" novalidate>
						<div class="form-group ">
								<label class="control-label " for="hid" style="display: none;">PMTUID:</label>
								<div class="input-group">
								<input type="text" name="hid" id="hid"  value="" class="form-control" style="display: none;" readonly/>
								</div>
							</div>
						
							<div class="form-group ">
								<label class="control-label " for="KlantE">Medewerker:</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-user"></i>
									</div>
									<select class="selectpicker form-control" name="MedewerkersE" id="MedewerkersE" required="">
                            <?php
                            				$med = mysqli_escape_string($PM, $_SESSION['login_user']);
										$medid = mysqli_escape_string($PM, $_SESSION['ID']);
										$map = $_COOKIE['MapTicket2'];
										$sql = "SELECT Naam, ID FROM PM_Medewerkers
";
										mysqli_select_db($PM, $database_PM);

										$result = mysqli_query($PM, $sql);
										while ($row = mysqli_fetch_array($result)) {
											echo "
                                <option class='map' value='".$row['ID']."'>".$row['Naam']."</option>";
										}
										?>
										</select>
								</div>
							</div>
							<div class="form-group ">
								<label class="control-label " for="UrenE">Werkzaamheid:</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-folder"></i>
									</div>
								<input class="form-control" id="WerkzaamheidE" name="WerkzaamheidE" type="text" required="" />
								</div>
							</div>
							<div class="form-group ">
								<label class="control-label " for="UrenE">Uren:</label>
								<div class="input-group">
									<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>	
									</div>
									
									<input class="form-control" id="UrenE" name="UrenE" type="number" step="0.25" min="0" required="" />
								</div>
							</div>
							
								<div class="form-group ">
								<label class="control-label " for="MapnummerE" style="display: none;">Mapnummer:</label>
								<div class="input-group">
									<input class="form-control" id="MapnummerE" name="MapnummerE" type="text" required="" style="display: none;" readonly=""/>
								</div>
							</div>
								<div class="form-group ">
								<label class="control-label " for="MapnummerE">Afgesloten:</label>
								<div class="input-group">
									<div class="input-group-addon">
										<input class="form-control" id="AfgeslotenE" name="AfgeslotenE" type="checkbox" />
									</div>
									
								</div>
							</div>
								<div class="form-group ">
								<label class="control-label " for="MapnummerE">Due Date:</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									
									<input type="text" class="form-control Date" id="DueDateE" name="DueDateE" value="<?php echo $a['date'];?>" required/>
									
								</div>
							</div>
					</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
					<input type="submit" class="btn btn-primary" value="Bijwerken" name="bijwerken" id="bijwerken"/>
					</div>
					</form>
				</div>
			</div>
		</div>
		
                    <!-- Scripts -->
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.1.4/js.cookie.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.js"></script>
                    <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
					<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
                    <script type="text/javascript">
			$(document).ready(function () {

			$(".Date").datepicker({
				dateFormat: 'dd-mm-yy',
				beforeShow: function () {
					$("#ui-datepicker-div").addClass("DatePickerShow");
				}
			});

			setTimeout(function () {
				$("#OK").one("click");
			}, 10);

			$(".Delete").click(function (e) {
				var $row = $(this).closest("tr");
				var $mapnummer = $row.find(".Mapnummer").text();
				var $uren = $row.find(".Uren").text();
				var $klant = $row.find(".Klant").text();

				$('#myModal_D').on('shown.bs.modal', function (e) {
					$("#MapnummerT").val($mapnummer);
					$("#UrenT").val($uren);
					$("#KlantT").val($klant);
				});
			});

			$(".Edit").on("click", function () {
				var $row = $(this).closest("tr");
				var $pmtuid = $row.find(".pmutid").text();
				var $medewerker = $row.find(".Medewerkerhidden").text();
				var $Operations = $row.find(".Werken").text();
				var $urenEdit = $row.find(".UrenRow").text();
				var $nummer = $row.find(".MAPNMR").text();
				var $DueDate = $row.find(".DueDate").text();

				$('#EditModal').on('shown.bs.modal', function () {
					$("#hid").val($pmtuid);
					$("#MedewerkersE").val($medewerker);
					$("#WerkzaamheidE").val($Operations);
					$("#UrenE").val($urenEdit);
					$("#MapnummerE").val($nummer);
					$("#DueDateE").val($DueDate);
				});
			});

			function getDateTime() {
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
				var dateTime = year + '-' + month + '-' + day;
				return dateTime;
			}

			$("#MapTicket2").on("click", function () {
				var $MapTicket = $("#MapTicket2").val();
				console.log("Select MapTicket clicked and set to:" + $MapTicket);
				document.cookie = "MapTicket2=" + $MapTicket + "; expires=Thu, 18 Dec 2142 12:00:00 UTC";
				$MapTicket;
			});

			var MapTicketC = Cookies.get("MapTicket2");
			$("#MapTicket2").val(MapTicketC);
			});
			</script>
			<?php include("version.html");?>
                  </body>
                </html>