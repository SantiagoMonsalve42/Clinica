<?php
//cita
session_start();
if($_SESSION['usuario']){
require '../persistencia/facade.php';
if(isset($_POST['CITA']) && $_POST['CITA']='CREARC'){
 if(isset($_POST['hora']) && isset($_POST['fecha']) && isset($_POST['idp'])
  && isset($_POST['idm'])){
    $objf=new facade();
    $fecha_valida=$objf->validar_fecha($_POST['fecha'], $_POST['hora']);
    if($fecha_valida){
    $resul=$objf->validarDisponibilidadMedicoTiempo($_POST['idm'],$_POST['hora'],
    $_POST['fecha']);
  $tam=count($resul);
  $dia='';
  $aux=$_POST['idc'];
  $resul=$objf->dayOfTheWeek($_POST['fecha']);
  switch($resul){
      case 1: $dia='Lunes';
      break;
      case 2: $dia='Martes';
      break;
      case 3: $dia='Miercoles';
      break;
      case 4: $dia='Jueves';
      break;
      case 5: $dia='Viernes';
      break;
      default: $dia='NaN';
      break;
  }
  if($resul >= 1 && $resul <= 5){
    $resul1=$objf->validar_numero_citasxdia($_POST['idm'], $_POST['fecha']);
     $no_citas=count($resul1);
  if($tam==0 && $no_citas<10){
  if($objf->insertCita($_POST['idp'],$_POST['idm'],$_POST['fecha'],$dia,$_POST['hora'],'activo') == true){
 
  header("Location: http://localhost/clinicafinal/Admin/insertC.php?iderror=ok"); 
  }else{
  header("Location: http://localhost/clinicafinal/Admin/insertC.php?iderror=2"); 
  }
  }else{
  header("Location: http://localhost/clinicafinal/Admin/insertC.php?iderror=1");
  }
 }else{
  header("Location: http://localhost/clinicafinal/Admin/insertC.php?iderror=3");
 }
}else header("Location: http://localhost/clinicafinal/Admin/insertC.php?iderror=4");
}
}

if(isset($_POST['CITA']) && $_POST['CITA']='EDITARC'){
  if(isset($_POST['hora']) && isset($_POST['fecha']) && isset($_POST['idc'])
  && isset($_POST['idm'])){
    $objf=new facade();
    $fecha_valida=$objf->validar_fecha($_POST['fecha'], $_POST['hora']);

    if($fecha_valida){
    $resul=$objf->validarDisponibilidadMedicoTiempo($_POST['idm'],$_POST['hora'],
    $_POST['fecha']);
    $tam=count($resul);
    $dia='';
    $_POST['idc'];
    $resul=$objf->dayOfTheWeek($_POST['fecha']);
    switch($resul){
        case 1: $dia='Lunes';
        break;
        case 2: $dia='Martes';
        break;
        case 3: $dia='Miercoles';
        break;
        case 4: $dia='Jueves';
        break;
        case 5: $dia='Viernes';
        break;
        default: $dia='NaN';
        break;
    }
    $aux=$_POST['idc'];
    $idc=$_POST['idc'];
    if($resul >= 1 && $resul <= 5){
      $resul1=$objf->validar_numero_citasxdia($_POST['idm'], $_POST['fecha']);
      $no_citas=count($resul1);
      if($tam==0 && $no_citas<10){
      if($objf->updateCitaById($_POST['idc'],$_POST['fecha'],$dia,$_POST['hora'])==true){
      header("Location: http://localhost/clinicafinal/Admin/editC.php?iderror=ok&idc=$aux"); 
      }else{
      header("Location: http://localhost/clinicafinal/Admin/editC.php?iderror=2&idc=$aux"); 
      }
      }else{
      header("Location: http://localhost/clinicafinal/Admin/editC.php?iderror=1&idc=$aux");
      }
     }else{
      header("Location: http://localhost/clinicafinal/Admin/editC.php?iderror=3&idc=$aux");
     }
  }else{
    $aux=$_POST['idc'];
     header("Location: http://localhost/clinicafinal/Admin/editC.php?iderror=4&idc=$aux");
  }
  }
}

if(isset($_GET['idc']) && $_GET['accion']='delete'){
  $objf=new facade();
  $resul=$objf->deleteCitaById($_GET['idc']);
  if($resul){
    header("Location: http://localhost/clinicafinal/Admin/citas.php?iderror=ok"); 
  }else{
    header("Location: http://localhost/clinicafinal/Admin/ecitas.php?iderror=fail"); 
  }
}

}else{
  echo "<script type='text/javascript'>
  alert('ERROR!! al iniciar sesion');
  window.location='../index.php';
  </script>";}
?>