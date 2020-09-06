<?php
//medico
session_start();
if($_SESSION['usuario']){
require '../persistencia/facade.php';
//Insertando medico desde el admin
if(isset($_POST['Smedico']) &&$_POST['Smedico']=='CREARM' ){
if(isset($_POST['pnombre']) && isset($_POST['snombre']) && isset($_POST['papellido']) &&
isset($_POST['sapellido']) && isset($_POST['telefono']) && isset($_POST['fechanacimiento'])  
&& isset($_POST['id']) && isset($_POST['correo']) && isset($_POST['pass1']) 
&& isset($_POST['pass2']) && isset($_POST['ask']) && isset($_POST['answer']) &&
 isset($_POST['especialidad']) && isset($_POST['sexo'])){
  $obj=new facade();
  $names=$_POST['pnombre']." ".$_POST['snombre'];
  $apes=$_POST['papellido']." ".$_POST['sapellido'];
  $resul=$obj->validarRegistroMedico(($_POST['id']),$names,$apes,$_POST['telefono'],$_POST['fechanacimiento'],
  $_POST['sexo'],$_POST['pass1'],$_POST['pass2'],$_POST['correo'], $_POST['ask'],$_POST['answer'],
  $_POST['especialidad']);
  if($resul=="bien"){
    header("Location: http://localhost/clinicafinal/Admin/insertM.php?iderror=ok");
  }else{
    header("Location: http://localhost/clinicafinal/Admin/insertM.php?iderror=$resul"); 
  }
}else{
  
  header("Location: http://localhost/clinicafinal/Admin/insertM.php");
}
}
//Eliminando medico desde admin 
if(isset($_GET['accion']) && $_GET['accion']="delete"){
  $idm=$_GET['idm'];
  $ide=$_GET['ide'];
  $obj=new facade();
  if($obj->deleteFullMedico($idm,$ide) == true){
    header("Location: http://localhost/clinicafinal/Admin/medic.php?iderror=ok");    
  }else{
    header("Location: http://localhost/clinicafinal/Admin/medic.php?iderror=fail");    
  }
}
//Editando medico desde admin
if(isset($_GET['Smedico']) && $_GET['Smedico']=='EDITAR1'){
  if(isset($_GET['ide']) && isset($_GET['idm']) && isset($_GET['nombre']) && isset($_GET['apellido']) &&
  isset($_GET['telefono']) && isset($_GET['fechanacimiento']) && isset($_GET['especialidad']) && isset($_GET['descripcion'])){
    $idm=$_GET['idm'];
    $ide=$_GET['ide'];
    $obj=new facade();
  if($obj->updateMedicoEspe($ide,$_GET['especialidad'],$_GET['descripcion']) == true &&
  $obj->updateMedicoPersonal($idm,$_GET['nombre'],$_GET['apellido'],
  $_GET['fechanacimiento'],$_GET['telefono']) ==true){
    header("Location: http://localhost/clinicafinal/Admin/medic.php?iderror=ok1");
  }else {
    header("Location: http://localhost/clinicafinal/Admin/editM.php?iderror=fail1");
  }
}else{
  header("Location: http://localhost/clinicafinal/Admin/medic.php?iderror=fail");
}
}
//Actualizando contraseña medico desde admin
if(isset($_POST['Smedico']) && $_POST['Smedico']=='EDITAR2'){
 if(isset($_POST['pass1']) && isset($_POST['pass2'])){
  $idm=$_POST['idm'];
  $pass1=$_POST['pass1'];
  $pass2=$_POST['pass2'];
  $obj=new facade();
  $result=$obj->updatePassMedicoByAdmon($idm,$pass1,$pass2);
    header("Location: http://localhost/clinicafinal/Admin/medic.php?iderror=EM$result");
 }
}
//Actualizando contraseña de admon
if(isset($_POST['Sadmon']) && $_POST['Sadmon']=='EDITAR'){
  $ida=$_SESSION['usuario'];
  $pass1=$_POST['pass1'];
  $pass2=$_POST['pass2'];
  $obj=new facade();
  $result=$obj->updatePassAdmonById($ida,$pass1,$pass2);
  header("Location: http://localhost/clinicafinal/Admin/index.php?iderror=EA$result");
  
}
}else{
  echo "<script type='text/javascript'>
  alert('ERROR!! al iniciar sesion');
  window.location='../index.php';
  </script>";}
?>