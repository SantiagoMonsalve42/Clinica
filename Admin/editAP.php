<?php  session_start();
if($_SESSION['usuario']){
if(isset($_POST['correo'])){?>
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
<?php require 'header.php';?>

<br>
<div class="container"> 

   <div class="row">
    <div class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-12"> 
  <div class="jumbotron">
<h3 class="display-5" align="center">EDITAR CONTRASEÑA</h3>
            <form action="../app/logic.php" method="post">
            <h4 align="left">Datos de sesion:</h4>
            <div class="form-row">
              <br><br>
               <div class="form-group col-md-12">
                <h6 class="display-5">Correo: <?php echo $_POST['correo'];?></h6>
               </div>
               </div>
              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="password" class="form-control" placeholder="Contraseña nueva" id="pass1" name="pass1" required>
              </div>
              </div>
              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="password" class="form-control"  id="pass2" name="pass2" placeholder="Verifique contraseña" required>
              </div>
              </div>
            <button type="submit" value="EDITAR" name="Sadmon" class="btn btn-success btn-lg btn-block" onclick="return validarEditPas();">EDITAR CONTRASEÑA</button>
            </form>
            </div>
            <div class="d-none d-sm-none d-md-block" >
        <div class="jumbotron bg-transparent">
        </div></div>
    </div>
    </div>
    </div>
    </div>
    <script src="../js/validacionesAdmin.js"></script>
<?php require '../footer.php';?>
</body>
</html>
<?php
}else{
    header("Location: http://localhost/clinicafinal/Admin/index.php");
}
?>
<?php }else{
echo "<script type='text/javascript'>
alert('ERROR!! al iniciar sesion');
window.location='../index.php';
</script>";
}?>
