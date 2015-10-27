    <?php
include_once 'dbMySql.php';
$con = new DB_con();
$table = "users";
$res=$con->select($table);

if (isset($_POST['eliminar'])) {
    $id=$_POST['id'];
    $res=$con->delete($id);

    if ($res) {
      ?>
     <script>
        alert('Exito al eliminar');
        window.location='usuarios.php'
    </script>
    <?php 
    }

    else{
        ?>
        <script>
            alert('Error al eliminar');
            window.location='usuarios.php'
        </script>
        <?php
    }
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP Data</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        
<link rel="stylesheet" href="style.css" type="text/css" />

</head>


<body>
<?php include ("navbar.php"); ?>
<center>


	<div id="content" style=" margin-top:60px; float:left; width:80%;">
    <table align="center">
    <tr>
      <th class="title_usuarios" colspan="9">LISTA DE USUARIOS</th>
    </tr>
    <tr>
    <th class="title">Nombre</th> 
    <th class="title"> Apellido</th>
    <th class="title">Email</th>
    <th class="title">Lugar</th>
    <th class="title" colspan="2">Coordenadas</th>
    <th class="title">Imagen</th>
    <th class="title" colspan="2">Opciones</th>
    </tr>
    <?php
	while($row=mysql_fetch_row($res))  
	{
			?>
            <tr>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[3]; ?></td>
            <td><?php echo $row[4]; ?></td>
            <td><?php echo $row[5]; ?></td>
                <td><?php echo $row[6]; ?></td>
            <td><img src="imagenes/<?php echo $row[7]; ?>" alt="image" class="imagen"></td>
            <td>
               <form action="modificar.php" method="post">
                       <input type="hidden" name="id" value="<?php echo $row[0]; ?>">
                       <input type="hidden" name="nombre" value="<?php echo $row[1]; ?>">
                       <input type="hidden" name="apellido" value="<?php echo $row[2]; ?>">
                       <input type="hidden" name="email" value="<?php echo $row[3]; ?>">
                       <input type="hidden" name="lugar" value="<?php echo $row[4]; ?>">
                       <input type="hidden" name="coordenada_x" value="<?php echo $row[5]; ?>">
                        <input type="hidden" name="coordenada_y" value="<?php echo $row[6]; ?>">
                       <input type="hidden" name="imagen" value="<?php echo $row[7]; ?>">


                       <input class="update_delete" type="submit" value="Modificar" name="modificar">
                </form>
            </td>
            <td>
                <form action="usuarios.php" method="post"> 
                <input type="hidden" name="id" value="<?php echo $row[0]; ?>"> 
                <input class="update_delete" type="submit" value="Eliminar" name="eliminar">
                 </form>
            </td>
            </tr>
            <?php
	}
	?>
    </table>    
<a href="add_data.php">
 <button type="submit"><strong>INGRESAR NUEVO</strong></button>
</a>  
    
    </div>
</div>





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