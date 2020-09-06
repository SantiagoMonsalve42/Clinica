<?php

require_once("../class/conexion.php");
class pacienteDAO extends Conectar{
    private $pacientes;
    public function __construct(){
        $this->pacientes=array();
    }
    public function readall(){  //read
        $sql="select * from paciente";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->pacientes[]=$row;
        }
        return $this->pacientes;
    }
    //Leemos paciente por id o correo
    public function readOneById($id){
        if($id>0){
        $sql="select * from paciente where id_paciente=$id";
        $resul=mysqli_query($this->con(),$sql);
        }else{
            $sql="select * from paciente where correo='$id'";
            $resul=mysqli_query($this->con(),$sql); 
        }
        while($row=mysqli_fetch_assoc($resul)){
            $this->pacientes[]=$row;
        }
        return $this->pacientes;
    }
    //Leemmos la informacion de los pacientes con el tipo de doc
    public function readAllFull(){
        $sql="select * from paciente,tipo_doc 
        where paciente.tipo_documento=tipo_doc.id_documento";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->pacientes[]=$row;
        }
        return $this->pacientes;
    }
     //Leemmos la informacion de los pacientes con el tipo de doc by id
     public function readOneFullById($id){
        $sql="select * from paciente,tipo_doc 
        where paciente.tipo_documento=tipo_doc.id_documento and id_paciente=$id";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->pacientes[]=$row;
        }
        return $this->pacientes;
    }
    //Insertamos paciente 
    public function insert($id,$tipo,$nom,$ape,$tel,$fecha,$sex,$pass,$mail,$ask,$ans){ //create
        $sql="insert into paciente(id_paciente,tipo_documento,nombres,apellidos,telefono,fecha_nacimiento,sexo,clave,
        correo,pregunta,respuesta)values($id,$tipo,'$nom','$ape',$tel,
        '$fecha','$sex','$pass','$mail','$ask','$ans')";
        $resul=mysqli_query($this->con(),$sql);
        return $resul;
    }
    public function delete($id){ //delete
        $sql="delete from paciente where id_paciente=$id";
        $resul=mysqli_query($this->con(),$sql);
        return $resul;
    }
    
    //Actualizamos paciente
    public function updatePersonal($id,$nom,$ape,$tel,$fecha){//update
        $sql="update paciente set telefono=$tel,nombres='$nom',apellidos='$ape',
        fecha_nacimiento='$fecha' where id_paciente=$id";
        $resul=mysqli_query($this->con(),$sql);
        return $resul;
    } 
    //Actualizamos contraseña de paciente
    public function updatePass($id,$pass){//update
        $sql="update paciente set clave='$pass' where id_paciente=$id";
        $resul=mysqli_query($this->con(),$sql);
        return $resul;
    }
}
?>