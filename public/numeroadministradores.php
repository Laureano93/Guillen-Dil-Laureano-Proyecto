<?php

require_once("../src/administrador.php");

$admin=new Administrador();


echo ($admin->numeroAdmin());

$admin=null;


?>