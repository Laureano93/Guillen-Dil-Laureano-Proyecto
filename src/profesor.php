<?php

//Clase que accede a toda la informacion del sistema
require_once("conexion.php");


class Profesor extends Conexion{

   private $id;
   private $dni;
   private $nombre;
   private $apellidos;
   private $contraseña;
   private $email;
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
   public function setApellidos($apellido1,$apellido2)
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
    public function getIdcoordinador()
    {
       return $this->idcoordinador;
    }
 
    /**
     * Set the value of idCoordinador
     *
     * @return  self
     */ 
    public function setIdCoordinador($idcoordinador)
    {
       $this->idcoordinador = $idcoordinador;
 
       return $this;
    }



    public function create($insertor){

          
        $consulta="INSERT INTO profesor(Dni,Nombre,Apellidos,email,passprofesor,idcoordinador)VALUES(:d,:n,:a,:e,:p,:c)";
        $array=[':d'=>$this->getDni(),':n'=>$this->getNombre(),':a'=>$this->getApellidos(),':e'=>$this->getEmail(),':p'=>$this->getContraseña(),':c'=>$this->getIdcoordinador()];
        

        if($this->comprobar("Dni",$this->getDni()) && $this->comprobar("email",$this->getEmail())){


         $ejecutar=parent::$conexion->prepare($consulta);


        }else{

            header("Location: ../public/panel.php?creador=$insertor&error=Datos Ya Existen&idsesion=".
            $this->getIdcoordinador());

        }
       


        try{

             $ejecutar->execute($array);


        }catch(PDOException $ex){echo "No se puede añadir al profesor " .  $ex->getMessage(); }
        
        header("Location: ../public/panel.php?creador=$insertor&aviso=Profesor Agregado&idsesion=".
        $this->getIdcoordinador());


    }



    public function comprobar($campo,$valor){
         
        $consulta="SELECT count(*) as coincidir FROM profesor WHERE $campo"."=".$valor;

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

    public function read(){

        $consulta="SELECT * FROM profesor";

        $ejecutar=parent::$conexion->prepare($consulta);

        try{

         $ejecutar->execute();


        }catch(PDOException $ex){echo "error al leer profesores " .$ex->getMessage();}

        return $ejecutar;

    }


    public function listaInicio(){

      $consulta="SELECT * FROM profesor ORDER BY id_profesor desc LIMIT 6";

      $ejecutar=parent::$conexion->prepare($consulta);

      try{

       $ejecutar->execute();


      }catch(PDOException $ex){echo "error al leer los 10  profesores " .$ex->getMessage();}

      return $ejecutar;

  }



  public function editar(){

   $consulta="UPDATE profesor SET Nombre="."'".$this->getNombre()."'".",Apellidos="."'".$this->getApellidos()."'".",email="."'".$this->getEmail()."'"."WHERE id_profesor=".$this->getId();
   $ejecutar=parent::$conexion->prepare($consulta);
   
   try{

      $ejecutar->execute();


     }catch(PDOException $ex){echo "error al actualizar el profesor " .$ex->getMessage();}

     return true;

  }

  



}