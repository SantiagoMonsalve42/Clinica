<?php

require_once("../class/conexion.php");
class tipodocDAO extends Conectar{
    private $tipos;
    public function __construct(){
        $this->tipos=array();
    }
    public function readall(){  //read
        $sql="select * from tipo_doc";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->tipos[]=$row;
        }
        return $this->tipos;
    }
    public function readOneById($id){
        $sql="select * from tipo_doc where id_documento=$id";
        $resul=mysqli_query($this->con(),$sql);
        while($row=mysqli_fetch_assoc($resul)){
            $this->tipos[]=$row;
        }
        return $this->tipos;
    }
    public function insert($name){ //create
        $sql="insert into tipo_doc(tipo_documento)values
        ('$name')";
        $resul=mysqli_query($this->con(),$sql);
        if($resul==true){
            return true;
        }else{
            return false;
        }
    }
    public function delete($id){ //delete
        $sql="delete from tipo_doc where id_documento$id";
        $resul=mysqli_query($this->con(),$sql);
        if($resul==true){
            return true;
        }else{
            return false;
        }
    }
    
    public function update($id,$name){//update
        $sql="update tipo_doc set tipo_documento=$name
        where id_documento=$id";
        $resul=mysqli_query($this->con(),$sql);
        if($resul==true){
            return true;
        }else{
            return false;
        }
    }

}
?>