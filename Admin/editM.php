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
if(isset($_GET['idm'])){
$fac=new facade();
$resul=$fac->readOneMedicoEspecialidad($_GET['idm']);

?>
   <div class="row">
    <div class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-12"> 
  <div class="jumbotron">
<h3 class="display-5" align="center">EDITAR DATOS PERSONALES</h3>
            <form action="../app/logic.php" method="get">
            <h4 align="left">Datos Personales:</h4>
            <div class="form-row">
              
               <div class="form-group col-md-12">
                 <input type="text" value='<?php echo $resul[0]['nombres'];?>'id="nombre" name="nombre" class="form-control" placeholder="Primer nombre" required>
               </div>
               </div>
              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="text" class="form-control" id="apellido" value='<?php echo $resul[0]['apellidos'];?>' placeholder="Primer apellido" name="apellido" required>
              </div>
              </div>
              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="number" class="form-control" id="telefono" value='<?php echo $resul[0]['telefono'];?>' name="telefono" min="3000000000" max="3999999999" placeholder="Telefono" required>
              </div>
              </div>
              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="date" class="form-control" id="fechanacimiento"value='<?php echo $resul[0]['fecha_nacimiento'];?>' name="fechanacimiento" required>
              </div>
              </div>        
              <input type="hidden" name="idm" value='<?php echo $_GET['idm'];?>'>
              <input type="hidden" name="ide" value='<?php echo $_GET['ide'];?>'>
            <h5 align="left">Datos profesionales: </h5>
              <div class="form-row">
              <div class="form-group col-md-12" >
              <input type="text" class="form-control" id="especialidad" value='<?php echo $resul[0]['nombre'];?>' name="especialidad" placeholder="Especialidad" readonly>
              </div>
              </div>
              <div class="form-row">
              <div class="form-group col-md-12" >
              <textarea class="form-control" id="descripcion" name="descripcion"  placeholder="Descripcion" readonly><?php echo $resul[0]['descripcion'];?> </textarea>
              </div>
              </div>
              <div align="center" id="error">
              </div>
            <button type="submit" value="EDITAR1" name="Smedico" class="btn btn-dark btn-lg btn-block" onclick="return validarEditM();" >EDITAR USUARIO</button>
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
  header("Location: http://localhost/clinicafinal/Admin/medic.php");
}
}else{
  echo "<script type='text/javascript'>
  alert('ERROR!! al iniciar sesion');
  window.location='../index.php';
  </script>";
  }?>

