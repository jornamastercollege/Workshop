<?php
include '../includes/db.php';
$q = intval($_GET['q']);

mysqli_select_db($PM, $database_PM);
$sql="SELECT MAP_Afgehandeld, MAP_Naam, MAP_Nummer, MAP_OFF_ID, MAP_UitgifteOperation, MAP_Waarde FROM PM_Mappen_OUD WHERE MAP_Nummer = '".$q."' ORDER BY MAP_Afgehandeld DESC";
$result = mysqli_query($PM,$sql);
$sql_huidig="SELECT MAP_Afgehandeld, MAP_Naam, MAP_Nummer, MAP_OFF_ID, MAP_UitgifteOperation, MAP_Waarde FROM PM_Mappen WHERE MAP_Nummer = '".$q."'";
$result_huidig = mysqli_query($PM,$sql_huidig);
 ?>
<thead>
							<tr>
								<th>Nummer</th>
								<th>Naam</th>
								<th align='center'>Offerte</th>
								
								<th>Uitgifte</th>
								<th>Gereed</th>
							</tr>
						</thead>
<tbody>
<?
	while ($row_huidig = mysqli_fetch_array($result_huidig)) {
							?>
							<tr style="background-color: rgba(196, 196, 196, 0.96);">
								<td align="center">
									<?php 
											if (!empty($row_huidig['MAP_Nummer'])) 
											{
												echo $row_huidig['MAP_Nummer'];
											}
											
									?>
								</td>
								<td>
									<?php 
											if (!empty($row_huidig['MAP_Naam']))
											{
												echo $row_huidig['MAP_Naam'];
											}
											
									?>
								</td>
								<td align="center">
									<?php 
											if (!empty($row_huidig['MAP_OFF_ID']))
											{
												echo $row_huidig['MAP_OFF_ID'];
											}
											
									?>
								</td>
								
								<td align="right">
									<?php  
										if($row['MAP_UitgifteOperation'] == "0000-00-00" || empty($row['MAP_UitgifteOperation']))
										{
											echo"";
										}
									
									else{
										echo date('d-m-Y',strtotime($row['MAP_UitgifteOperation']));
									}
							?>
								</td>
								<td align="right">
									<?php  
										if($row['MAP_Afgehandeld'] == "0000-00-00" || empty($row['MAP_Afgehandeld']))
										{
											echo"";
										}
									
									else{
										echo date('d-m-Y',strtotime($row['MAP_Afgehandeld']));
									}
							?>
								</td>
							</tr>
						</tbody>
						<?
}
	while ($row = mysqli_fetch_array($result)) {
							?>
							<tr>
								<td align="center"><?php echo $row['MAP_Nummer']; ?></td>
								<td><?php echo $row['MAP_Naam']; ?></td>
								<td align="center"><?php echo $row['MAP_OFF_ID']; ?></td>
								
								<td align="right">
									<?php 
											if (empty($row['MAP_UitgifteOperation']) || $row['MAP_UitgifteOperation'] == '1970-01-01' || $row['MAP_UitgifteOperation'] == '0000-00-00')
									{ 
										echo "n.v.t";

									} 
									else{
										echo date('d-m-Y',strtotime($row['MAP_UitgifteOperation']));
									}
											
									?>
								</td>
								<td align="right">
									<?php 
											if (empty($row['MAP_Afgehandeld']) || $row['MAP_Afgehandeld'] == '1970-01-01' || $row['MAP_Afgehandeld'] == '0000-00-00')
									{ 
										echo "n.v.t";

									} 
									else{
										echo date('d-m-Y',strtotime($row['MAP_Afgehandeld']));
									}
											
									?>
								</td>
							</tr>
						</tbody>
						<?
}
mysqli_close($PM);
?>