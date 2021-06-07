<?php

require_once '../src/profesor.php';

$id=$_GET['id'];
$nombre=$_GET['nombre'];
$apellidos=explode(" ",$_GET['apellidos']);
$ape1=$apellidos[0];
$ape2=$apellidos[1];
$email=$_GET['email'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || 
!preg_match("/^(?=.{4,14}$)[a-zñA-ZÑ]*$/",$nombre) ||
!preg_match("/^(?=.{4,14}$)[a-zñA-ZÑ]*$/",$ape1) ||
!preg_match("/^(?=.{4,14}$)[a-zñA-ZÑ]*$/",$ape2)
 ) {
  echo "formatos no validos";
}else{

    $profesor=new Profesor();

    $profesor->setID($id);
    $profesor->setNombre($nombre);
    $profesor->setApellidos($ape1,$ape2);
    $profesor->setEmail($email);

    $profesor->editar();

    $profesor=null;
}


