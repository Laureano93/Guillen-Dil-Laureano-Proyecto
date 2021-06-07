
<?php

require_once("../src/incidencias.php");


$data=array();

$incidencia=new Incidencia();

$lista=$incidencia->leer();

    
    
  $incidencia=null;



 while(($fila=$lista->fetch(PDO::FETCH_OBJ))!=null){

      

            if($fila->Solucionado=='S'){
          

                $fila->Solucionado="Reparado";

                if($_POST['tipo']!="profesor"){
    
                $fila->acciones='<a id="editar" class="editar" onclick="editarIncidencia(this)"><i class="fas fa-pen-square"></i></a>';
              }else{

                $fila->acciones="Sin Acciones";
              }
    
            } else if($fila->Solucionado=='P'){

              $fila->Solucionado="Pendiente";

              if($_POST['tipo']!="profesor"){
    
              $fila->acciones='<a id="editar" class="editar" onclick="editarIncidencia(this)"><i class="fas fa-pen-square"></i></a> <a id="borrar" class="editar" onclick="solucionIncidencia(this)"><i class="fas fa-check"></i></a>  <a href="#m2" id="correoex" class="editar" onclick="enviarmensaje(this)"><i class="fas fa-envelope-open-text"></i></a>';
              }else{

                $fila->acciones="Sin Acciones";
              }

            }else{
                $fila->Solucionado="Sin Comenzar";

                if($_POST['tipo']!="profesor"){
    
                $fila->acciones='<a id="editar" class="editar" onclick="editarIncidencia(this)"><i class="fas fa-pen-square"></i></a> <a id="borrar" class="editar" onclick="solucionIncidencia(this)"><i class="fas fa-check"></i></a> <a href="#m2" id="correoex" class="editar" onclick="enviarmensaje(this)"><i class="fas fa-envelope-open-text"></i></a>';
                }else{

                  $fila->acciones="Sin Acciones";
                }
    
            }

        $fila->Problema="<textarea id='problem' cols='26' rows='2'readonly>".$fila->Problema."</textarea>";
        
        $data['data'][] = $fila;
        
    
     }
    
     
echo json_encode($data);