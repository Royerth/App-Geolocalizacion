
<?php
include_once 'dbMySql.php';
$con = new DB_con();
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
                <link rel="stylesheet" href="style.css" type="text/css" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <title>Vista</title>
        <script type="text/javascript">
        //Sample code written by August Li
        var icon = 'marker.png';
        var center = null;
        var map = null;
        var currentPopup;
        var bounds = new google.maps.LatLngBounds();
        function addMarker(lat, lng, info) {
            var pt = new google.maps.LatLng(lat, lng);
            bounds.extend(pt);
            var marker = new google.maps.Marker({
                position: pt,
                icon: icon,
                map: map
            });
            var popup = new google.maps.InfoWindow({
                content: info,
                maxWidth: 230
            });
            google.maps.event.addListener(marker, "click", function() {
                if (currentPopup != null) {
                    currentPopup.close();
                    currentPopup = null;
                }
                popup.open(map, marker);
                currentPopup = popup;
            });
            google.maps.event.addListener(popup, "closeclick", function() {
                map.panTo(center);
                currentPopup = null;
            });
        }
        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: new google.maps.LatLng(0, 0),
                zoom: 14,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: false,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
                },
                navigationControl: true,
                navigationControlOptions: {
                    style: google.maps.NavigationControlStyle.SMALL
                }
            });

            <?php
            /*
            $query = mysql_query("SELECT * FROM users");
            while ($row = mysql_fetch_array($query)){
 
                 $lugar=$row['lugar'];
                $nombre=$row['nombre'];
                $lat=$row['coordenada_x'];
                $lng=$row['coordenada_y'];
                $email=$row['email'];
                $imagen=$row['imagen'];

               echo ("addMarker($lat, $lng,'<h2>$lugar</h2><br/><p>$nombre</p><p>$email</p></br> <img src=\"imagenes/$imagen\" width=\"150px;\" height=\"100px;\"/>');\n");

            }


          */

            $lat=-17.402236416722136;
            $long=-66.15423444032672;
            $query = mysql_query("SELECT user_id, coordenada_x, coordenada_y,lugar,nombre,email,imagen, ((ACOS(SIN($lat * PI() / 180) * SIN(coordenada_x * PI() / 180) + COS($lat * PI() / 180) * COS(coordenada_x * PI() / 180) * COS(($long - coordenada_y) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS distance FROM users  ORDER BY distance ASC LIMIT 50 ");
            while ($row = mysql_fetch_array($query)){
 
                 $lugar=$row['lugar'];
                $nombre=$row['nombre'];
                $lati=$row['coordenada_x'];
                $lng=$row['coordenada_y'];
                $email=$row['email'];
                $imagen=$row['imagen'];

               echo ("addMarker($lati, $lng,'<h2>$lugar</h2><br/><p>$nombre</p><p>$email</p></br> <img src=\"imagenes/$imagen\" width=\"150px;\" height=\"100px;\"/>');\n");

            }
            
            ?>

            center = bounds.getCenter();
            map.fitBounds(bounds);
        }
        </script>
     </head>
     <body onload="initMap()" style="margin:0px; border:0px; padding:0px;">

        <?php include ("navbar.php"); ?>
        <div>

      <div style="background:yellow; width:32%; float:left; display:inline-block; margin-right:1%; margin-top:1%;  margin-top:100px; ">
      
      <table align="center" class="table2">
  
    <tr>
    <th class="title">DATOS</th> 
    
    </tr>

   
    <tr>

    <td>APELLIDOS:<input type="text" name="last_name" placeholder="Apellido"  value="<?php echo $apellido; ?>" required /></td>
    </tr>
    <tr>
    <td>CORREO ELECTRONICO:<input type="text" name="email" placeholder="Email" value="<?php echo $email; ?>" required /></td>
    </tr>
     <tr>
    <td>LUGAR:<input type="text" name="lugar" placeholder="Lugar" value="<?php echo $lugar;?>" required /></td>
    </tr>
    <tr>
    <td>
    <button type="submit" name="modificar_datos"><strong>Modificar</strong></button></td>
     
    </tr>
    </table>
    </div>
        <div id="map" class="mapa-total" style="width:65%; height:600px; display:inline-block; float:left; margin-top:100px;"></div>

        </div>

    <div style="width:100%; float:left; padding:0px;">  
    <?php include ("footer.php"); ?>
     </div>

            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    </body>
 </html>