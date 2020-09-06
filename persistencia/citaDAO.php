<?php

require_once("../class/conexion.php");
class citaDAO extends Conectar{
    private $citas;
    public function __construct(){
        $this->citas=array();
    }
    //Miramos todas las citas agendadas
    public function readall(){  //read
        $sql="select * from cita order by fecha";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->citas[]=$row;
        }
        return $this->citas;
    }
    //Buscamos cita por medio del id
    public function readOneById($id){
        $sql="select * from cita where id_cita=$id";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->citas[]=$row;
        }
        return $this->citas;
    }
    //Buscamos citas agendadas para tal medico
    public function readOneByMedico($id){
        $sql="select * from cita where id_medico=$id";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->citas[]=$row;
        }
        return $this->citas;
    }
    //leer citas para modulo de busqueda
    public function readDatesToSearchById($id){
        $sql="select * from cita where id_medico=$id 
        or id_paciente=$id or id_cita=$id";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->citas[]=$row;
        }
        return $this->citas;
    }
    public function readOneByMedicoInOrden($id,$fecha){
        $sql="select * from cita where id_medico=$id and fecha >= '$fecha' and estado ='activo' order by fecha,hora_i";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->citas[]=$row;
        }
        return $this->citas;
    }
    public function readOneByMedicoAnteriores($id,$fecha){
        $sql="select * from cita where id_medico=$id and fecha <= '$fecha' and estado ='inactivo' order by fecha,hora_i";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->citas[]=$row;
        }
        return $this->citas;
    }
    public function readOneByPacienteInOrden($id,$fecha){
        $sql="select * from cita where id_paciente=$id and fecha >= '$fecha' and estado ='activo' order by fecha,hora_i";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->citas[]=$row;
        }
        return $this->citas;
    }
    //Buscamos citas por fecha
    public function readOneByDate($id){
        $sql="select * from cita where fecha=$id";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->citas[]=$row;
        }
        return $this->citas;
    }
    //Buscamos citas por parciente
    public function readOneByPaciente($id){
        $sql="select * from cita where id_paciente=$id";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->citas[]=$row;
        }
        return $this->citas;
    }
    //Asignamos una nueva cita
    public function insert($pacie,$medico,$fecha,$dia,$hora,$estado){ //create
        $sql="insert into cita(id_paciente,id_medico,fecha,dia_semana,hora_i,estado)values
        ($pacie,$medico,'$fecha','$dia',$hora,'$estado')";
        $resul=mysqli_query($this->con(),$sql);
        return $resul;
    }
    //Borramos cita buscando por id de cita
    public function delete($id){ //delete
        $sql="delete from cita where id_cita=$id";
        $resul=mysqli_query($this->con(),$sql);
        return $resul;
    }
    //Eliminamos cita buscando por medico
    public function deleteByMedic($id){ //delete
        $sql="delete from cita where id_medico=$id";
        $resul=mysqli_query($this->con(),$sql);
       return $resul;
    }
    //Eliminando cita buscando por paciente
    public function deleteByUser($id){ //delete
        $sql="delete from cita where id_paciente=$id";
        $resul=mysqli_query($this->con(),$sql);
       return $resul;
    }
    //Acutalizamos estado de cita buscando por id de cita
    public function updateStatusInactive($id){//update
        $sql="update cita set estado='inactivo' 
        where id_cita=$id";
        $resul=mysqli_query($this->con(),$sql);
        return $resul;
    }
    //Actualizamos la fecha de la cita
    public function updateDate($id,$fecha,$dia,$hora){//update
        $sql="update cita set fecha='$fecha',hora_i=$hora,dia_semana='$dia'
        where id_cita=$id";
        $resul=mysqli_query($this->con(),$sql);
        return $resul;
    }
    //validamos la disponibilidad del medico
    //enviando las citas que tiene en la respectiva fecha
    public function validarDisponibilidadMedicoTiempo($idm,$hora,$fecha){
    $sql="select * from cita where id_medico=$idm and hora_i=$hora and fecha='$fecha'";
    $resul=mysqli_query($this->con(),$sql);
    while($row=mysqli_fetch_assoc($resul)){
    $this->citas[]=$row;
    }
    return $this->citas;
    }

    public function validar_numero_citasxdia($idm,$fecha){
    $sql="select * from cita where id_medico=$idm and fecha='$fecha'";
    $resul=mysqli_query($this->con(),$sql);
    while($row=mysqli_fetch_assoc($resul)){
    $this->citas[]=$row;
    }
    return $this->citas;
    }
}
?>