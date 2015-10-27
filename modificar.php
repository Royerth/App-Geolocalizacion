





<?php
include_once 'dbMySql.php';
$con = new DB_con();
$formatos=array('.jpg','.png','.gif','.ico');
// data insert code starts here.




    
if(isset($_POST['modificar']))
{
    $id= $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email= $_POST['email'];
    $lugar = $_POST['lugar'];
    $coordenada_x= $_POST['coordenada_x'];
    $coordenada_y= $_POST['coordenada_y'];
    $img=$_POST['imagen'];

}
if(isset($_POST['modificar_datos']))
{
     $nombre=$_FILES['archivo']['name'];
        $nombreTmp=$_FILES['archivo']['tmp_name'];
        $exte=substr($nombre, strrpos($nombre,'.'));
        if (in_array($exte,$formatos)) {
            if (move_uploaded_file($nombreTmp,"imagenes/$nombre")) {
                 //echo '<script> alert(" Exito al ingresar su imagen"); </script>';
                 //echo "<script> window.location='index.php'; </script>";
            }
        }
        else{
                echo '<script> alert(" Error al ingresar la imagen"); </script>';
                echo "<script> window.location='usuarios.php'; </script>";
                
        }


    $user_id = $_POST['user_id'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email1= $_POST['email'];
    $lugar1 = $_POST['lugar'];
    $coordenada1= $_POST['coordenada_x'];
      $coordenada2= $_POST['coordenada_y'];

    $imagen = $nombre;


 
    
    $res=$con->update($user_id,$fname,$lname,$email1,$lugar1,$coordenada1,$coordenada2,$imagen);
    if($res)
    {
        ?>
        <script>
        alert('Exito al modificar');
        window.location='usuarios.php'
        </script>
        <?php
    }
    else
    {
        ?>
        <script>
        alert('Error al modificar');
        window.location='usuarios.php'
        </script>
        <?php
    }
    }

// data insert code ends here.
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP Data</title>

<link rel="stylesheet" href="style.css" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
 <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

</head>
<body>

<?php include ("navbar.php"); ?>

<center>

<div id="body">
    <div id="content" class="content">
    <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?php echo $id; ?>">
    <table align="center" class="table1">
  
    <tr>
    <th class="title">DATOS</th> 
    <th class="title"> MAPA</th>
    </tr>

   
    <tr >
    <td class="row">NOMBRE:<input type="text" name="first_name" placeholder="Nombre" value="<?php echo $nombre;?>" required /></td>
     <TD ROWSPAN=6 class="map"> 
<?php 
      $lat = $coordenada_x;
      $lng = $coordenada_y;
      $pos = $coordenada_x.",".$coordenada_y;
      $valor = explode(',',$pos); 
      echo "
      <div id='info'>".$pos."</div>
      <div id='googleMap'></div>
      <div id='respuesta'></div>";
      ?>

      </TD>
       

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
    <td>COORDENADA X:<input id="coordenada_x" type="text" name="coordenada_x" placeholder="Coordenada x"  value="<?php echo $coordenada_x; ?>"; required /></td>
    </tr>
     <tr>
    <td>COORDENADA Y:<input id="coordenada_y" type="text" name="coordenada_y" placeholder="Coordenada y"  value="<?php echo $coordenada_y; ?>" required /></td>
    </tr>




     <tr>
    <td><img src="imagenes/<?php echo $img; ?>" alt="image" class="imagen"> 
    </td>
    </tr>

    <tr>
    <td>FOTO:<input type="file" name="archivo" value="gyugy" placeholder="gbre"></td>
    </tr>
    <tr>
    <td>
    <button type="submit" name="modificar_datos"><strong>Modificar</strong></button></td>
     
    </tr>
    </table>
    </form>
    </div>

</div>

  
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
      lat = "<?php echo $lat; ?>" ;
      lng = "<?php echo $lng; ?>" ;
      var map;
      function initialize() {
        var myLatlng = new google.maps.LatLng(lat,lng);
        var mapOptions = {
          zoom: 7,
          center: myLatlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
        var marker = new google.maps.Marker({
          position: myLatlng,
          draggable:true,
          animation: google.maps.Animation.DROP,
          web:"Localización geográfica!",
          icon: "marker.png"
        });
        google.maps.event.addListener(marker, 'dragend', function(event) {
          var myLatLng = event.latLng;
          lat = myLatLng.lat();
          lng = myLatLng.lng();
          document.getElementById('info').innerHTML = [
          lat,
          lng
          ].join(', ');
          var x=document.getElementById("coordenada_x").value=[lat].join(', ');
           var y=document.getElementById("coordenada_y").value=[lng].join(', ');
        });
        marker.setMap(map);
      }
      google.maps.event.addDomListener(window, 'load', initialize);
      $("#enviar").click(function() { 
        var url = "cargar.php";
        $("#respuesta").html('<img src="cargando.gif" />');
        $.ajax({
         type: "POST",
         url: url,
         data: 'lat=' + lat + '&lng=' + lng,
         success: function(data)
         {
           $("#respuesta").html(data);
         }
       });
      }); 
    });
</script>
</center>
  <div style="width:100%; float:left;">  
    <?php include ("footer.php"); ?>
     </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>




