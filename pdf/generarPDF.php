<?php
session_start(); 
if($_SESSION['usuario']){
require 'fpdf/fpdf.php';
require '../persistencia/facade.php';
$id=$_GET['idp'];//id del paciente 
$objf=new facade();
//leemos datos personales y todos los registros de las citas que ha tenido
$datosd=$objf->readOneFullById($id);
$datosm=$objf->readOneExpByIdPaciente($id);
$peso;//ultimo peso de la ultima visita
$altura;//ultimo peso de la ultima visita
$motivos_consultas='';//ultimo peso de la ultima visita
$nconsul=count($datosm);//tamaño responsivo de las tablas
$enfermedades='';
$antecedentesp='';
$alergias='';
$antecedentesf='';
$medicamentos='';
for($i=0;$i<count($datosm);$i++){
    $j=$i+1;
    $peso=$datosm[$i]['peso'];
    $altura=$datosm[$i]['altura'];
    $motivos_consultas.=$j.". ".$datosm[$i]['motivo_consulta']." ";
    $enfermedades=$datosm[$i]['enfermedades'];
    $antecedentesp=$datosm[$i]['antecedentes_personales'];
    $alergias=$datosm[$i]['alergias'];
    $antecedentesf=$datosm[$i]['antecedentes_familiares'];
    $medicamentos=$datosm[$i]['medicamentos'];
}
class pdf extends FPDF{
  public function header(){
      
    $this->Image('http://localhost/clinicafinal/imagenes/hospital.png',15,8,30);
    // Arial bold 15
    $this->SetFont('Arial','B',20);
    $this->Cell(40);
    $this->Cell(160,15,'Historial Medico',1,1,'C');
    
    $this->SetFont('Arial','B',10);
    $this->Cell(40);
    $this->Cell(160,11,'Area de sistematizacion de datos Universidad Distrital FJC',1,0,'C');
    // Line break
    $this->Ln(20);
  }
  public function footer(){
     $this->SetFont('Courier','B',10);
     $this->setY(-15);
     $this->Write(5,'Universidad Distrital FJC, Apps de internet');
  }    
}
$fpdf =new pdf();
$fpdf->AddPage('portait','letter');
$fpdf->SetFont('Arial','B',14);

$fpdf->Cell(200,9,'INFORMACION PERSONAL',1,1,'C');

$fpdf->SetFont('Arial','B',10);
$fpdf->Cell(60,8,'NOMBRES',1,0,'L');
$fpdf->Cell(140,8,$datosd[0]['nombres'],1,1,'L');
$fpdf->Cell(60,8,'APELLIDOS',1,0,'L');
$fpdf->Cell(140,8,$datosd[0]['apellidos'],1,1,'L');
$fpdf->Cell(60,8,'FECHA DE NACIMIENTO:',1,0,'L');
$fpdf->Cell(140,8,$datosd[0]['fecha_nacimiento'],1,1,'L');
$fpdf->Cell(60,8,'SEXO:',1,0,'L');
$fpdf->Cell(140,8,$datosd[0]['sexo'],1,1,'L');
$fpdf->Cell(30,8,'TIPO DOC:',1,0,'L');
$fpdf->Cell(70,8,$datosd[0]['tipo_documento'],1,0,'L');
$fpdf->Cell(30,8,'# DOC:',1,0,'L');
$fpdf->Cell(70,8,$datosd[0]['id_paciente'],1,1,'L');
$fpdf->Cell(30,8,'TELEFONO:',1,0,'L');
$fpdf->Cell(70,8,$datosd[0]['telefono'],1,0,'L');
$fpdf->Cell(30,8,'CORREO:',1,0,'L');
$fpdf->Cell(70,8,$datosd[0]['correo'],1,1,'L');

$fpdf->SetFont('Arial','B',14);
$fpdf->Cell(200,9,'INFORMACION MEDICA',1,1,'C');

$fpdf->SetFont('Arial','B',10);
$fpdf->Cell(60,8,'PESO:',1,0,'L');
$fpdf->Cell(140,8,$peso." Kgs",1,1,'L');
$fpdf->Cell(60,8,'ALTURA:',1,0,'L');
$fpdf->Cell(140,8,$altura." Mts",1,1,'L');
$fil=$nconsul*6;
$fpdf->Cell(60,$fil,'MOTIVOS CONSULTAS:',1,0,'L');
$fpdf->MultiCell(140,$fil,$motivos_consultas,1);
$fpdf->Cell(60,$fil,'ENFERMEDADES:',1,0,'L');
$fpdf->MultiCell(140,$fil,$enfermedades,1);
$fpdf->Cell(60,$fil,'ANTECEDENTES PERSONALES:',1,0,'L');
$fpdf->MultiCell(140,$fil,$antecedentesp,1);
$fpdf->Cell(60,$fil,'ALERGIAS:',1,0,'L');
$fpdf->MultiCell(140,$fil,$alergias,1);
$fpdf->Cell(60,$fil,'ANTECEDENTES FAMILIARES:',1,0,'L');
$fpdf->MultiCell(140,$fil,$antecedentesf,1);
$fpdf->Cell(60,$fil,'MEDICAMENTOS:',1,0,'L');
$fpdf->MultiCell(140,$fil,$medicamentos,1);
$fpdf->Ln(20);
$fpdf->Cell(200,$fil,'_________________________________________',0,1,'R');
$fpdf->Cell(200,$fil,'Nom Doctor:                                                             ',0,1,'R');
$fpdf->Cell(200,$fil,'CC:                                                                            ',0,1,'R');


$fpdf->OutPut();
?>
<?php }else{
echo "<script type='text/javascript'>
alert('ERROR!! al iniciar sesion');
window.location='../index.php';
</script>";
}?>