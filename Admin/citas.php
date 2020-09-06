<?php  session_start();
if($_SESSION['usuario']){?>
<!DOCTYPE html>
<html lang="en">
<?php 
require '../persistencia/facade.php';?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>
<body>
<?php require 'header.php';
$obj=new facade();
$resul=$obj->readAllCitas();?>

<div class="container"> 
  <div class="row">
      
  <div class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-2">
    </div>
            <div class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-8">
    <h3 class="display-3" align="center">CITAS</h3>

    <form action="citas.php" method="post">
    <div class="row">
    <div class="col-3 col-sm-3 col-xs-3 col-md-2 col-lg-2">
    <a href="http://localhost/clinicafinal/Admin/insertC.php" class="btn btn-dark ">Nueva cita</a>
    </div>  
    <div class="col-6 col-sm-6 col-xs-6 col-md-8 col-lg-8">
    <input type="number" class="form-control" placeholder="Ingrese ID de medico, usuario o cita.." id="pass1" name="id" required>         
    </div>
    <div class="col-3 col-sm-3 col-xs-3 col-md-2 col-lg-2">
    <button type="submit" value="SEARCHC" name="SEARCH" class="btn btn-dark"  >Buscar Cita</button>
    </div>
    </form>
    </div>
   <br>
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
              }
                ?>
    </div>
    <?php
    if(isset($_POST['SEARCH']) && $_POST['SEARCH']=='SEARCHC'){
      $resul=$obj->readDatesToSearchById($_POST['id']);
      $tam=count($resul);
      if($tam>0){
        ?>
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
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
       </tr>
      </thead>
      <tbody>
      <?php for($i=0;$i<count($resul);$i++){?>
      <tr>
        <td><?php echo $resul[$i]['id_cita'];?></td>
        <input type="hidden" value='<?php echo $resul[$i]['id_cita'];?>' name="id_c">
        <td><?php echo $resul[$i]['id_paciente'];?></td>
        <td><?php echo $resul[$i]['id_medico'];?></td>
        <td><?php echo $resul[$i]['fecha'];?></td>
        <td><?php echo $resul[$i]['dia_semana'];?></td>
        <td><?php echo $resul[$i]['hora_i'];?>:00</td>
        <td><?php echo $resul[$i]['estado'];?></td>
         <td></td>
        <td><a href="http://localhost/clinicafinal/Admin/editC.php?idc=<?php echo $resul[$i]['id_cita'];?>"><img src="http://localhost/clinicafinal/imagenes/calendar.png" alt="Editar" id="icono"></a></td>
        <td><a href="http://localhost/clinicafinal/app/logic2.php?idc=<?php echo $resul[$i]['id_cita'];?>&accion=delete"><img src="http://localhost/clinicafinal/imagenes/eliminar.png" alt="Editar" id="icono"></a></td>
         <td></td>
      </tr>
      <tr>
      <?php  }?>
       </tbody>
      </table>
      </div>
        <?php
      }else{
        ?>
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
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
       </tr>
      </thead>
      <tbody>
      <tr>
       <td colspan="11" style="text-align:center;">Ningun registro cumple con su criterio de busqueda..</td>
      </tr>
      <tr>
       </tbody>
      </table>
      </div>
      <?php
      }
    }
    else{
    ?>
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
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
     </tr>
    </thead>
    <tbody>
    <?php for($i=0;$i<count($resul);$i++){?>
    <tr>
      <td><?php echo $resul[$i]['id_cita'];?></td>
      <input type="hidden" value='<?php echo $resul[$i]['id_cita'];?>' name="id_c">
      <td><?php echo $resul[$i]['id_paciente'];?></td>
      <td><?php echo $resul[$i]['id_medico'];?></td>
      <td><?php echo $resul[$i]['fecha'];?></td>
      <td><?php echo $resul[$i]['dia_semana'];?></td>
      <td><?php echo $resul[$i]['hora_i'];?>:00</td>
      <td><?php echo $resul[$i]['estado'];?></td>
       <td></td>
      <td><a href="http://localhost/clinicafinal/Admin/editC.php?idc=<?php echo $resul[$i]['id_cita'];?>"><img src="http://localhost/clinicafinal/imagenes/calendar.png" alt="Editar" id="icono"></a></td>
      <td><a href="http://localhost/clinicafinal/app/logic2.php?idc=<?php echo $resul[$i]['id_cita'];?>&accion=delete"><img src="http://localhost/clinicafinal/imagenes/eliminar.png" alt="Editar" id="icono"></a></td>
       <td></td>
    </tr>
    <tr>
    <?php  }?>
     </tbody>
    </table>
    <?php  
  }?>
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