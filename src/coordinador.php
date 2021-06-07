<?php

//Clase que accede a toda la informacion del sistema
require_once("conexion.php");

class Coordinador extends Conexion
{

   private $id;
   private $dni;
   private $nombre;
   private $apellidos;
   private $contraseña;
   private $email;
   private $fechaingreso;
   private $fechabaja;


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
   public function setId($id)
   {
      $this->id = $id;

      return $this;
   }

   /**
    * Get the value of dni
    */
   public function getDni()
   {
      return $this->dni;
   }

   /**
    * Set the value of dni
    *
    * @return  self
    */
   public function setDni($dni)
   {
      $this->dni = $dni;

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
   public function setNombre($nombre)
   {
      $this->nombre = $nombre;

      return $this;
   }

   /**
    * Get the value of apellidos
    */
   public function getApellidos()
   {
      return $this->apellidos;
   }

   /**
    * Set the value of apellidos
    *
    * @return  self
    */
   public function setApellidos($apellido1, $apellido2)
   {
      $this->apellidos = $apellido1 . " " . $apellido2;

      return $this;
   }

   /**
    * Get the value of contraseña
    */
   public function getContraseña()
   {
      return $this->contraseña;
   }

   /**
    * Set the value of contraseña
    *
    * @return  self
    */
   public function setContraseña($contraseña)
   {
      $this->contraseña = $contraseña;

      return $this;
   }

   /**
    * Get the value of email
    */
   public function getEmail()
   {
      return $this->email;
   }

   /**
    * Set the value of email
    *
    * @return  self
    */
   public function setEmail($email)
   {
      $this->email = $email;

      return $this;
   }

   /**
    * Get the value of idCoordinador
    */

   /**
    * Get the value of fechaingreso
    */
   public function getFechaingreso()
   {
      return $this->fechaingreso;
   }

   /**
    * Set the value of fechaingreso
    *
    * @return  self
    */
   public function setFechaingreso($fechaingreso)
   {
      $this->fechaingreso = $fechaingreso;

      return $this;
   }

   /**
    * Get the value of fechabaja
    */
   public function getFechabaja()
   {
      return $this->fechabaja;
   }

   /**
    * Set the value of fechabaja
    *
    * @return  self
    */
   public function setFechabaja($fechabaja)
   {
      $this->fechabaja = $fechabaja;

      return $this;
   }


   public function read()
   {

      $consulta = "SELECT * FROM coordinador";

      $ejecutar = parent::$conexion->prepare($consulta);

      try {

         $ejecutar->execute();
      } catch (PDOException $ex) {
         echo "No se puede leer los coordinadores " + $ex->getMessage();
      }



      return $ejecutar;
   }

   public function create(){

      $hoy=date('Y-m-d', time());

      $consulta="INSERT INTO coordinador(Dni,Nombre,Apellidos,email,passcoordinador,Fecha_ingreso)VALUES(:d,:n,:a,:e,:p,:f)";
        $array=[':d'=>$this->getDni(),':n'=>$this->getNombre(),':a'=>$this->getApellidos(),':e'=>$this->getEmail(),':p'=>$this->getContraseña(),':f'=>$hoy];
        

        if($this->comprobar("Dni",$this->getDni()) && $this->comprobar("email",$this->getEmail())){


         $ejecutar=parent::$conexion->prepare($consulta);


        }else{

            header("Location: ../public/index.php?error=El coordinador ya ha sido agregado");

        }
       


        try{

             $ejecutar->execute($array);


        }catch(PDOException $ex){echo "No se puede añadir al coordinador " .  $ex->getMessage(); }
        
        header("Location: ../public/index.php?aviso=Coordinador Agregado");

   }


   public function comprobar($campo,$valor){
         
      $consulta="SELECT count(*) as coincidir FROM coordinador WHERE $campo"."=".$valor;

      $ejecutar=parent::$conexion->prepare($consulta);

      try{

          $ejecutar->execute();


     }catch(PDOException $ex){echo "No se puede realizar la busqueda " .  $ex->getMessage(); }


     $coincidencia=$ejecutar->fetch(PDO::FETCH_OBJ);

     if($coincidencia->coincidir==0){

              return true;
     }else{

        return false;
      
     }

        

  }




   public function profesorCoordinador($id)
   {

      $consulta = "SELECT * FROM profesor WHERE idcoordinador=$id ORDER BY idcoordinador desc LIMIT 6";

      $ejecutar = parent::$conexion->prepare($consulta);

      try {

         $ejecutar->execute();
      } catch (PDOException $ex) {
         echo "No se puede consultar " . $ex->getMessage();
      }


      return $ejecutar;
   }


   public function listaprofesorCoordinador($id)
   {

      $consulta = "SELECT * FROM profesor WHERE idcoordinador=$id";

      $ejecutar = parent::$conexion->prepare($consulta);

      try {

         $ejecutar->execute();
      } catch (PDOException $ex) {
         echo "No se puede consultar la lista reducida " . $ex->getMessage();
      }


      return $ejecutar;
   }

   public function editar()
   {

      $consulta = "UPDATE coordinador SET Nombre=" ."'".$this->getNombre()."'".",Apellidos="."'".$this->getApellidos()."'" .",email=" ."'". $this->getEmail() ."'" ."WHERE id_coordinador=".$this->getId();
      $ejecutar = parent::$conexion->prepare($consulta);

      try {

         $ejecutar->execute();
      } catch (PDOException $ex) {
         echo "error al actualizar el coordinador" . $ex->getMessage();
      }

      return true;
   }

   public function dardebaja(){

      $hoy=date('Y-m-d', time());

      $consulta = "UPDATE coordinador SET Fecha_baja=". "'" . $hoy . "'". "WHERE id_coordinador=" . $this->getId();
      $ejecutar = parent::$conexion->prepare($consulta);

      try {

         $ejecutar->execute();
      } catch (PDOException $ex) {
         echo "error al dar de baja el coordinador" . $ex->getMessage();
      }

      return true;

   }

   public function dardealta(){

      $hoy=date('Y-m-d', time());

      $consulta = "UPDATE coordinador SET Fecha_ingreso=". "'" . $hoy . "'". ",Fecha_baja=null WHERE id_coordinador=" . $this->getId();
      $ejecutar = parent::$conexion->prepare($consulta);

      try {

         $ejecutar->execute();
      } catch (PDOException $ex) {
         echo "error al dar de alta el coordinador" . $ex->getMessage();
      }

      return true;

   }
}
