<?php

require_once("../src/externa.php");


$data = array();

$externa = new Externa();

$lista = $externa->read();



$externa = null;



while (($fila = $lista->fetch(PDO::FETCH_OBJ)) != null) {



    $fila->acciones = '<a id="borrar" class="editar" onclick="borrarEmpresa(this)"><i class="fas fa-user-times"></i></a>';



    $data['data'][] = $fila;
}


echo json_encode($data);
