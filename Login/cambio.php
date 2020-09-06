<?php if(isset($_GET['user']) && isset($_GET['t'])){?>
<!DOCTYPE html>
<html lang="en">
<?php 
require '../persistencia/facade.php';?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>
<body>
<?php require '../header.php';?>

<br>
<div class="container"> 

   <div class="row">
    <div class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-12"> 
  <div class="jumbotron">
<h3 class="display-5" align="center">EDITAR CONTRASEÑA</h3>
            <form action="../app/validarlogin.php" method="post">
            <h4 align="left">Datos de sesion:</h4>
              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="password" class="form-control" placeholder="Contraseña nueva" name="pass1" required>
              <input type="hidden" value="<?php echo $_GET['user']; ?>" class="form-control" name="user" required>
              <input type="hidden" value="<?php echo $_GET['t']; ?>" class="form-control" name="tipo" required>
              </div>
              </div>
              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="password" class="form-control"  name="pass2" placeholder="Verifique contraseña" required>
              </div>
              </div>
            <button type="submit" value="EDITAR" name="editP" class="btn btn-success btn-lg btn-block" >EDITAR CONTRASEÑA</button>
            <br>
            <?php    
         if(isset($_GET['iderror'])){
            if($_GET['iderror'] == 'ok' ||$_GET['iderror'] == 'ok1'){
                ?>
                <p align="center" style="color:green;" >Clave editada correctamente</p>
                <?php
               }
               
              if($_GET['iderror'] == '1' ||$_GET['iderror'] == '2'||$_GET['iderror'] == '3'){
                ?>
                <p align="center" style="color:red;" >Error al cambiar contraseña, revise los datos ingresados</p>
                <?php
               }
            }
          ?>
            </form>
            </div>
            <div class="d-none d-sm-none d-md-block" >
        <div class="jumbotron bg-transparent">
        </div></div>
    </div>
    </div>
    </div>
    
    </div>
    
<?php require '../footer.php';?>
</body>
</html>
<?php
}else{
    header("Location: http://localhost/clinicafinal/");
}
?>
