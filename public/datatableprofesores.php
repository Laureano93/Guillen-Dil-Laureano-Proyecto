<?php

require_once("../src/coordinador.php");

require_once("../src/profesor.php");

$body = json_decode(file_get_contents("php://input"), true);

$id=$_POST['id'];
$tipo=$_POST['tipo'];

$data=array();

if($tipo=="coordinador"){

    $coordinador=new Coordinador();

        $lista=$coordinador->listaprofesorCoordinador($id);

    
    $coordinador=null;

}else{

$profesor=new Profesor();

$lista=$profesor-> read();

$profesor=null;

}


 while(($fila=$lista->fetch(PDO::FETCH_OBJ))!=null){


    $data['data'][] = $fila;
        
    
     }

     
     
echo json_encode($data);
