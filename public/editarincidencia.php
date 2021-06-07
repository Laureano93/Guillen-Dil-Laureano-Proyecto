<?php

require_once '../src/incidencias.php';

$id=$_GET['id'];
$aula=$_GET['aula'];
$clase=$_GET['clase'];
$problema=$_GET['problema'];
$estado=$_GET['estado'];


    $incidencia=new Incidencia();

    $incidencia->setID($id);
    $incidencia->setNaula($aula);
    $incidencia->setClase($clase);
    $incidencia-> setProblema($problema);
    $incidencia->setSolucionado($estado);

    $incidencia->editar();

    $incidencia=null;
