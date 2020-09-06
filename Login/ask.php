<!DOCTYPE html>
<html lang="en">
<?php 
require '../persistencia/facade.php';?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://localhost/clinicafinal/css/estilos.css">
</head>
<body>
<?php include '../header.php';?>
<?php include '../footer.php';?>
<header>
    <br><br>
    </header>
<div class="container">
    
    <div class="row">
    <div class="col-3">
    </div>
    <div class="col-6">
    <?php  
    if(isset($_GET['user']) && isset($_GET['t'])){
      $fac=new facade();
      $user=$_GET['user'];
      $type=$_GET['t'];
    ?>
    
    <div class="col-sm-12">
    <h1 align="center">SEGURIDAD</h1>
    </div>
    <!--- NOS ENVIA A VALIDAR LOGIN SI ENVIA RESPUESTA --->
    <form method='post' action="../app/validarlogin.php">
  <div class="form-group row">
  <?php if($type ==1){
   $resul=$fac->readAdmonById($user);
  ?>
    <div class="col-sm-12">
    <h5 class="display-5" align="left">Pregunta de seguridad:</h5>
    <label for=""><?php echo $resul[0]['pregunta'];?></label>
     <input type="hidden" class="form-control " name="id" value='<?php echo $user;?>' placeholder="Respuesta">
    <input type="hidden" class="form-control " name="tipo" value='<?php echo $type;?>' placeholder="Respuesta">
    <br>
    </div>
    <div class="col-sm-12">   
    <input type="password" class="form-control " name="answer" placeholder="Respuesta">
    </div>
    <?php  
    }
    if($type ==2){
        $resul=$fac->readOneMedicoEspecialidad($user);
       ?>
         <div class="col-sm-12">
         <h5 class="display-5" align="left">Pregunta de seguridad:</h5>
         <label for=""><?php echo $resul[0]['pregunta'];?></label> 
             <input type="hidden" class="form-control " name="id" value='<?php echo $user;?>' placeholder="Respuesta">
         <input type="hidden" class="form-control " name="tipo" value='<?php echo $type;?>' placeholder="Respuesta">
         <br>
         </div>
         <div class="col-sm-12">   
         <input type="password" class="form-control " name="answer" placeholder="Respuesta">
         </div>
         <?php  
         }
         if($type ==3){
            $resul=$fac->readUserById($user);
           ?>
             <div class="col-sm-12">
             <h5 class="display-5" align="left">Pregunta de seguridad:</h5>
             <label for=""><?php echo $resul[0]['pregunta'];?></label> 
             <input type="hidden" class="form-control " name="id" value='<?php echo $user;?>' placeholder="Respuesta">
             <input type="hidden" class="form-control " name="tipo" value='<?php echo $type;?>' placeholder="Respuesta">
             <br>
             </div>
             <div class="col-sm-12">   
             <input type="password" class="form-control " id="answer" name="answer" placeholder="Respuesta" required>
             </div>
             <?php  
         }
    }
    ?>
  </div>
  <button type="submit" name="validarR" value="validarR" class="btn btn-success btn-lg btn-block" onclick="return validarAnswer();" >VALIDAR RESPUESTA</button>
<?php   
if(isset($_GET['error']) && $_GET['error']==1){
    ?><br>
    <p align="center" style="color:red;" >Error en la respuesta ingresada..</p>
    <?php
}
?>
</form>
    </div>
</div>
<script src="../js/login.js"></script>
</body>
</html>