<?php

require_once("../class/conexion.php");
class admonDAO extends Conectar{
    private $admons;
    public function __construct(){
        $this->admons=array();
    }
    public function readall(){  //read
        $sql="select * from admon";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->admons[]=$row;
        }
        return $this->admons;
    }
    public function readOneById($id){
        if($id>0){
            $sql="select * from admon where id_admon=$id";
            $resul=mysqli_query($this->con(),$sql);
        }else{
         
            $sql="select * from admon where correo='$id'";
            $resul=mysqli_query($this->con(),$sql);
        
        }
        while($row=mysqli_fetch_assoc($resul)){
            $this->admons[]=$row;
        }
        return $this->admons;
    }
    public function insert($mail,$pass,$ask,$ans){ //create
        $sql="insert into admon(correo,clave,pregunta,descripcion)values
        ('$mail','$pass','$ask','$ans')";
        $resul=mysqli_query($this->con(),$sql);
        if($resul==true){
            return true;
        }else{
            return false;
        }
    }
    public function delete($id){ //delete
        $sql="delete from admon where id_admon=$id";
        $resul=mysqli_query($this->con(),$sql);
        if($resul==true){
            return true;
        }else{
            return false;
        }
    }
    
    public function updatePass($id,$pass){//update
        $sql="update admon set clave='$pass'
        where id_admon=$id";
        $resul=mysqli_query($this->con(),$sql);
       return $resul;
    }
}
?>