<?php

require_once("../src/externa.php");

$id=$_GET['id'];

$externa=new Externa();

$externa->setID($id);

$externa->delete();

$externa=null;