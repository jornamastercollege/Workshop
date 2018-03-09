<?php
include '../includes/db.php';
session_start();
$Username = "Gebruiker";
if ($_SESSION['logged'] == false) {
    echo("<script>location.href='../index.php';</script>");
}
?>
    <html>

    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ"
            crossorigin="anonymous">
            <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
            <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
            <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
            crossorigin="anonymous"></script>
        <title>HealthEvent - Docent</title>
            <!-- Favicon -->
            <link href="../img/Astrum_logo.png" rel="shortcut icon" type="image/vnd.microsoft.icon" />
            <script type="text/javascript">
            $(function(){
            $('.Download').click(function(){
            var url='data:application/vnd.ms-excel,' + encodeURIComponent($('#tabledownload').html()) 
            location.href=url
            return false
            })
            })
        </script>
        </head>

        <body style="background-color: #333e42">

        <script> 
        //Here comes some Jquery

          $(document).ready(function () {
              $('#example').dataTable({
                  "sDom": 'T<"clear">lfrtip',
                  "oTableTools": {
                      "sSwfPath": "/swf/copy_cvs_xls_pdf.swf"
                  }
              });
          });
        
        </script>

        <script>
        var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>




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
                            <a class="nav-link" href="#">Docent overzicht <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                        <p>
                            Welkom <?php echo $_SESSION["login_naam"]; ?>&nbsp;
                            <button class="btn btn-secondary" onclick="window.location.href='../Includes/logout.php';" >Loguit</button>
                        </p>
                </div>
            </nav>
            <!-- ./NAVBAR -->
            <div class="container" style="background-color: white;">
                <div class="row">
                    <div class="col-md-2 align-self-end" align="left">
                    <input type="button" onclick="tableToExcel('testTable', 'W3C Example Table')" value="Export to Excel">
                        
                    </div>
                </div>
                <div class="row">
                <div class="tabledownload">
                    <table id="testTable" class="table table-responsive col-md-12 table-striped">
                        <thead>
                            <th>Leerling</th>
                            <th>Workshop</th>
                            <th>Ronde</th>
                        </thead> 
                        <tbody>
                            <?php
                           
                                $sql = "SELECT ronde.Nummer AS Ronde, student.Voornaam AS Voornaam, student.Achternaam AS Achternaam, workshop.Naam AS Workshop, workshopronde.* 
                                FROM workshop 
                                LEFT JOIN workshopronde ON workshopronde.WorkShopID = workshop.ID 
                                LEFT JOIN ronde ON workshopronde.RondeID = ronde.ID 
                                LEFT JOIN studentinschrijving ON studentinschrijving.WorkShopRondeID = workshopronde.ID 
                                LEFT JOIN student ON studentinschrijving.StudentID = student.ID 
                                WHERE studentinschrijving.StudentID IS NOT NULL 
                                ORDER BY Workshop, Ronde, Voornaam, Achternaam";
                                $result = mysqli_query($PM, $sql) or die(mysqli_error());
                                while($row = mysqli_fetch_array($result)) {
                            ?>
                                    <tr>
                                        <td><?php echo $row['Voornaam']. " " .$row['Achternaam']; ?></td>
                                        <td><?php echo $row['Workshop']; ?></td>
                                        <td><?php echo $row['Ronde']; ?></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </body>
    </html>