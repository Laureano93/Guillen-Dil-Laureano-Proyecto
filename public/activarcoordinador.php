<?php
require_once '../src/coordinador.php';

$id=$_GET['id'];

$coordinador=new Coordinador();

$coordinador->setID($id);

$coordinador-> dardealta();
$coordinador=null;
