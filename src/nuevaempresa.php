<?php

require_once("./externa.php");

$empresa=new Externa();

$empresa->setNombre($_POST['nombre']);
$empresa->setApellidos($_POST['apellido1'],$_POST['apellido2']);
$empresa->setEmail($_POST['email']);

$empresa->create();