<?php
class Conectar{

public static function con(){
    $link=mysqli_connect('localhost','root','123456');
    mysqli_query($link,"SET NAMES 'utf8'");
    mysqli_select_db($link,'clinica_1');
    return $link;
}

}
?>