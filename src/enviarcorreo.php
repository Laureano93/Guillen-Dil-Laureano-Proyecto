<?php

require_once("./externa.php");

$empresa=new Externa();

$email=$_POST['externo'];
$naula=$_POST['aula'];
$clase=$_POST['clase'];
$problema=$_POST['problema'];
$idin=$_POST['id'];
$coordinador=$_POST['coordinador'];

$empresa->setEmail($email);

$empresa->enviarMensaje($naula,$clase,$problema,$idin,$coordinador);
