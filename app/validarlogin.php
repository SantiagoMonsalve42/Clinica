<?php

include '../persistencia/facade.php';
//iniciamos la variable sesion
session_start();
//----------------------INICIO DE SESION ---------------------------//
if(isset($_POST['user']) && isset($_POST['pass'])){
  $user=$_POST['user'];
//$pass=hash('sha256',$_POST['pass']);
$pass=$_POST['pass'];
$objf=new facade();
//llamamos a validarCredencial para que nos diga que 
//tipo de usuario inicia sesion
$c=$objf->validarCredencial($user,$pass);    //c=1=admin, c=2=medico, c=3=paciente 
$iddef=0;
if($c==1){
    $iddef=$objf->idDefinitivo($c,$user);//definimos id de la sesion 
    $_SESSION["usuario"]=$iddef;//a la variable sesion le asignamos el usuario correspondiente
    header("Location: http://localhost/clinicafinal/Admin"); //redireccionamos al index de admin
}else
if($c==2){
    $iddef=$objf->idDefinitivo($c,$user);
    $_SESSION["usuario"]=$iddef;
    header("Location: http://localhost/clinicafinal/Medico"); 
}
if($c==3){
    $iddef=$objf->idDefinitivo($c,$user);
    $_SESSION["usuario"]=$iddef;
    header("Location: http://localhost/clinicafinal/User");
}else{
    echo "<script type='text/javascript'>
    alert('Usuario o contraseña invalido..');
    window.location='http://localhost/clinicafinal/Login';
    </script>"; 
}
}


//----------------------RECUPERAR CONTRASEÑA ---------------------------//
if(isset($_POST['mail']) && isset($_POST['recuperar']) && $_POST['recuperar']=='recuperar'){
    $objf=new facade();
    $tipo=$objf->validarCorreo($_POST['mail']);
    if($tipo == 0){
    header("Location: http://localhost/clinicafinal/Login/recuperar.php?error=1"); 
    }else{//Si el correo es valido
    $iddef=$objf->idDefinitivo($tipo,$_POST['mail']);//definimos el id de la sesion
    header("Location: http://localhost/clinicafinal/Login/ask.php?user=$iddef&t=$tipo");
    }

}
//----------------------VALIDAR RESPUESTA ---------------------------//
if(isset($_POST['validarR']) && isset($_POST['id']) && 
    isset($_POST['answer']) && isset($_POST['tipo'])){
  $id=$_POST['id'];
  $ans=$_POST['answer'];
  $tipo=$_POST['tipo'];
  $objf=new facade();
  $resul=$objf->validarPregunta($tipo,$id,$ans);
  if($resul == true){
    header("Location: http://localhost/clinicafinal/Login/cambio.php?user=$id&t=$tipo");  
  }else{
    header("Location: http://localhost/clinicafinal/Login/ask.php?error=1&user=$id&t=$tipo"); 
  }
  }
//----------------------EDITAR CONTRASEÑA ---------------------------//
if(isset($_POST['editP']) && $_POST['editP'] == 'EDITAR'){
  if(isset($_POST['user']) && isset($_POST['tipo']) && isset($_POST['pass1']) 
  && isset($_POST['pass2'])){
  $id=$_POST['user'];
  $tipo=$_POST['tipo'];
  $p1=$_POST['pass1'];
  $p2=$_POST['pass2'];
  $objf=new facade();
  $resul='';
     if($tipo == 1){//es admon
      $resul=$objf->updatePassAdmonById($id,$p1,$p2);
     }
     if($tipo == 2){//es medico
      $resul=$objf->updatePassMedicoByAdmon($id,$p1,$p2);
     }
     if($tipo == 3){//es paciente
      $resul=$objf->updatePassPacienteById($id,$p1,$p2);
     }
     header("Location: http://localhost/clinicafinal/Login/cambio.php?iderror=$resul&user=$id&t=$tipo"); 
   
    }
  }
?>