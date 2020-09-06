<?php
//paciente
session_start();
if($_SESSION['usuario']){
require '../persistencia/facade.php';
if(isset($_POST['Spaciente']) && $_POST['Spaciente']=='CREARP' ){
if(isset($_POST['pnombre'])  && isset($_POST['papellido']) && isset($_POST['telefono']) &&
isset($_POST['fechanacimiento'])  && isset($_POST['id']) && isset($_POST['correo']) && 
isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['ask']) && isset($_POST['answer']) && 
isset($_POST['tipod']) && isset($_POST['sexo'])){
    $obj=new facade();
    $names=$_POST['pnombre']." ".$_POST['snombre'];
    $apes=$_POST['papellido']." ".$_POST['sapellido'];
    $resul=$obj->validarRegistroUser($_POST['id'],$names,$apes,$_POST['telefono'],$_POST['fechanacimiento'],
    $_POST['sexo'],$_POST['pass1'],$_POST['pass2'],$_POST['correo'],$_POST['ask'],$_POST['answer'],$_POST['tipod']);
    header("Location: http://localhost/clinicafinal/Admin/insertP.php?iderror=$resul");
 }
}

if(isset($_POST['Spaciente']) && $_POST['Spaciente']=='EDITAR1' ){
 if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['telefono']) 
 && isset($_POST['fechanacimiento']) && isset($_POST['idp'])){
    $obj=new facade();
    $resul=$obj->updateDatosPaciente($_POST['idp'],$_POST['nombre'],
    $_POST['apellido'],$_POST['telefono'],$_POST['fechanacimiento']);
   if($resul){
    header("Location: http://localhost/clinicafinal/User/index.php?iderror=ok");
   }else{
    header("Location: http://localhost/clinicafinal/User/index.php?iderror=bad");
   }
 }
}

if(isset($_POST['Spaciente']) && $_POST['Spaciente']=='EDITAR2'){
   if(isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['idp'])){
      $obj=new facade();
      $resul=$obj->updatePassPacienteById($_POST['idp'],$_POST['pass1'],$_POST['pass2']);
      header("Location: http://localhost/clinicafinal/Admin/users.php?iderror=$resul");
   }
}

if(isset($_GET['idp']) && $_GET['accion']=='delete'){
   $obj=new facade();
   $resul=$obj->deleteFullPaciente($_GET['idp']);
   if($resul){
      header("Location: http://localhost/clinicafinal/Admin/users.php?iderror=ok2");
   }else{
      header("Location: http://localhost/clinicafinal/Admin/users.php?iderror=bad2");
   }
}
}else{
   echo "<script type='text/javascript'>
   alert('ERROR!! al iniciar sesion');
   window.location='../index.php';
   </script>";}
?>