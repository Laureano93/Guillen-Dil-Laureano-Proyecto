<?php

//Clase que accede a toda la informacion del sistema
require_once("conexion.php");

require '../phpmailer/PHPMailerAutoload.php';
require '../phpmailer/class.phpmailer.php';

class Externa extends Conexion
{

   private $id;
   private $nombre;
   private $apellidos;
   private $email;
   protected $emailenvio="";
   protected $passenvio="";


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

   
   public function read()
   {

      $consulta = "SELECT * FROM empresa_externa";

      $ejecutar = parent::$conexion->prepare($consulta);

      try {

         $ejecutar->execute();
      } catch (PDOException $ex) {
         echo "No se puede leer las empresas externas" + $ex->getMessage();
      }



      return $ejecutar;
   }

   public function create(){

      $consulta="INSERT INTO empresa_externa(Nombre,Apellidos,email)VALUES(:n,:a,:e)";
      $array=[':n'=>$this->getNombre(),':a'=>$this->getApellidos(),':e'=>$this->getEmail()];

     if($this->comprobar("email",$this->getEmail())){
       
      $ejecutar=parent::$conexion->prepare($consulta);

     }else{

      header("Location: ../public/panel.php?error=La empresa ya existe(email duplicado)");
     }

     try{

      $ejecutar->execute($array);


 }catch(PDOException $ex){echo "No se puede añadir a la empresa externa " .  $ex->getMessage(); }
 
 header("Location: ../public/panel.php?aviso=Empresa Agregado");

}

   public function enviarMensaje($aula,$clase,$problema,$id,$coordinador)
  {

   
      $titulo = 'Problema A Reparar';
      
      
      $email=$this->getEmail();
  
   
      $mail=new PHPMailer();

      $mail->isSMTP();
      $mail->Host='smtp.gmail.com';
      $mail->Port=587;
      $mail->SMTPAuth=true;
      $mail->SMTPSecure='tls';
      $mail->Username=$this->emailenvio;
      $mail->Password=$this->passenvio;
      $mail->setFrom($this->emailenvio);
      $mail->addAddress($email);
      $mail->Subject=$titulo;
      $mail->isHTML(true);
      $mail->Body="<div> <h1>Problema A Reparar</h1> <h2>Aula:</h2>" . $aula . " <h2>Clase:</h2> " . $clase . " <h2>Problema:</h2>" . $problema. " <h2>Coordinador:</h2>" . $coordinador;
      $mail->smtpConnect([
        'ssl' => [
             'verify_peer' => false,
             'verify_peer_name' => false,
             'allow_self_signed' => true
         ]
     ]);

      if(!$mail->send()){

        echo $mail->ErrorInfo;


      }else{


         $consulta="UPDATE incidencia SET Solucionado='P' WHERE Id_incidencia=$id";

         $ejecutar = parent::$conexion->prepare($consulta);

         try {
   
            $ejecutar->execute();
         } catch (PDOException $ex) {
            echo "No se puede actualizar las empresas externas" + $ex->getMessage();
         }

           header("Location: ../public/panel.php");

      }

    
    
  
  }

  public function delete(){

   $id=$this->getId();

   $consulta = "DELETE  FROM empresa_externa WHERE id_empresa=$id";

   $ejecutar = parent::$conexion->prepare($consulta);

   try {

      $ejecutar->execute();
   } catch (PDOException $ex) {
      echo "No se puede borrar la empresa externa" + $ex->getMessage();
   }



   return $ejecutar;

  }

  public function comprobar($campo,$valor){
         
   $consulta="SELECT count(*) as coincidir FROM empresa_externa WHERE $campo"."=".$valor;

   $ejecutar=parent::$conexion->prepare($consulta);

   try{

       $ejecutar->execute();


  }catch(PDOException $ex){echo "No se puede realizar la busqueda de empresa externa " .  $ex->getMessage(); }


  $coincidencia=$ejecutar->fetch(PDO::FETCH_OBJ);

  if($coincidencia->coincidir==0){

           return true;
  }else{

     return false;
   
  }

     

}

  
}


