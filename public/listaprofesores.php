<?php


require_once("../src/coordinador.php");

require_once("../src/profesor.php");

$body = json_decode(file_get_contents("php://input"), true);

$id=(isset($_POST['id']))?$_POST['id']:$_GET['id'];
$tipo=(isset($_POST['tipo']))?$_POST['tipo']:$_GET['tipo'];



if($tipo=="coordinador"){

    $coordinador=new Coordinador();

        $lista=$coordinador->listaprofesorCoordinador($id);

    
    $coordinador=null;

}else{

$profesor=new Profesor();

$lista=$profesor->listaInicio();

$profesor=null;

}


 while(($fila=$lista->fetch(PDO::FETCH_OBJ))!=null){

    ?>

         <div class="card-body">
                                 <div class="customer">                                
                                     <div class="info">
                                         <div>
                                             <h4><?php echo $fila->Nombre . " " .$fila->Apellidos ?></h4>
                                             <small>Profesor</small>
                                         </div>
                                     </div>
                                     <div class="contact">
                                         <span class="las la-user-circle"></span>
                                     </div>
                                 </div>
                             </div>
    
      <?php
    
     }
    
     ?>  




