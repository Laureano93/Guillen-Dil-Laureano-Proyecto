<?php

require_once("../src/incidencias.php");

$incidencia=new Incidencia();

$lista=null;


$id=(isset($_POST['id']))?$_POST['id']:$_GET['id'];

$tipo=(isset($_POST['tipo']))?$_POST['tipo']:$_GET['tipo'];




    $lista=$incidencia->read();
      

$incidencia=null;


while(($fila=$lista->fetch(PDO::FETCH_OBJ))!=null){

    ?>

         <tr>
         
         <td><?php echo $fila->Naula?></td>
         <td><?php echo $fila->Clase?></td>
         <td><textarea cols="26" rows="2" readonly><?php echo $fila->Problema?></textarea></td>
         
         </tr>
    
      <?php
    
     }
    
     ?> 