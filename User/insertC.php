<?php session_start();
if($_SESSION['usuario']){ ?>
<!DOCTYPE html>
<html lang="en">
<?php 
//insertando cita
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
<h3 class="display-5" align="center">NUEVA CITA</h3>
<?php
$objf=new facade();
$resul1=$objf->readMedicoEspecial();
$resul2=$objf->readAllPacienteFull();
?>
            <form action="../app/logic4.php" method="post">
               <div class="form-row">
               <div class="form-group col-md-12">
               <select class="custom-select" id="idm" name="idm" required>
            <option value="0">ESPECIALIDADES</option>
              <?php
              for($i=0;$i<count($resul1);$i++){
                ?>
           <option value="<?php echo $resul1[$i]['id_medico'];?>"><?php echo $resul1[$i]['nombre'];?></option>
              <?php
              }
              ?> 
            </select>              
              </div>
               </div>

              <input type="hidden" value="<?php echo $_SESSION['usuario'];?>" class="form-control" id="fecha" name="idp" >
            
              
              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="date" class="form-control" id="fecha" name="fecha" required>
              </div>
              </div>
              <div class="form-row">
            <div class="form-group col-md-12">
            <select class="custom-select" id="hora" name="hora" required>
            <option value="0">HORA</option>
            <option value="8">8:00</option>
            <option value="9">9:00</option>
            <option value="10">10:00</option>
            <option value="11">11:00</option>
            <option value="12">12:00</option>
            <option value="13">13:00</option>
            <option value="14">14:00</option>
            <option value="15">15:00</option>
            <option value="16">16:00</option>
            <option value="17">17:00</option>
            <option value="18">18:00</option>
            </select>
            </div>
            </div>
              <div align="center" id="error">
              <?php 
              if(isset($_GET['iderror'])){
                if($_GET['iderror'] == 'ok'){
                 ?>
                 <p align="center" style="color:green;" >Cita ingresada correctamente</p>
                 <?php
                }
                if($_GET['iderror'] == '1' ||$_GET['iderror'] == '2'){
                  ?>
                  <p align="center" style="color:red;" >La cita ya ha sido asignada, intente con en otra hora o fecha</p>
                  <?php
                 }
                 if($_GET['iderror'] == '3'){
                  ?>
                  <p align="center" style="color:red;" >Las citas solo pueden ser asignadas de lunes a viernes</p>
                  <?php
                 }
                 if($_GET['iderror'] == '4'){
                  ?>
                  <p align="center" style="color:red;" >Fecha ingresada no valida, intente con fechas proximas</p>
                  <?php
                 }
              }
                ?>
              </div>
            <button type="submit" value="CREARC" name="CITA"class="btn btn-success btn-lg btn-block" onclick="return validarInsertC();">CREAR CITA</button>
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
echo "<script type='text/javascript'>
alert('ERROR!! al iniciar sesion');
window.location='../index.php';
</script>";
}?>

