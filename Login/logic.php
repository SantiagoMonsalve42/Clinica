<?php
session_start();
require '../persistencia/facade.php';
if(isset($_POST['LoginC']) && $_POST['LoginC']=='CREARP' ){
if(isset($_POST['pnombre'])  && isset($_POST['papellido']) && isset($_POST['telefono']) &&
isset($_POST['fechanacimiento'])  && isset($_POST['id']) && isset($_POST['correo']) && 
isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['ask']) && isset($_POST['answer']) && 
isset($_POST['tipod']) && isset($_POST['sexo'])){
    $obj=new facade();
    $names=$_POST['pnombre']." ".$_POST['snombre'];
    $apes=$_POST['papellido']." ".$_POST['sapellido'];
    $resul=$obj->validarRegistroUser($_POST['id'],$names,$apes,$_POST['telefono'],$_POST['fechanacimiento'],
    $_POST['sexo'],$_POST['pass1'],$_POST['pass2'],$_POST['correo'],$_POST['ask'],$_POST['answer'],$_POST['tipod']);
    header("Location: http://localhost/clinicafinal/Login/registro.php?iderror=$resul");
 }
}
?>