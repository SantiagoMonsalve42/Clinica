<?php

require_once("../class/conexion.php");
class historiaDAO extends Conectar{
    private $historias;
    public function __construct(){
        $this->historias=array();
    }
    //Leemos todas las historias medicas
    public function readall(){  //read
        $sql="select * from historia_medica";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->historias[]=$row;
        }
        return $this->historias;
    }
    //Buscamos una historia por idHistoria
    public function readOneById($id){
        $sql="select * from historia_medica where id_historia=$id";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->historias[]=$row;
        }
        return $this->historias;
    }
    //Buscamos una historia por idPaciente
    public function readOneByIdPaciente($id){
        $sql="select * from historia_medica where id_paciente=$id";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->historias[]=$row;
        }
        return $this->historias;
    }
     //Insertamos una historia
    public function insert($id,$peso,$altura,$moti,$enfe,$antep,$alerg,$antef,$med){ //create
        $sql="insert into historia_medica(id_paciente,peso,altura,motivo_consulta,
        enfermedades,antecedentes_personales,alergias,antecedentes_familiares,medicamentos)values
        ($id,$peso,$altura,'$moti','$enfe','$antep','$alerg','$antef','$med')";
        $resul=mysqli_query($this->con(),$sql);
        return $resul;
    }
    //Eliminamos historia medica por el idHistoria
    public function delete($id){ //delete
        $sql="delete from historia_medica where id_historia=$id";
        $resul=mysqli_query($this->con(),$sql);
        return $resul;
    }
    //Eliminamos historia medica por idPaciente
    public function deleteForUser($id){ //delete
        $sql="delete from historia_medica where id_paciente=$id";
        $resul=mysqli_query($this->con(),$sql);
        return $resul;
    }
    //Actualizando todos los datos de una historia medica
    public function updateAll($id,$idp,$peso,$altura,$moti,$enfe,$antep,$alerg,$antef,$med){
        $sql="update historia_medica set id_paciente=$idp, peso=$peso,altura=$altura,
        motivo_consulta=$moti,enfermedades=$enfe,antecedentes_personales=$antep,alergias=$alerg,
        antecedentes_familiares=$antef,medicamento=$med,
        where id_historia=$id";
        $resul=mysqli_query($this->con(),$sql);
        return $resul;
    }
}
?>