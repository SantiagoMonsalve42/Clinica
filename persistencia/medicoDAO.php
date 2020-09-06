<?php

require_once("../class/conexion.php");
class medicoDAO extends Conectar{
    private $medicos;
    public function __construct(){
     $this->medicos=array();
    }
    public function readall(){//read
        $sql="select * from medico";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->medicos[]=$row;
        }
        return $this->medicos;
    }
    //Leemos datos de medico por id y correo
    public function readOneById($id){
        if($id>0){
            $sql="select * from medico where id_medico=$id";
            $resul=mysqli_query($this->con(),$sql);
        }else{
            $sql="select * from medico where correo='$id'";
            $resul=mysqli_query($this->con(),$sql);
        }
        while($row=mysqli_fetch_assoc($resul)){
            $this->medicos[]=$row;
        }
        return $this->medicos;
    }
    //Insertamos datos de un nuevo medico
    public function insert($id,$esp,$names,$apellidos,$tel,$fecha,$sexo,$pass,$mail,$ask,$ans){ //create
        $sql="insert into medico(id_medico,id_especialidad,nombres,apellidos,telefono,fecha_nacimiento,
        sexo,clave,correo,pregunta,respuesta)values
        ($id,$esp,'$names','$apellidos',$tel,'$fecha','$sexo','$pass','$mail','$ask','$ans')";
        $resul=mysqli_query($this->con(),$sql);
        if($resul==true){
            return true;
        }else{
            return false;
        }
    }
    //eleminamos datos de un medico
    public function delete($id){ //delete
        $sql="delete from medico where id_medico=$id";
        $resul=mysqli_query($this->con(),$sql);
        return $resul;
    }
    //Actualizamos datos de un medico
    public function updatePersonal($id,$names,$apellidos,$fecha,$tel){//update
        $sql="update medico set nombres='$names',apellidos='$apellidos',
        telefono=$tel,fecha_nacimiento='$fecha' where id_medico=$id";
        $resul=mysqli_query($this->con(),$sql);
        if($resul==true){
            return true;
        }else{
            return false;
        }
    }
    //update telefono by id
    public function updateTel($id,$tel){
        $sql="update medico set telefono= $tel where id_medico=$id";
        $resul=mysqli_query($this->con(),$sql);
        return $resul;
    }
    //Actualizamos contraseña de un medico
    public function updatePass($id,$pass){//update
        $sql="update medico set clave='$pass' where id_medico=$id";
        $resul=mysqli_query($this->con(),$sql);
       return $resul;
    }
    //Leemos la tabla medicos con la especialidad de cada uno
    public function readMedicoEspecialidad(){
        $sql= "select * from medico natural join especialidad";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->medicos[]=$row;
        }
        return $this->medicos;
    }
    //Leemos la informacion de un medico junto con su especialidad
    public function readOneMedicoEspecialidad($id){
        $sql="select * from especialidad natural join medico where id_medico=$id";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->medicos[]=$row;
        }
        return $this->medicos;
    }
}
?>