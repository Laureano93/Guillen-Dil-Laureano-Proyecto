<?php

//Clase que accede a toda la informacion del sistema
require_once("conexion.php");

class Administrador extends Conexion{

   private $id;
   private $nombre;
   private $pass;
   

   public function __construct()
   {
      parent::__construct();
   }

   /**
    * Get the value of id
    */ 
   public function getId()
   {
      return $this->id;
   }

   /**
    * Set the value of id
    *
    * @return  self
    */ 
   private function setId($id)
   {
      $this->id = $id;

      return $this;
   }

   /**
    * Get the value of nombre
    */ 
   public function getNombre()
   {
      return $this->nombre;
   }

   /**
    * Set the value of nombre
    *
    * @return  self
    */ 
   private function setNombre($nombre)
   {
      $this->nombre = $nombre;

      return $this;
   }

   /**
    * Get the value of pass
    */ 
   public function getPass()
   {
      return $this->pass;
   }

   /**
    * Set the value of pass
    *
    * @return  self
    */ 
   private function setPass($pass)
   {
      $this->pass = $pass;

      return $this;
   }

   public function cantidadProfesores(){

      $consulta = "SELECT count(*) as cantidad FROM profesor";

      $ejecutar = parent::$conexion->prepare($consulta);

      $ejecutar->execute();

      $resultado=$ejecutar->fetch(PDO::FETCH_OBJ);

      
      return $resultado->cantidad;


   }


   public function cantidadCoordinadores(){

        
      $consulta = "SELECT count(*) as cantidad FROM coordinador";

      $ejecutar = parent::$conexion->prepare($consulta);

      $ejecutar->execute();

      $resultado=$ejecutar->fetch(PDO::FETCH_OBJ);

      
      return $resultado->cantidad;


   }



   public function numeroAdmin(){

      $consulta = "SELECT count(*) as cantidad FROM usuariosadmin";

      $ejecutar = parent::$conexion->prepare($consulta);

      $ejecutar->execute();

      $resultado=$ejecutar->fetch(PDO::FETCH_OBJ);

      
      return $resultado->cantidad;

   }

   public function cantidadIncidencias(){

    
      $consulta = "SELECT count(*) as cantidad FROM incidencia";

      $ejecutar = parent::$conexion->prepare($consulta);

      $ejecutar->execute();

      $resultado=$ejecutar->fetch(PDO::FETCH_OBJ);

      
      return $resultado->cantidad;


   }

   public function  listarProfesores(){
      

      
      $consulta = "SELECT * FROM profesor ORDER BY Nombre DESC";

      $ejecutar = parent::$conexion->prepare($consulta);

      $ejecutar->execute();

      
      return $ejecutar;


   }

   
}