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
<?php require 'header.php';
$obj=new facade();
$resul=$obj->readAllTD();
?>

<br>
<div class="container"> 

   <div class="row">
    <div class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-12"> 
  <div class="jumbotron">
<h3 class="display-5" align="center">NUEVO PACIENTE</h3>
            <form action="../app/logic1.php" method="post">
            <h4 align="left">Datos Personales:</h4>
            <div class="form-row">
              
               <div class="form-group col-md-12">
                 <input type="text" id= "pnombre" name="pnombre" class="form-control" placeholder="Primer nombre" required>
               </div>
               </div>
               <div class="form-row">
               <div class="form-group col-md-12">
               <input type="text" id="snombre" name="snombre" class="form-control" placeholder="Segundo nombre">
               </div>
               </div>
              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="text" id="papellido" class="form-control" placeholder="Primer apellido" name="papellido" required>
              </div>
              </div>
              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="text" id="sapellido" class="form-control" name="sapellido" placeholder="Segundo apellido">
              </div>
              </div>
              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="number" id="telefono" class="form-control" name="telefono" min="3000000000" max="3999999999" placeholder="Telefono" required>
              </div>
              </div>
              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="date" id="fechanacimiento" class="form-control" name="fechanacimiento" required>
              </div>
              </div>
              <div class="form-row">
            <div class="form-group col-md-12">
            <select class="custom-select" id="sexo" name="sexo" required>
            <option value="0">Sexo</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
            </select>
            </div>
            </div>
            <h5 align="left">Datos de sesion: </h5>
            <div class="form-row">
            <div class="form-group col-md-12">
            <select class="custom-select" id="tipod" name="tipod" required>
            <option value="0">-</option>
            <option value="<?php echo $resul[0]['id_documento']; ?>"> <?php echo $resul[0]['tipo_documento']; ?></option>
            <option value="<?php echo $resul[1]['id_documento']; ?>"> <?php echo $resul[1]['tipo_documento']; ?></option>
            <option value="<?php echo $resul[2]['id_documento']; ?>"> <?php echo $resul[2]['tipo_documento']; ?></option>
            <option value="<?php echo $resul[3]['id_documento']; ?>"> <?php echo $resul[3]['tipo_documento']; ?></option>
            <option value="<?php echo $resul[4]['id_documento']; ?>"> <?php echo $resul[4]['tipo_documento']; ?></option>
            </select>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-12">
            <input type="number" class="form-control" id="id" name="id" placeholder="Numero de identificacion" required>
            </div>
            </div>
            <div class="form-row ">
            <div class="form-group col-md-12">
            <input type="mail" class="form-control" id="correo" name="correo" placeholder="Correo">
            </div>
            </div>
            <div class="form-row ">
            <div class="form-group col-md-12">
            <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Clave" required>
            </div>
            </div>
            <div class="form-row ">
            <div class="form-group col-md-12">
            <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Verifique clave" required>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-12">
            <select class="custom-select" id="ask" name="ask" required>
            <option value="0">Pregunta de seguridad</option>
            <option value="1">Nombre se su primer mascota</option>
            <option value="2">Direccion de su primer lugar de residencia</option>
            <option value="3">Nombre mejor amigo de la infancia</option>
            <option value="4">Nombre de su localidad de residencia</option>
            <option value="5">Color de su camisa favorita</option>
            </select>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-12" >
            <input type="password" class="form-control" id="answer" name="answer" placeholder="Respuesta" required>
            </div>
            </div>
              <div align="center" id="error">
              <?php 
              if(isset($_GET['iderror'])){
                if($_GET['iderror'] == 'ok'){
                 ?>
                 <p align="center" style="color:green;" >Usuario Ingresado correctamente</p>
                 <?php
                }
                if($_GET['iderror'] == 'a'){
                  ?>
                  <p align="center" style="color:red;" >La clave debe tener al menos 6 caracteres</p>
                  <?php
                 }
                 if($_GET['iderror'] == 'b'){
                  ?>
                  <p align="center" style="color:red;" >La clave no puede tener más de 16 caracteres</p>
                  <?php
                 }
                 if($_GET['iderror'] == 'c'){
                  ?>
                  <p align="center" style="color:red;" >La clave debe tener al menos una letra minúscula</p>
                  <?php
                 }
                 if($_GET['iderror'] == 'd'){
                  ?>
                  <p align="center" style="color:red;" >La clave debe tener al menos una letra mayúscula</p>
                  <?php
                 }
                 if($_GET['iderror'] == 'e'){
                  ?>
                  <p align="center" style="color:red;" >La clave debe tener al menos un caracter numérico</p>
                  <?php
                 }
                 if($_GET['iderror'] == '1'){
                  ?>
                  <p align="center" style="color:red;" >Error en el sistema, vuelva a intentarlo mas tarde</p>
                  <?php
                 }
                 if($_GET['iderror'] == '2'){
                  ?>
                  <p align="center" style="color:red;" >El documento ingresado ya esta registrado en el sistema</p>
                  <?php
                 }
                 if($_GET['iderror'] == '3'){
                  ?>
                  <p align="center" style="color:red;" >No selecciono sexo, vuelva a llenar el formualrio</p>
                  <?php
                 }
                 if($_GET['iderror'] == '4'){
                  ?>
                  <p align="center" style="color:red;" >No selecciono pregunta, vuelva a llenar el formualrio</p>
                  <?php
                 }
                 if($_GET['iderror'] == '5'){
                  ?>
                  <p align="center" style="color:red;" >El email ingresado ya esta registrado en el sistema</p>
                  <?php
                 }
                 if($_GET['iderror'] == '6'){
                  ?>
                  <p align="center" style="color:red;" >Las contraseñas ingresadas no son iguales</p>
                  <?php
                 }
                 if($_GET['iderror'] == '7'){
                  ?>
                  <p align="center" style="color:red;" >No se ingreso tipo de documento, vuelva a llenar el formulario</p>
                  <?php
                 }
              }
              ?>
              </div>
            <button type="submit" value="CREARP" name="Spaciente" class="btn btn-success btn-lg btn-block" onclick="return validarInsertP();">CREAR USUARIO</button>
            </form>
            </div>
            <div class="d-none d-sm-none d-md-block" >
        <div class="jumbotron bg-transparent">
        </div>
        </div>
        <div class="jumbotron bg-transparent">
        </div>
        
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
