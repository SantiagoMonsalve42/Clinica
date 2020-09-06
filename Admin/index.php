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
    <title>Perfil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>
<body>
<?php require 'header.php';
$fac=new facade();
$resul=$fac->readAdmonById($_SESSION['usuario']);
?>

<br>
<br>
<br>
<br>
<div class="container">
    
    <div class="row">
    <div class="col-1 col-sm-1">
    </div>

    <div class="col-10 col-sm-10">

<div class="jumbotron">

<h3 class="display-3" align="center">PERFIL</h3>
<br><br>
  <img id="foto" src="http://localhost/clinicafinal/imagenes/user.png" >
  <br>
  <form action="./editAP.php" method="post">
  <h4 align="left">Datos Personales:</h4>
  <br>
  <p class="lead">Id: <?php echo $resul[0]['id_admon'];?> </p>
  <p class="lead">Correo: <?php echo $resul[0]['correo'];?> </p>
  <input type="hidden" value='<?php echo $resul[0]['correo'];?>' name="correo">
  <p class="lead">Pregunta de seguridad: <?php echo $resul[0]['pregunta'];?> </p>
  <p class="lead">Respuesta: <?php echo $resul[0]['respuesta'];?> </p>
  <button type="submit" value="EDITAR" name="Sadmon" class="btn btn-success btn-lg btn-block" >EDITAR CONTRASEÑA</button>
  </form>
  <div align="center" id="error">
    <?php    
    if(isset($_GET['iderror'])){
      if($_GET['iderror'] == 'EAok'){
        ?>
        <br>
        <p align="center" style="color:green;" >Clave editada correctamente</p>
        <?php
       }
       
    if($_GET['iderror'] == 'EA1' ||$_GET['iderror'] == 'EA2'||$_GET['iderror'] == 'EA3'){
      ?>
      <br>
      <p align="center" style="color:red;" >Las contraseñas ingresadas no son iguales y/o no contienen numeros y/o mayusculas</p>
      <?php
     }
      
  }?>
</div>


</div>
<div class="jumbotron bg-transparent">
    </div>
</div>
</div>
</div>

<?php require '../footer.php';?>
</body>
</html>
<?php }else{
echo "<script type='text/javascript'>
alert('ERROR!! al iniciar sesion');
window.location='../index.php';
</script>";
}?>