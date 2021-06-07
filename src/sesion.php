<?php


require_once("conexion.php");
require '../phpmailer/PHPMailerAutoload.php';
require '../phpmailer/class.phpmailer.php';


class Sesion extends Conexion
{
  
  protected $dni;

  protected $pass;

  protected $nombre;

  protected $apellidos;

  protected $email;

  protected $emailenvio="";

  protected $passenvio="";

  protected $tipo;

  public function __construct()
  {
    parent::__construct();
  }


  /**
   * Get the value of Dni
   */
  public function getDni()
  {
    return $this->dni;
  }

  /**
   * Set the value of Dni
   *
   * @return  self
   */
  public function setDni($dni)
  {
    $this->dni = $dni;

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
  public function setPass($pass)
  {
    $this->pass = $pass;

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
    $this->apellidos = $apellido1 . " ".$apellido2;

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
   * Get the value of tipo
   */ 
  public function getTipo()
  {
    return $this->tipo;
  }

  /**
   * Set the value of tipo
   *
   * @return  self
   */ 
  public function setTipo($tipo)
  {
    $this->tipo = $tipo;

    return $this;
  }


  public function validaUsuario()
  {

    $contraseña = md5($this->getPass());
    
    if($this->getTipo()=="administrador"){

      $consulta = "SELECT Idadmin AS id ,count(*) AS cantidad FROM usuariosadmin WHERE email=:e AND pass=:p";


    }else if($this->getTipo()=="coordinador"){

      $consulta = "SELECT id_coordinador AS id , count(*) AS cantidad FROM coordinador WHERE email=:e AND passcoordinador=:p";

    }else{

      $consulta = "SELECT id_profesor AS id , count(*) AS cantidad FROM profesor WHERE email=:e AND passprofesor=:p";

    }
    
    $array = [':e' => $this->getEmail(), ':p' => $contraseña];

    $ejecutar = parent::$conexion->prepare($consulta);

    try {

      $ejecutar->execute($array);
    } catch (PDOException $ex) {
      die("Error al leer el usuario" . $ex->getMessage());
    };

    $resultado = $ejecutar->fetch(PDO::FETCH_OBJ);

    if ($resultado->cantidad > 0) {
      header("Location: ../public/panel.php?usuario=".$this->getEmail()."&tipo=".
      $this->getTipo()."&idsesion=".$resultado->id);
    } else {

      header("Location: ../public/index.php?error=No has podido iniciar sesion");
    }
  }

  public function enviarRegistro()
  {

    $consulta = "SELECT email,id_coordinador FROM coordinador";

    $ejecutar = parent::$conexion->prepare($consulta);

    try {

      $ejecutar->execute();
    } catch (PDOException $ex) {
      die("Error al leer el email del administrador" . $ex->getMessage());
    };
         

    while((($fila = $ejecutar->fetch(PDO::FETCH_OBJ)) != null)){

      $titulo = 'Usuario para registrar';

      $dni=$this->getDni();
  
      $nombre=$this->getNombre();
      
      $apellidos=explode(" ",$this->getApellidos());
      $apellido1=$apellidos[0];
      $apellido2=$apellidos[1];
      $email=$this->getEmail();
  
      $emaildestino=$fila->email;
      
      $iddestino=$fila->id_coordinador;

      $pass=md5($this->getPass());

      $mail=new PHPMailer();


      $mail->isSMTP();
      $mail->Host='smtp.gmail.com';
      $mail->Port=587;
      $mail->SMTPAuth=true;
      $mail->SMTPSecure='tls';
      $mail->Username=$this->emailenvio;
      $mail->Password=$this->passenvio;
      $mail->setFrom($this->emailenvio);
      $mail->addAddress($emaildestino);
      $mail->Subject=$titulo;
      $mail->isHTML(true);
      $mail->Body="<div> <h1>Profesor</h1> Nombre: " . $nombre . " Apellido 1: " . $apellido1 . " Apellido 2: " . $apellido2." Email: " . $email . " Contraseña: " . $pass .
      " Enlace: " . "<a href='http://localhost/Guillen%20Dil%20Laureano%20Proyecto%20Final/src/agregarusuario.php?&dni=$dni&nombre=$nombre&apellido1=$apellido1&apellido2=$apellido2&email=$email&pass=$pass&usuario=$emaildestino&iddestino=$iddestino'>Agregar Profesor</a>
      </div><br><div> <h1>Coordinador</h1> Nombre: " . $nombre . " Apellido 1: " . $apellido1 . " Apellido 2: " . $apellido2." Email: " . $email . " Contraseña: " . $pass .
      " Enlace: " . "<a href='http://localhost/Guillen%20Dil%20Laureano%20Proyecto%20Final/src/agregarusuario.php?&dni=$dni&nombre=$nombre&apellido1=$apellido1&apellido2=$apellido2&email=$email&pass=$pass&usuario=$emaildestino&coord=1'>Agregar Coordinador</a></div>";
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

           header("Location: ../public/index.php?aviso=Informacion enviada, espere ha ser aceptado por el coordinador");

      }

    
    
  
  }

  
}
  

}
