<?php

require_once("../src/administrador.php");

$admin=new Administrador();


echo ($admin->cantidadIncidencias());

$admin=null;

?>

