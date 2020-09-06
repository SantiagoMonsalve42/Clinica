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
if(isset($_GET['idc']) && isset($_GET['idp'])){
$obj=new facade();
$resul=$obj->readUserById($_GET['idp']);
?>

<br>
<div class="container-fluid"> 

   <div class="row">
    <div class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-12"> 
  <div class="jumbotron">
<h1 class="display-5" align="center">ATENDER CITA</h1>
            <form action="../app/logic3.php" method="post">
            
   <div class="row">
            <div class="col-12 col-sm-12 col-xs-12 col-md-6 col-lg-6"> 
            <h4 align="left">Datos Personales:</h4>
            
            <div class="form-row">
               <div class="form-group col-md-12">
                 <input type="number" value="<?php echo $resul[0]['id_paciente']?>"  name="id" class="form-control" placeholder="Primer nombre" readonly>
               </div>
               </div>
               
               <div class="form-row">
               <div class="form-group col-md-12">
                 <input type="number" value="<?php echo $_GET['idc']?>"  name="idc" class="form-control" placeholder="Primer nombre" readonly>
               </div>
               </div>

            <div class="form-row">
               <div class="form-group col-md-12">
                 <input type="text" value="<?php echo $resul[0]['nombres']?>" id="pnombre" name="nombre" class="form-control" placeholder="Primer nombre" readonly>
               </div>
               </div>

              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="text" class="form-control" value="<?php echo $resul[0]['apellidos']?>" id="apellido" placeholder="Primer apellido" name="apellidos" readonly>
              </div>
              </div>

              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="text" class="form-control" value="<?php echo $resul[0]['correo']?>" id="apellido" placeholder="Primer apellido" name="correo" readonly>
              </div>
              </div>

              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="number" class="form-control" value="<?php echo $resul[0]['telefono']?>" name="telefono" min="3000000000" max="3999999999" placeholder="Telefono" readonly>
              </div>
              </div>
              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="date" class="form-control" value="<?php echo $resul[0]['fecha_nacimiento']?>" id="fechanacimiento" name="fechanacimiento" readonly>
              </div>
              </div>
              <div class="form-row">
              <div class="form-group col-md-12">
              <input type="text" class="form-control" value="<?php echo $resul[0]['sexo']?>" id="fechanacimiento" name="fechanacimiento" readonly>
              </div>
              </div>
              <?php  
              $resul1=$obj->readOneExpByIdPaciente($resul[0]['id_paciente']);
              $tam=count($resul1);
              if($tam > 0){
              ?>
              <a href="http://localhost/clinicafinal/pdf/generarPDF.php?idp=<?php echo $resul[0]['id_paciente'];?>" class="badge badge-primary">GENERAR HISTORIA CLINICA</a>
              <br><br>
              <?php 
              }
              $enfermedades=' ';
              $peso=0;
              $altura=0;
              $antecedentesp=' ';
              $alergias=' ';
              $antecedentesf=' ';
              $medicamentos=' ';
              for($i=0;$i<count($resul1);$i++){
                $peso=$resul1[$i]['peso'];
                $altura=$resul1[$i]['altura'];
                $enfermedades=$resul1[$i]['enfermedades'];
                $antecedentesp=$resul1[$i]['antecedentes_personales'];
                $alergias=$resul1[$i]['alergias'];
                $antecedentesf=$resul1[$i]['antecedentes_familiares'];
                $medicamentos=$resul1[$i]['medicamentos'];
              }
              
              
              
              ?>
              
              </div>
           
           

            <div class="col-12 col-sm-12 col-xs-12 col-md-6 col-lg-6">
            <h5 align="left">Datos de la consulta: </h5>
           
            <div class="form-row">
            <div class="form-group col-md-12">
            <input type="number" value="<?php if($peso != 0 )echo $peso; ?>" class="form-control" step="any" name="peso" placeholder="Peso" required>
            </div>
            </div>

            <div class="form-row">
            <div class="form-group col-md-12">
            <input type="number" value="<?php if($altura != 0 )echo $altura; ?>" class="form-control" step="any" name="altura" placeholder="Altura" required>
            </div>
            </div>

            <div class="form-row">
            <div class="form-group col-md-12" >
            <textarea class="form-control" id="descripcion" name="motivos" rows=3 placeholder="Motivos de Consulta" required></textarea>
            </div>
            </div>

            <div class="form-row">
            <div class="form-group col-md-12" >
            <textarea class="form-control" id="descripcion" name="enfermedades" rows=3 placeholder="Enfermedades"><?php if($enfermedades != ' ' )echo $enfermedades; ?></textarea>
            </div>
            </div>
            
            <div class="form-row">
            <div class="form-group col-md-12" >
            <textarea class="form-control" id="descripcion" name="antecedentesp" rows=3 placeholder="Antecedentes Personales" required><?php if($antecedentesp != ' ' )echo $antecedentesp; ?></textarea>
            </div>
            </div>
            
            <div class="form-row">
            <div class="form-group col-md-12" >
            <textarea class="form-control" id="descripcion" name="alergias" rows=3 placeholder="Alergias" required><?php if($alergias != ' ' )echo $alergias; ?></textarea>
            </div>
            </div>

            <div class="form-row">
            <div class="form-group col-md-12" >
            <textarea class="form-control" id="descripcion" name="antecedentesf" rows=3 placeholder="Antecedentes familiares" required><?php if($antecedentesf != ' ' )echo $antecedentesf; ?></textarea>
            </div>
            </div>

            <div class="form-row">
            <div class="form-group col-md-12" >
            <textarea class="form-control" id="descripcion" name="medicamentos" rows=3 placeholder="Medicamentos que toma actualmente" required><?php if($medicamentos != ' ' )echo $medicamentos; ?></textarea>
            </div>
            </div>

              <div align="center" id="error">
              </div>
              

            </div>
            <button type="submit" style="display: block; margin: 0 auto;" value="CREARH" name="CREARH" class="btn btn-success btn-lg btn-large" onclick="return validarInsertP();">FINALIZAR ATENCION</button>
         
            </form>
            
            </div>
         
            </div>
          
    </div>
    </div>
    <div class="jumbotron bg-transparent">
        </div></div>
    </div>
    <script src="../js/validacionesAdmin.js"></script>
<?php require '../footer.php';
}else{
    header("Location: http://localhost/clinicafinal/Medico/citas.php");
}?>
</body>
</html>
<?php }else{
echo "<script type='text/javascript'>
alert('ERROR!! al iniciar sesion');
window.location='../index.php';
</script>";
}?>

