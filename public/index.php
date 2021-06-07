<?php

session_start();

if(isset($_GET['aviso'])){

$_SESSION['aviso']=$_GET['aviso'];

}

if(isset($_GET['error'])){

  $_SESSION['error']=$_GET['error'];
  
  }

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
  <title>Inicio De Sesion</title>


</head>

<body>

  <div class="inicio">

    <h2 class="inicio-cabezera">Bienvenido</h2>

    <input type="hidden" id="error" value="<?php if (isset($_SESSION['error'])) {
                                              echo $_SESSION['error'];
                                              unset($_SESSION['error']);
                                            } else {
                                              echo "";
                                            } ?>">
    <input type="hidden" id="aviso" value="<?php if (isset($_SESSION['aviso'])) {
                                              echo $_SESSION['aviso'];
                                              unset($_SESSION['aviso']);
                                            } else {
                                              echo "";
                                            } ?>">

    <form class="inicio-campos" action="../src/validarusuario.php" method="POST">
      
      <p><input type="email" class="campos" id="Email" name="email" placeholder="Escriba su email" required /></p>
      <p><input type="password" class="campos" id="Pass" name="pass" placeholder="Escriba su contraseña"
      pattern=".{6,6}"
      title="Contraseña debe tener 6 caracteres" required><i class="fas fa-times"></i></p>
      <input type="hidden" name="accion" value="validar">
      <div>
        <input type="radio" class="ra" name="tipo" value="administrador">Administrador
        <input type="radio" class="ra" name="tipo" value="profesor" required="required"> Profesor
        <input type="radio" class="ra" name="tipo" value="coordinador"> Coordinador

      </div>
      <p><input type="submit" id="iniciar" value="Iniciar"></p>
      <p><a href="#m1">Registrese</a></p>
    </form>

    <div id="m1" class="modal1">
      <div class="contenido1">
        <a href="#close" title="Close" class="close">X</a>
        <h2 style="text-align:center;">Registrar</h2>
        <form class="registro-campos" action="../src/validarusuario.php" method="POST">
          <p><input type="text" class="campos" id="Dni" name="dni" placeholder="Escriba su dni" /><i class="fas fa-times"></i></p>
          <span class="oculto" id="mensaje2">Dni Debe llevar 8 numeros  una letra mayuscula</span>
          <p><input type="text" class="campos" id="Nombre" name="nombre" placeholder="Escriba su nombre" /><i class="fas fa-times"></i></p>
          <span class="oculto" id="mensaje3">Nombre sin numeros,signos, mayor de 4 y menor de 14 caracteres</span>
          <p><input type="text" class="campos" id="Apellido1" name="apellido1" placeholder="Escriba su apellido" /><i class="fas fa-times"></i></p>
          <span class="oculto" id="mensaje5">Apellido 1 sin numeros,signos, mayor de 4 y menor de 14 caracteres</span>
          <p><input type="text" class="campos" id="Apellido2" name="apellido2" placeholder="Escriba su apellido" /><i class="fas fa-times"></i></p>
          <span class="oculto" id="mensaje6">Apellido 2 sin numeros,signos, mayor de 4 y menor de 14 caracteres</span>
          <p><input type="password" class="campos" id="Pass1" name="pass1" placeholder="Escriba su contraseña" /><i class="fas fa-times"></i></p>
          <span class="oculto" id="mensaje4">Contraseña debe tener 6 caracteres</span>
          <p><input type="email" class="campos" id="Email" name="email" placeholder="Escriba su email" required /></p>
          <input type="hidden" name="accion" value="registrar">
          <p><input type="submit" id="registrar" value="Registrar"></p>
        </form>

      </div>
    </div>




  </div>
  <script type="text/javascript" src="../js/sesion.js"></script>
</body>

</html>