<?php

require_once("config.php");

class Conexion{

    protected static $conexion;
    
    public function __construct()
    {
    
        if(self::$conexion==null){
         
               self::crearConexion();
        }
        
    }
    
    private static function crearConexion(){
    
        $user=DB_USER;
        $pass=DB_PASS;
        $base=DB_NAME;
        $puerto=DB_PORT;
        $dsn="mysql:host=localhost;port=$puerto;dbname=$base;charaset=utf8mb4";
    
    
    
        try{
            self::$conexion=new PDO($dsn,$user,$pass);
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
    
        }catch(PDOException $ex){
    
            die("error al conectar con la base de datos".$ex->getMessage());
         
        }
    }
    
    }