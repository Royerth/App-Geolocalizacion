<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GESPROJECT USB</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
   





<!-- Wrap all page content here -->
<div id="wrap">
  
 
  <?php include ("navbar.php"); ?>
  
  <!-- Begin page content -->

  <footer class="container-fluid text-center" style="margin-top:100px;">
    
    <p><a href=""></a> <img src="img/1.jpg" style="width:800px; height:400px; margin-top:-15px;" /></p>
  

  </footer>

<div id="contenedor">
       <!-- <div id="titulo1" class="letras">
            <h1>INICIAR</h1>
        </div>-->
        
        <div id="titulo3" class="letras">
             <h1> INICIAR</h1>
        </div>  
    </div>
 

    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="script.js"></script>
    <script>
$(function() {
    var divsTitulos = $('.letras');
    divsTitulos.each(function(){
        var divTitulo = $(this);
        var titulo = divTitulo.find('h1').text();

        var tituloSeparado = '';
        for (var i = 0; i < titulo.length; i++) {
            if (titulo[i] == ' ') {
                tituloSeparado += '<a class="espacio" href="usuarios.php" style="color: #3DBCA1; text-decoration:none;">' +  titulo[i] + '</a>';
            } else{
                tituloSeparado += '<a class="letra" href="usuarios.php" style="color: #3DBCA1; text-decoration:none;">' +  titulo[i] + '</a>';  
            };
        };

        divTitulo.empty().append(tituloSeparado);
    });
});
     </script>

  <?php include ("footer.php"); ?>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
   
  </body>
</html> 
