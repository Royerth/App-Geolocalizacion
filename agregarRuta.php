<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbtuts";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    } 

// data insert code starts here.
if(isset($_POST['btn-save']))
{
    $inicio=$_POST['ruta_inicio'];
    $final=$_POST['ruta_final'];

    $lats = $_POST["lats"];
    $longs = $_POST["lngs"];
//recuperamos el maximo id de la tabla ruta
    //////////////////////////////////////



//Contamos cuantas posisciones tenemos agregada
    $cant = count($lats);

    $lat_i=$lats[0];
    $lng_i=$longs[0];

    $lat_f=$lats[$cant-1];
    $lng_f=$longs[$cant-1];

    $tabla="rutas";
    $campos="lugar_inicio,destino_final,lat_i,lng_i,lat_f,lng_f";
    $datos=" '$inicio','$final','$lat_i','$lng_i','$lat_f','$lng_f'";

    $sql = "INSERT INTO $tabla ($campos)
    VALUES ($datos)";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        echo "New record created successfully. Last inserted ID is: " . $last_id;
        for ($i=0; $i < $cant ; $i++) { 
            $rutas = "INSERT INTO coordenadas (Lat,Lng,id_ruta)
            VALUES ('$lats[$i]','$longs[$i]',$last_id)";
            if ($conn->query($rutas) === TRUE) {
                
                echo "se ha insertado";
                echo '<script type="text/javascript">alert("Se ha insertado Correctamente."); document.location.href="agregarRuta.php"; </script>';
            } else {

                echo "Error: " . $rutas . "<br>" . $conn->error;
                echo '<script type="text/javascript">alert("Error al insertar."); document.location.href="agregarRuta.php"; </script>';
                
            }
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        echo '<script type="text/javascript">alert("Error al insertar."); document.location.href="agregarRuta.php"; </script>';
    }

}
?>
<html>
	<head>
    	<title>Google Maps directions for multiple waypoints</title>
        <link rel="stylesheet" type="text/css" href="Content/site.min.css?v=6" />
        <script src="js/siteBundle.min.js?v=13" type="text/javascript"></script>
        <!-- <script src="js/jquery.js" type="text/javascript"></script>
        <script src="Scripts/bootstrap.js" type="text/javascript"></script>
        <script src="js/site.js" type="text/javascript"></script> -->
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<meta name="viewport" content="width=device-width" />
    	<meta name="application-name" content="doogal.co.uk"/> 
    	<meta name="msapplication-TileColor" content="#2161e0"/> 
    	<meta name="msapplication-TileImage" content="58f5b71c-e014-451b-a429-3806bed36566.png"/>
    	<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
    	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    	<script type="text/javascript" src="js/SiteBundle.min.js"></script>
    	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script src="js/waypoints.js?v=6" type="text/javascript"></script>
                <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css" type="text/css" />

	</head>
       <?php include ("navbar.php"); ?>
<body>
 </br></br></br></br></br>
  <div id="map" style="width:50%; height: 600px; float:left;">
    <span style="color:Gray;">Loading map...</span>
  </div>
  <div class="datos-ruta" style="width:47%; float:left; margin-left:25px;">
      <div id="tabs" role="tabpanel">
            <form name="frmImage" enctype="multipart/form-data" action="" method="post" class="frmImageUpload" >
                <div>
                    <p>Ruta</p><input name="ruta_inicio" />a<input name="ruta_final" />
                </div>
    		    <table id="waypointsLocations" style="width:100%;">
    			    <thead>
    				    <tr>
    					    <th style="text-align:left;">Location</th>
    					    <th style="text-align:left;">Latitude</th>
    					    <th style="text-align:left;">Longitude</th>
    					    <th style="text-align:left;"></th>
    					    <th style="text-align:left;"></th>
    					    <th style="text-align:left;"></th>
    				    </tr>
    			    </thead>
    			    <tbody>
    				    <tr>
    					    <td colspan="4">Ubicaciones Añadido aparecerán aquí</td>
    				    </tr>
    			    </tbody>
    		    </table>
                <button type="submit" name="btn-save" class="btnSubmit btn btn-alert">Guardar</button>
            </form>
            <input type="button" onclick="clearPolyLine()" value="Eliminar markers" class="btn btn-primary"/> Eliminar todos los markers
        </div>
    	<div id="options" role="tabpanel" class="tab-pane">
    		    <table>
    			    <tr>
    				    <td>
    					    <input type="checkbox" id="optimise" />
                  <label for="optimise">Optimizar ruta</label>
    				    </td>
    				    <td>Si se selecciona, los lugares serán reordenadas para producir el camino más corto</td>
    			    </tr>
    			    <tr>
    				    <td>
    					    <input type="checkbox" id="roundTrip" />
                  <label for="roundTrip">Ida y vuelta</label>
    				    </td>
    				    <td>Si se selecciona, su primera ubicación se utiliza como punto final del viaje</td>
    			    </tr>
    			    <tr>
    				    <td>
    					    <label for="routeType">Ruta para:</label>
    					    <select id="routeType" class="form-control">
    						    <option selected="selected">Coche</option>
    						    <option>A pie</option>
    						    <option>Transporte publico</option>
    						    <option>Bicicleta</option>
    					    </select>
    				    </td>
    				    <td></td>
    			    </tr>
    			    <tr>
    				    <td>
    					    <label for="directionUnits">Unidades</label>
    					    <select id="directionUnits" class="form-control">
    						    <option selected="selected">Kilometros</option>
    						    <option>Miles</option>
    					    </select>
    				    </td>
    				    <td></td>
    			    </tr>
    		    </table>
        </div>
        <br/>
        <input type="button" onclick="getDirections()" value="Obtener direcciones" class="btn btn-primary"/> 
        <br /><br />
        <span id="distance"></span> <span id="duration"></span>
        <div id="directions">
        </div>
    </div>
    
    <div style="width:100%; float:left;">  
    <?php include ("footer.php"); ?>
     </div>




        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
 </body>

 </html>
</html>