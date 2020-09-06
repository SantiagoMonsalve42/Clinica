<?php 
session_start(); 
if($_SESSION['usuario']){
?>
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
<?php  require "header.php"; ?>
<?php 
$id=$_SESSION['usuario']; 
require '../persistencia/facade.php';
$fac=new facade();
$resul=$fac-> readOneFullById($id);
$idaux=0;
?>
<br>
<div class="container">
    
    <div class="row">
    <div class="col-1 col-sm-1">
    </div>

    <div class="col-10 col-sm-10">

<div class="jumbotron">
<?php 
if($resul[0]['sexo'] == 'Masculino'){
?>
  <img id="foto" src="http://localhost/clinicafinal/imagenes/user.png" >
<?php 
}
else{
    ?>
    <img id="foto" src="http://localhost/clinicafinal/imagenes/userw.png" >
  <?php
}
?>
<div align="center" id="error">
    <?php
    if(isset($_GET['iderror'])){
     if($_GET['iderror'] == 'ok1'){
                  ?>
                  <br>
                  <p align="center" style="color:green;" >Contraseña actualizada correctamente</p>
                  <?php
                 }
     if($_GET['iderror'] == '1' || $_GET['iderror'] == '2' || $_GET['iderror'] == '3'){
                  ?>
                  <br>
                  <p align="center" style="color:red;" >Las contraseñas ingresadas no son iguales y/o no contienen numeros y/o mayusculas</p>
                  <?php
                 }
     if($_GET['iderror'] == 'ok'){
                  ?>
                  <p align="center" style="color:green;" >Registro actualizado correctamente</p>
                  <?php
                 }
      if($_GET['iderror'] == 'bad'){
                  ?>
                  <p align="center" style="color:red;" >Error al actualizar el registro</p>
                  <?php
                 }
                }?>
    </div>
  <br>
  <h4 align="left">Datos Personales:</h4>
  <br>
  <?php for($i=0;$i<count($resul);$i++){?> 
  <p class="lead">Id: <?php echo $resul[$i]['id_paciente'];?> </p>
  <p class="lead">Nombres: <?php echo $resul[$i]['nombres']?> </p>
  <p class="lead">Apellidos: <?php echo $resul[$i]['apellidos']?> </p>
  <p class="lead">Telefono: <?php echo $resul[$i]['telefono']?> </p>
  <p class="lead">Fecha nacimiento: <?php echo $resul[$i]['fecha_nacimiento']?> </p>
  <p class="lead">Sexo: <?php echo $resul[$i]['sexo']?> </p>
  <p class="lead">Correo: <?php echo $resul[$i]['correo']?> </p>
 <a href="http://localhost/clinicafinal/User/editPP.php?idp=<?php echo $resul[$i]['id_paciente']; ?>" class="btn btn-success btn-lg btn-block">EDITAR CLAVE</a>
  <a href="http://localhost/clinicafinal/User/editP.php?idp=<?php echo $resul[$i]['id_paciente']; ?>" class="btn btn-primary btn-lg btn-block">EDITAR TELEFONO</a>
  <?php  $resul1=$fac->readOneExpByIdPaciente($resul[$i]['id_paciente']);
              $tam=count($resul1);
      if($tam >0){?>
  <a href="http://localhost/clinicafinal/pdf/generarPDF.php?idp=<?php echo $resul[$i]['id_paciente'];?>" class="btn btn-link btn-lg btn-block">GENERAR HISTORIAL CLINICO</a>
 <?php
 } 
}
  
?>
</div>
<div class="jumbotron bg-transparent">
    </div>
</div>
</div>
</div>
<?php  require "footer.php"; ?>
</body>
</html>
<?php
}else{
  echo "<script type='text/javascript'>
  alert('ERROR!! al iniciar sesion');
  window.location='../index.php';
  </script>";
  }
?>