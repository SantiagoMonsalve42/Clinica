<?php

require 'facade.php';
$objH=new facade();  
$r=$objH->encriptarClave('Pass123');
echo $r;
?>