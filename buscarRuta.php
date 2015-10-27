<?php
//SELECT id, lat, lng, ((ACOS(SIN(-17.401084070750443 * PI() / 180) * SIN(lat * PI() / 180) + COS(-17.401084070750443 * PI() / 180) * COS(lat * PI() / 180) * COS((-66.27305257226561 - lng) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS distance FROM usuario HAVING distance <= 10000 ORDER BY distance ASC LIMIT 1
$dbname            ='dbtuts'; //Name of the database
$dbuser            ='root'; //Username for the db
$dbpass            =''; //Password for the db
$dbserver          ='localhost'; //Name of the mysql server
$dbcnx = mysql_connect ("$dbserver", "$dbuser", "$dbpass");
mysql_select_db("$dbname") or die(mysql_error());
$latitud="-17.392566";
$longitud="-66.161816";
$radio=0;
//$radio=$_POST['radio'];
if(isset($_POST['btn-envio']))
{
  $latitud=$_POST['lat'];
  $longitud=$_POST['lng'];
  $radio=$_POST['radio'];
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <title>Vista</title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script type="text/javascript">
        //Sample code written by August Li
        var icon = 'marker.png';
        var center = null;
        var map = null;
        var currentPopup;
        var bounds = new google.maps.LatLngBounds();
        var latitud = "<?php echo $latitud ?>" ;
        var longitud = "<?php echo $longitud ?>" ;
        var radio="<?php echo $radio ?>";
        function addMarker(lat, lng, info) {
            var pt = new google.maps.LatLng(lat, lng);
            bounds.extend(pt);
            var marker = new google.maps.Marker({
                position: pt,
                icon: icon,
                map: map,
            });
            var popup = new google.maps.InfoWindow({
                content: info,
                maxWidth: 300
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
            $query = mysql_query("SELECT id,lugar_inicio,destino_final,lat_f, lng_f, ((ACOS(SIN($latitud * PI() / 180) * SIN(lat_f * PI() / 180) + COS($latitud * PI() / 180) * COS(lat_f * PI() / 180) * COS(($longitud - lng_f) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS distance FROM rutas HAVING distance <= 1 ORDER BY distance ");
            while ($row = mysql_fetch_array($query)){
                $lugar_inicio=$row['lugar_inicio'];
                $destino_final=$row['destino_final'];
                $lati=$row['lat_f'];
                $lngi=$row['lng_f'];
                $radio=$row['distance'];
                echo ("addMarker($lati, $lngi,'<h3>$lugar_inicio</h3><br/><h4>$destino_final</h4>');");
            }
            //echo ("addMarker($latitud, $longitud,'<h3>Punto de busqueda</h3>');")
            ?>

            center = bounds.getCenter();
            map.fitBounds(bounds);
            // Create marker 
            var marker3 = new google.maps.Marker({
              map: map,
              position: new google.maps.LatLng(latitud, longitud),
              title: 'Some location'
            });

            // Add circle overlay and bind to marker
            var circle = new google.maps.Circle({
              map: map,
              radius: 2000,    // 10 miles in metres
              fillColor: '#AA0000'
            });
            circle.bindTo('center', marker3, 'position');
        }
        </script>
     </head>
     <body id="body" onload="initMap()" style="margin:0px; border:0px; padding:0px;">


        <?php include ("navbar.php"); ?>

        <div id="map" class="mapa-total" style="height:600px; margin-top:70px;"></div>
        <form name="frmImage" enctype="multipart/form-data" method="post" class="frmImageUpload">
            <table>
                <tr>
                	<td><input id="address" type="textbox" value="Cochabamba Bolivia" /></td>
                	<td><input type="button" value="Localizar" onclick="codeAddress()" /></td>
                </tr>
                <tr >
                    <td width="30" height="10">Latitud</td>
                    <td><input type="text" id="latitud" name="lat" value="<?php echo $latitud;?>"></td>
                </tr>
                <tr>
                    <td>Longitud</td>
                    <td><input type="text" id="longitud" name="lng" value="<?php echo $longitud;?>"></td>
                </tr>
                <tr>
                    <td>Radio</td>
                    <td><input type="text" id="radio" name="radio" value="<?php echo $radio;?>"></td>
                </tr>
                <tr>
                    <td><button type="submit" name="btn-envio" onclick="codeAddress()" class="btnSubmit btn btn-alert"><strong>Buscar</strong></button></td>
                </tr>
            </table>
        </form>

 <?php include ("footer.php"); ?>
<script>
      var geocoder;
      // //var map;
      // function initialize() {
      //   //var latlng = new google.maps.LatLng(-17.392566,-66.161816);
      //   var mapOptions = {
      //     zoom: 12,
      //     center: latlng,
      //     mapTypeId: google.maps.MapTypeId.ROADMAP
      //   }
      //   //map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
      // }
 
      function codeAddress() {
        geocoder = new google.maps.Geocoder();
        var address = document.getElementById('address').value;
        geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            document.getElementById('latitud').value = results[0].geometry.location.lat().toFixed(6);
            document.getElementById('longitud').value = results[0].geometry.location.lng().toFixed(6);
            map.setCenter(results[0].geometry.location);
            var marker2 = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
</script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    </body>
 </html>    