<?php  session_start();
if($_SESSION['usuario']){?>
<!DOCTYPE html>
<html lang="en">
<?php 
require '../persistencia/facade.php';?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>
<body>
<?php require 'header.php';
$obj=new facade();
$resul=$obj->readMedicoEspecial();
?>
<br>
<div class="container"> 
  <div class="row">
            <div class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-12">
    <h3 class="display-3" align="center">MEDICOS</h3>
    <?php $resul1=$obj->readAllEspecialidadDisponible();
    $tam=count($resul);
    if($tam < 10){
    ?>
    <a href="http://localhost/clinicafinal/Admin/insertM.php" class="btn btn-dark">Nuevo Medico</a>
    <br><br>
    <?php } ?>
    <div align="center" id="error">
    <?php    
    if(isset($_GET['iderror'])){
    if($_GET['iderror'] == 'ok'){
                 ?>
                 <p align="center" style="color:green;" >Registro eliminado correctamente</p>
                 <?php
                }
    if($_GET['iderror'] == 'ok1'){
                  ?>
                  <p align="center" style="color:green;" >Registro actualizado correctamente</p>
                  <?php
                 }
 
    if($_GET['iderror'] == 'fail'){
                  ?>
                  <p align="center" style="color:red;" >Error al eliminar registro</p>
                  <?php
                 }
                 
    if($_GET['iderror'] == 'EMok'){
      ?>
      <p align="center" style="color:green;" >Clave editada correctamente</p>
      <?php
     }
     
    if($_GET['iderror'] == 'em1' ||$_GET['iderror'] == 'em2'||$_GET['iderror'] == 'em3'){
      ?>
      <p align="center" style="color:red;" >Las contraseñas ingresadas no son iguales y/o no contienen numeros y/o mayusculass</p>
      <?php
     }
                }?>
    </div>
    <div class="table-responsive">
    
  <table id="tmedicos" class="table table-striped table-dark">
  <thead>
    <tr >
      <th scope="col">Id</th>
      <th scope="col">Especialidad</th>
      <th scope="col">Desc. especialidad</th>
      <th scope="col">Nombres</th>
      <th scope="col">Apellidos</th>
      <th scope="col">Telefono</th>
      <th scope="col">Sexo</th>
      <th scope="col">Fecha_nacimiento</th>
      <th scope="col">Correo</th>
      <th scope="col">Pregunta de seguridad:</th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
     </tr>
    </thead>
    <tbody>
    <?php for($i=0;$i<count($resul);$i++){?>
    <tr>
      <td><?php echo $resul[$i]['id_medico'];?></td>
      <td><?php echo $resul[$i]['nombre'];?></td>
      <td><?php echo $resul[$i]['descripcion'];?></td>
      <td><?php echo $resul[$i]['nombres'];?></td>
      <td><?php echo $resul[$i]['apellidos'];?></td>
      <td><?php echo $resul[$i]['telefono'];?></td>
      <td><?php echo $resul[$i]['sexo'];?></td>
      <td><?php echo $resul[$i]['fecha_nacimiento'];?></td>
      <td><?php echo $resul[$i]['correo'];?></td>
      <td><?php echo $resul[$i]['pregunta'];?></td>
       <td> <a href="http://localhost/clinicafinal/Admin/editM.php?idm=<?php echo $resul[$i]['id_medico'];?>&ide=<?php echo $resul[$i]['id_especialidad'];?>"><img src="http://localhost/clinicafinal/imagenes/edit.png" alt="Editar" id="icono"></a></td>
      <td><a href="http://localhost/clinicafinal/Admin/editMP.php?idm=<?php echo $resul[$i]['id_medico'];?>"><img src="http://localhost/clinicafinal/imagenes/editp.png" alt="Editar" id="icono"></a></td>
      <td><a href="http://localhost/clinicafinal/app/logic.php?idm=<?php echo $resul[$i]['id_medico'];?>&ide=<?php echo $resul[$i]['id_especialidad'];?>&accion=delete"><img src="http://localhost/clinicafinal/imagenes/eliminar.png" alt="Editar" id="icono"></a></td>
       <td></td>
    </tr>
    <tr>
    <?php  }?>
     </tbody>
    </table>
    
    <div class="jumbotron bg-transparent">
    </div>
          
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