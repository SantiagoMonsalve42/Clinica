<?php  session_start();
if($_SESSION['usuario']){
?>
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
<?php
if(isset($_GET['idp'])){
$fac=new facade();
$resul=$fac->readUserById($_GET['idp']);

?>
   <div class="row">
    <div class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-12"> 
  <div class="jumbotron">
<h3 class="display-5" align="center">EDITAR DATOS PERSONALES</h3>
            <form action="../app/logic1.php" method="post">
            <h4 align="left">Datos Personales:</h4>
            <div class="form-row">
              
               <div class="form-group col-md-12">
                 <input type="text" id="nombre" value='<?php echo $resul[0]['nombres'];?>'name="nombre" class="form-control" placeholder="Primer nombre" required>
               </div>
               </div>
              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="text" id="apellido" class="form-control" value='<?php echo $resul[0]['apellidos'];?>' placeholder="Primer apellido" name="apellido" required>
              </div>
              </div>
              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="number" id="telefono" class="form-control" value='<?php echo $resul[0]['telefono'];?>' name="telefono"  placeholder="Telefono" min="3000000000" max="3999999999" required>
              </div>
              </div>
          
              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="date" id="fechanacimiento" class="form-control" value='<?php echo $resul[0]['fecha_nacimiento'];?>' name="fechanacimiento" required>
              </div>
              </div>        
              <input type="hidden" name="idp" value='<?php echo $_GET['idp'];?>'>
              <div align="center" id="error">
              </div>
            <button type="submit" value="EDITAR1" name="Spaciente" class="btn btn-dark btn-lg btn-block" onclick="return validarEditP();">EDITAR USUARIO</button>
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
<?php }else{
  header("Location: http://localhost/clinicafinal/Admin/users.php");
}
}else{
  echo "<script type='text/javascript'>
  alert('ERROR!! al iniciar sesion');
  window.location='../index.php';
  </script>";
  }
  ?>