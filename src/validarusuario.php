<?php


require_once("sesion.php");


$accion= $_POST['accion'];

$sesion = new Sesion();


   
   if($accion=="validar"){

    $sesion->setEmail($_POST['email']);


    $sesion->setPass($_POST['pass']);

    $sesion->setTipo($_POST['tipo']);

    $sesion->validaUsuario();
      

   }else{

    $sesion->setDni($_POST['dni']); 
    $sesion->setNombre($_POST['nombre']);
    $sesion->setApellidos($_POST['apellido1'],$_POST['apellido2']);
    $sesion->setEmail($_POST['email']);
    $sesion->setPass($_POST['pass1']);
    $sesion->enviarRegistro();

   }
    
  

  
    







