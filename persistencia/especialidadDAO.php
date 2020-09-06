<?php

require_once("../class/conexion.php");
class especialidadDAO extends Conectar{
    private $especialidades;
    public function __construct(){
        $this->especialidades=array();
    }
    //Buscamos toda la informacion de la tabla especialidad
    public function readall(){  //read
        $sql="select * from especialidad";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->especialidades[]=$row;
        }
        return $this->especialidades;
    }
    //Buscamos especialidad por medio del id
    public function readOneById($id){
        $sql="select * from especialidad where id_especialidad=$id";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->especialidades[]=$row;
        }
        return $this->especialidades;
    }
    //Insertamos una nueva especialidad 
    public function insert($name,$description){ //create
        $sql="insert into especialidad(nombre,descripcion)values
        ('$name','$description')";
        $resul=mysqli_query($this->con(),$sql);
        if($resul==true){
            return true;
        }else{
            return false;
        }
    }
    //Eliminamos una especialidad
    public function delete($id){ //delete
        $sql="delete from especialidad where id_especialidad=$id";
        $resul=mysqli_query($this->con(),$sql);
        return $resul;
    }
    //Actualizamos especialidad
    public function update($id,$name,$description){//update
        $sql="update especialidad set nombre='$name', descripcion='$description' 
        where id_especialidad=$id";
        $resul=mysqli_query($this->con(),$sql);
        return $resul;
    }
    //especialidades disponibles 
    public function readAllEspecialidadDisponible(){
       $sql=" select * FROM especialidad where id_especialidad not in 
       (select id_especialidad from medico)";
       
       $resul=mysqli_query($this->con(),$sql);
       while($row=mysqli_fetch_assoc($resul)){
        $this->especialidades[]=$row;
    }
    return $this->especialidades;
    }

}

?>