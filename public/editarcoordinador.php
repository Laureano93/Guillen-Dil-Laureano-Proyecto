<?php

require_once '../src/coordinador.php';

$id=$_GET['id'];
$nombre=$_GET['nombre'];
$apellidos=explode(" ",$_GET['apellidos']);
$ape1=$apellidos[0];
$ape2=$apellidos[1];
$email=$_GET['email'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)|| 
!preg_match("/^(?=.{3,14}$)[a-zñA-ZÑ]*$/",$nombre)||
!preg_match("/^(?=.{3,14}$)[a-zñA-ZÑ]*$/",$ape1)||
!preg_match("/^(?=.{3,14}$)[a-zñA-ZÑ]*$/",$ape2)
 ) {
  echo "formatos no validos";
}else{

    $coordinador=new Coordinador();

    $coordinador->setID($id);
    $coordinador->setNombre($nombre);
    $coordinador->setApellidos($ape1,$ape2);
    $coordinador->setEmail($email);


    $coordinador->editar();

    $coordinador=null;
}