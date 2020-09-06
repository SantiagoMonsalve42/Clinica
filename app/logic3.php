<?php
//medico
session_start();
if($_SESSION['usuario']){
require '../persistencia/facade.php';
//update password
if(isset($_POST['EDITARM']) && $_POST['EDITARM']=='EDITARC'){
    if(isset($_POST['pass1']) && isset($_POST['pass2'])){
     $idm=$_POST['idm'];
     $pass1=$_POST['pass1'];
     $pass2=$_POST['pass2'];
     $obj=new facade();
     $result=$obj->updatePassMedicoByAdmon($idm,$pass1,$pass2);
       header("Location: http://localhost/clinicafinal/Medico/editCM.php?iderror=$result");
    }
}
//update phone number
if(isset($_POST['EDITARP']) && $_POST['EDITARP']=='EDITARD'){
  $idm=$_POST['idm'];
  $tel=$_POST['telefono'];
  $obj=new facade();
  $resul=$obj->updateTelMedById($idm,$tel);
  if($resul){
    header("Location: http://localhost/clinicafinal/Medico/editPM.php?iderror=ok&idm=$idm");
  }else{
    header("Location: http://localhost/clinicafinal/Medico/editPM.php?iderror=1&idm=$idm");
  }
}
//delete cita
if(isset($_GET['idc']) && $_GET['accion']='delete'){
  $objf=new facade();
  $resul=$objf->deleteCitaById($_GET['idc']);
  if($resul){
    header("Location: http://localhost/clinicafinal/Medico/citas.php?iderror=ok"); 
  }else{
    header("Location: http://localhost/clinicafinal/Medico/citas.php?iderror=fail"); 
  }
}
//crear historia medica
if(isset($_POST['CREARH']) && $_POST['CREARH']='CREARH'){
  $objf=new facade();
  $resul1=$objf->insertHistoryById($_POST['id'],$_POST['peso'],$_POST['altura'],
  $_POST['motivos'],$_POST['enfermedades'],$_POST['antecedentesp'],$_POST['alergias'],
  $_POST['antecedentesf'],$_POST['medicamentos']);
  $idc=$_POST['idc'];
  $resul2=$objf->updateStatusInactive($idc);
  if($resul1 && $resul2){
  header("Location: http://localhost/clinicafinal/Medico/citas.php?iderror=okA&idp=".$_POST['id']); 
  }else{
  header("Location: http://localhost/clinicafinal/Medico/citas.php?iderror=failA");
  }
}
//update cita by id
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
    if($resul >= 1 && $resul <= 5){
      $resul1=$objf->validar_numero_citasxdia($_POST['idm'], $_POST['fecha']);
      $no_citas=count($resul1);
      if($tam==0 && $no_citas<10){
      if($objf->updateCitaById($_POST['idc'],$_POST['fecha'],$dia,$_POST['hora'])==true){
      header("Location: http://localhost/clinicafinal/Medico/editC.php?iderror=ok&idc=$aux"); 
      }else{
      header("Location: http://localhost/clinicafinal/Medico/editC.php?iderror=2&idc=$aux"); 
      }
      }else{
      header("Location: http://localhost/clinicafinal/Medico/editC.php?iderror=1&idc=$aux");
      }
     }else{
      header("Location: http://localhost/clinicafinal/Medico/editC.php?iderror=3&idc=$aux");
     }
     
  }else{
    $aux=$_POST['idc'];
    header("Location: http://localhost/clinicafinal/Medico/editC.php?iderror=4&idc=$aux");
  } 
}
}
}else{
  echo "<script type='text/javascript'>
  alert('ERROR!! al iniciar sesion');
  window.location='../index.php';
  </script>";}
?>