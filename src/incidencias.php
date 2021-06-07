
<?php

require_once("conexion.php");

class Incidencia extends Conexion{

   private $id;
   private $naula;
   private $clase;
   private $fecha_alta;
   private $problema;
   private $fechareparacion;
   private $solucionado;
   private $idempresaexterna;
   private $idprofesor;
   private $idcoordinador;


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
    * Get the value of naula
    */ 
   public function getNaula()
   {
      return $this->naula;
   }

   /**
    * Set the value of naula
    *
    * @return  self
    */ 
   public function setNaula($naula)
   {
      $this->naula = $naula;

      return $this;
   }

   /**
    * Get the value of fecha_alta
    */ 
   public function getFecha_alta()
   {
      return $this->fecha_alta;
   }

   /**
    * Set the value of fecha_alta
    *
    * @return  self
    */ 
   public function setFecha_alta($fecha_alta)
   {
      $this->fecha_alta = $fecha_alta;

      return $this;
   }

   /**
    * Get the value of problema
    */ 
   public function getProblema()
   {
      return $this->problema;
   }

   /**
    * Set the value of problema
    *
    * @return  self
    */ 
   public function setProblema($problema)
   {
      $this->problema = $problema;

      return $this;
   }

   /**
    * Get the value of fechareparacion
    */ 
   public function getFechareparacion()
   {
      return $this->fechareparacion;
   }

   /**
    * Set the value of fechareparacion
    *
    * @return  self
    */ 
   public function setFechareparacion($fechareparacion)
   {
      $this->fechareparacion = $fechareparacion;

      return $this;
   }

   /**
    * Get the value of solucionado
    */ 
   public function getSolucionado()
   {
      return $this->solucionado;
   }

   /**
    * Set the value of solucionado
    *
    * @return  self
    */ 
   public function setSolucionado($solucionado)
   {
      $this->solucionado = $solucionado;

      return $this;
   }

   /**
    * Get the value of idempresaexterna
    */ 
   public function getIdempresaexterna()
   {
      return $this->idempresaexterna;
   }

   /**
    * Set the value of idempresaexterna
    *
    * @return  self
    */ 
   public function setIdempresaexterna($idempresaexterna)
   {
      $this->idempresaexterna = $idempresaexterna;

      return $this;
   }

   /**
    * Get the value of idprofesor
    */ 
   public function getIdprofesor()
   {
      return $this->idprofesor;
   }

   /**
    * Set the value of idprofesor
    *
    * @return  self
    */ 
   public function setIdprofesor($idprofesor)
   {
      $this->idprofesor = $idprofesor;

      return $this;
   }

   /**
    * Get the value of idcoordinador
    */ 
   public function getIdcoordinador()
   {
      return $this->idcoordinador;
   }

   /**
    * Set the value of idcoordinador
    *
    * @return  self
    */ 
   public function setIdcoordinador($idcoordinador)
   {
      $this->idcoordinador = $idcoordinador;

      return $this;
   }

    /**
    * Get the value of clase
    */ 
    public function getClase()
    {
       return $this->clase;
    }
 
    /**
     * Set the value of clase
     *
     * @return  self
     */ 
    public function setClase($clase)
    {
       $this->clase = $clase;
 
       return $this;
    }


   public function read(){


      $consulta="SELECT * FROM incidencia ORDER BY Id_incidencia desc LIMIT 6";

      $ejecutar=parent::$conexion->prepare($consulta);

      try{

         $ejecutar->execute();


      }catch(PDOException $ex){ echo "No se puede leer incidencias ".$ex->getMessage();}

      

      return $ejecutar;


   }


   public function readCoord($id){


      $consulta="SELECT * FROM incidencia WHERE idCoordinador=$id";

      $ejecutar=parent::$conexion->prepare($consulta);

      try{

         $ejecutar->execute();


      }catch(PDOException $ex){ echo "No se puede leer incidencias ".$ex->getMessage();}

      

      return $ejecutar;


   }


   public function leer(){


      $consulta="SELECT * FROM incidencia";

      $ejecutar=parent::$conexion->prepare($consulta);

      try{

         $ejecutar->execute();


      }catch(PDOException $ex){ echo "No se puede leer las incidencias ".$ex->getMessage();}

      return $ejecutar;


   }

   public function create(){


      $consulta="INSERT INTO incidencia(Naula,Clase,Fecha_alta,Problema,idProfesor,idCoordinador)VALUES(:n,:c,:f,:p,:i,:o)";
        $array=[':n'=>$this->getNaula(),':c'=>$this->getClase(),':f'=>$this->getFecha_alta(),':p'=>$this->getProblema(),':i'=>$this->getIdprofesor(),':o'=>$this->getIdcoordinador()];
        $ejecutar=parent::$conexion->prepare($consulta);

        try{

             $ejecutar->execute($array);


        }catch(PDOException $ex){echo "No se puede añadir la incidencia" .  $ex->getMessage(); }
        
        header("Location: ../public/index.php?aviso=Incidencia Agregada");



   }


   public function editar(){

      $consulta = "UPDATE incidencia SET Naula=" . "'" . $this->getNaula() . "'" . ",Clase=" . "'" . $this->getClase() . "'" . ",Problema=" . "'" . $this->getProblema() . "'"  . ",Solucionado=" . "'" . $this->getSolucionado() . "'". "WHERE Id_incidencia=" . $this->getId();
      $ejecutar = parent::$conexion->prepare($consulta);

      try {

         $ejecutar->execute();
      } catch (PDOException $ex) {
         echo "error al actualizar la incidencia" . $ex->getMessage();
      }

      return true;

   }

   public function solucionar(){

      $hoy=date('Y-m-d', time());

      $consulta = "UPDATE incidencia SET Fecha_reparacion=" . "'" . $hoy . "'" . ", Solucionado='S' WHERE Id_incidencia=" . $this->getId();
      $ejecutar = parent::$conexion->prepare($consulta);

      try {

         $ejecutar->execute();
      } catch (PDOException $ex) {
         echo "error al actualizar la incidencia" . $ex->getMessage();
      }

      return true;


   }

   
}