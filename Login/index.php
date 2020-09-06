<!DOCTYPE html>
<html lang="en">
<head>
<!-- Login usuario -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    
</head>
<body>

<?php include '../header.php';?>
    <header>
    <br><br>
    </header>
    <div class="container">
    
    <div class="row">
    <div class="col-3">
    </div>
    <div class="col-6">
    <h1 class="display-3" align="center">LOGIN</h1>
    <form id="form" action="../app/validarlogin.php" method="post">
    <div class="form-group">

    <input class="form-control " type="text" name="user" id="user" placeholder="Ingrese id o correo" >
    </div>
    <div class="form-group">
    <input class="form-control " type="password" name="pass" id="pass" placeholder="Ingrese contraseña" >
    </div>
    <input class="btn btn-success btn-lg btn-block" type="submit" onclick="return enviarLogin();" value="Iniciar Sesion"><br>
    <div align="center" id="error">
    </div>
    <div style="text-align:center"> 
    <a href="./recuperar.php"> <button type="button"  class="btn btn-outline-dark">¿Olvido su contraseña?</button></a>
    </div>
    </form>
    </div>
    </div>
    </div>
    
    <script src="../js/login.js"></script>
    <?php include '../footer.php';?>
</body>
</html>

