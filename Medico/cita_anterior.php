<?php 
session_start(); 
if($_SESSION['usuario']){
require '../persistencia/facade.php';
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

<?php  require "header.php"; 

$obj=new facade();

$fechaActual = date('Y-m-d');
$resul=$obj->readOneByMedicoAnteriores($_SESSION['usuario'],$fechaActual);
$tam=count($resul);
?>
<div class="container"> 
  <div class="row">
      
  <div class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-2">
    </div>
            <div class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-8">
    <h3 class="display-3" align="center">CITAS</h3>

    <div class="form-row">
    
    </div>
   
    <div align="center" id="error">
    <?php 
              if(isset($_GET['iderror'])){
                if($_GET['iderror'] == 'ok'){
                 ?>
                 <p align="center" style="color:green;" >Cita medica eliminada correctamente</p>
                 <?php
                }
                if($_GET['iderror'] == 'fail'){
                  ?>
                  <p align="center" style="color:red;" >Error al eliminar la cita medica</p>
                  <?php
                 }
                 if($_GET['iderror'] == 'okA' && isset($_GET['idp'])){
                  ?>
                  <div class="alert alert-success" role="alert">
                  Cita atendida correctamente!  <a href="http://localhost/clinicafinal/pdf/generarPDF.php?idp=<?php echo $_GET['idp'];?>" class="alert-link">Haz click aqui para imprimir historial medico</a>
                  </div>
                  <?php
                 }
              }
                ?>
    </div>
    <div class="table-responsive">
    
  <table id="tmedicos" class="table table-striped table-dark">
  <thead>
    <tr >
      <th scope="col">Id cita</th>
      <th scope="col">Id paciente</th>
      <th scope="col">Id medico</th>
      <th scope="col">Fecha</th>
      <th scope="col">Dia de la semana</th>
      <th scope="col">Hora</th>
      <th scope="col">Estado</th>
      <th scope="col"></th>
     </tr>
    </thead>
    
    <tbody>
    <?php if($tam>0){?>
    <?php for($i=0;$i<count($resul);$i++){?>
    <tr>
      <td><?php echo $resul[$i]['id_cita'];?></td>
      <td><?php echo $resul[$i]['id_paciente'];?></td>
      <td><?php echo $resul[$i]['id_medico'];?></td>
      <td><?php echo $resul[$i]['fecha'];?></td>
      <td><?php echo $resul[$i]['dia_semana'];?></td>
      <td><?php echo $resul[$i]['hora_i'];?>:00</td>
      <td><?php echo $resul[$i]['estado'];?></td>
       
      <td><a href="http://localhost/clinicafinal/app/logic3.php?idc=<?php echo $resul[$i]['id_cita'];?>&accion=delete"><img src="http://localhost/clinicafinal/imagenes/eliminar.png" alt="Editar" id="icono"></a></td>
    
      <?php
      } ?>
       <td></td>
    </tr>
    <tr>
    <?php  
    }else{?>
      <td colspan="7" style="text-align:center;">No tiene historial de citas asignadas al momento..</td>
      <td><a href="#"><img src="http://localhost/clinicafinal/imagenes/eliminar.png" alt="Editar" id="icono"></a></td>
    <?php } ?>
     </tbody>
    </table>
    
    <div class="jumbotron bg-transparent">
    </div>
          
        </div>
      </div>
  </div>
</div>

<?php  require "footer.php"; ?>
</body>
</html>
<?php }else{
echo "<script type='text/javascript'>
alert('ERROR!! al iniciar sesion');
window.location='../index.php';
</script>";
}?>