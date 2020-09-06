<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://localhost/clinicafinal/css/estilos.css">
</head>
<body>
<?php include '../header.php';?>
<?php include '../footer.php';?>
<header>
    <br><br>
    </header>
<div class="container">
    
    <div class="row">
    <div class="col-3">
    </div>
    <div class="col-6">
    <!-- NOS REDIRECCIONA A VALIDARLOGIN CUANDO PRESIONA RECUPERAR CONTRASEÑA -->
    <h1  align="center">RECUPERAR</h1>
    <form method='post' action="../app/validarlogin.php">
  <div class="form-group row">
    <div class="col-sm-12">
      <input type="mail" class="form-control " id="mail" name="mail" placeholder="Ingrese mail">
    </div>
  </div>
  <button type="submit" name="recuperar" value="recuperar" class="btn btn-success btn-lg btn-block"  onclick="return validarCorreo();">RECUPERAR CONTRASEÑA</button>
  <?php    
    if(isset($_GET['error'])){
      if($_GET['error'] == '1'){
         ?><br>
        <p align="center" style="color:red;" >Email no registrado en el sistema</p>
        <?php
       }
    }
       ?>
</form>
    </div>
</div>
<script src="../js/login.js"></script>
</body>
</html>