<?php

require_once("profesor.php");
require_once("coordinador.php");

$prof=new Profesor();
$coord=new Coordinador();


if(isset($_POST['coordinador'])){

    $prof->setIdCoordinador($_POST['coordinador']);
    $prof->setDni($_POST['dni']);
    $prof->setNombre($_POST['nombre']);
    $prof->setApellidos($_POST['apellido1'],$_POST['apellido2']);
    $prof->setContraseña(md5($_POST['pass']));
    $prof->setEmail($_POST['email']);
    $prof->create("");


}else{


    if(isset($_GET['coord'])){

    $coord->setDni($_GET['dni']);
    $coord->setNombre($_GET['nombre']);
    $coord->setApellidos($_GET['apellido1'],$_GET['apellido2']);
    $coord->setEmail($_GET['email']);
    $coord->setContraseña($_GET['pass']);
    $coord->create();

      

    }else{
   
    $prof->setIdcoordinador($_GET['iddestino']);
    $prof->setDni($_GET['dni']);
    $prof->setNombre($_GET['nombre']);
    $prof->setApellidos($_GET['apellido1'],$_GET['apellido2']);
    $prof->setEmail($_GET['email']);
    $prof->setContraseña($_GET['pass']);
    $prof->create($_GET['usuario']);

    }

}


