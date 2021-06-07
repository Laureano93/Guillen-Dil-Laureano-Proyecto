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

    $coord = new Coordinador();

    $lista = $coord->read();

  $coord=null;

}


 while(($fila=$lista->fetch(PDO::FETCH_OBJ))!=null){

        if($fila->Fecha_baja!=null){
          
            $fila->Fecha_ingreso="Usuario dado de baja";

            $fila->acciones='<a id="editar" class="editar" onclick="editarCoordinador(this)"><i class="fas fa-user-edit"></i></a>   <a id="borrar" class="editar" onclick="activarCoordinador(this)"><i class="fas fa-user-plus"></i></a>';

        }else{

            $fila->acciones='<a id="editar" class="editar" onclick="editarCoordinador(this)"><i class="fas fa-user-edit"></i></a>   <a id="borrar" class="editar" onclick="borrarCoordinador(this)"><i class="fas fa-user-minus"></i></a>';

        }

    $data['data'][] = $fila;
        
    
     }
    
     
echo json_encode($data);