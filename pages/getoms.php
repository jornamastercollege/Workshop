<?php
include '../includes/db.php';
$q = intval($_GET['q']);

mysqli_select_db($PM, $database);
$sql="SELECT `workshop`.`Omschrijving` AS `omschrijving`, `workshop`.`ID`
FROM `workshop`
WHERE (`workshop`.`ID` = '$q')
";
$result = mysqli_query($PM,$sql);
$row = mysqli_fetch_array($result);
$workshop = $row['omschrijving'];

?>
<div class="jumbotron">
<p><b>Omschrijving:</b></p>
<p><?php echo $workshop; ?></p>	
</div>
