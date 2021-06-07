<?php

require_once '../src/incidencias.php';

$id=$_GET['id'];

$incidencia=new Incidencia();

$incidencia->setID($id);

$incidencia->solucionar();

$incidencia=null;