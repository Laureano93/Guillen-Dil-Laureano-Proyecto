
//Muestra mensaje de alerta en el caso de que el campo oculto tenga el valor de la variable
//de sesion 

if(localStorage.getItem('correo')!=null){

  document.getElementById("Email").value=localStorage.getItem('correo');

}

if (document.getElementById("error").value != "") {

  alert(document.getElementById("error").value);

}


if (document.getElementById("aviso").value != "") {

  alert(document.getElementById("aviso").value);

}



//Procesa el enviar comprobando que los span estan ocultos ya que entonces se cumple los requisitos

document.getElementById('registrar').addEventListener('click', function (e) {


  let campo1 = document.getElementById("mensaje3").getAttribute("class");
  let campo2 = document.getElementById("mensaje4").getAttribute("class");
  let campo3 = document.getElementById("mensaje5").getAttribute("class");
  let campo4 = document.getElementById("mensaje6").getAttribute("class");
  let campo5 = document.getElementById("mensaje2").getAttribute("class");


  if (campo1 != "oculto true-texto" && campo2 != "oculto true-texto" && campo3 != "oculto true-texto" && campo4 != "oculto true-texto"&& campo5!= "oculto true-texto") {

    e.preventDefault();

    alert("Rellene los datos segun los requisitos marcados");


  }



});



//De cada input comprueba su valor
const comprobar = function (e) {


  
  let campo = e;

  switch (campo.target.id) {


    case "Nombre":

      comprobarNombre(campo.target);

      break;


    case "Pass1":

      comprobarPass(campo.target);

      break;


      case "Apellido1":

      comprobarApellido1(campo.target);

      break;

      case "Apellido2":

      comprobarApellido2(campo.target);

      break;

      case "Dni":

      comprobarDni(campo.target);

      break;

  }


}

//recoge los inputs y los pone a la escucha en el caso de que
// se suelte alguna letra o se pase con el raton

let inputs = document.getElementsByClassName('campos');


for (let i = 0; i < inputs.length; i++) {

  inputs[i].addEventListener('keyup', comprobar);
  inputs[i].addEventListener('mouseout', comprobar);


}



//Funciones para realizar las comprobaciones




/**
 * Para el nombre que sea de tamaño en el rango expresado y que 
 *   solo tenga letras mayusculas y minusculas
 * 
 * Si cumple los requisitos:
 * 
 * Se queda el borde verde y el boton eliminando todas las clases del caso contrario
 * 
 * Si no cumple los requisitos:
 * 
 * Se queda el borde rojo y el boton eliminando todas las clases del caso contrario
 *
 */

function comprobarNombre(nombre) {


  let numeros = /^[A-Za-z]+$/i;


  if (nombre.value.length < 4 || nombre.value.length > 14 || numeros.exec(nombre.value) == null) {

    nombre.classList.remove("true-input");
    nombre.classList.add("false-input");

      document.getElementById("mensaje3").classList.remove("true-texto");
      document.getElementById("mensaje3").classList.add("false-texto");

    nombre.nextSibling.classList.remove("fa-check");
    nombre.nextSibling.classList.add("fa-times");
    nombre.nextSibling.classList.add("false-i");


  } else {

    nombre.classList.remove("false-input");
    nombre.classList.add("true-input");

      document.getElementById("mensaje3").classList.remove("false-texto");
      document.getElementById("mensaje3").classList.add("true-texto");
    
    nombre.nextSibling.classList.remove("fa-times");
    nombre.nextSibling.classList.remove("false-i");
    nombre.nextSibling.classList.add("fa-check");

  }


}


function comprobarApellido1(apellido) {


  let numeros = /^[A-Za-z]+$/i;


  if (apellido.value.length < 4 || apellido.value.length > 14 || numeros.exec(apellido.value) == null) {

    apellido.classList.remove("true-input");
    apellido.classList.add("false-input");


    document.getElementById("mensaje5").classList.remove("true-texto");
    document.getElementById("mensaje5").classList.add("false-texto");

    apellido.nextSibling.classList.remove("fa-check");
    apellido.nextSibling.classList.add("fa-times");
    apellido.nextSibling.classList.add("false-i");


  } else {

    apellido.classList.remove("false-input");
    apellido.classList.add("true-input");

    document.getElementById("mensaje5").classList.remove("false-texto");
    document.getElementById("mensaje5").classList.add("true-texto");
  
  apellido.nextSibling.classList.remove("fa-times");
  apellido.nextSibling.classList.remove("false-i");
  apellido.nextSibling.classList.add("fa-check");

}


    }

    function comprobarApellido2(apellido) {


      let numeros = /^[A-Za-z]+$/i;
    
    
      if (apellido.value.length < 4 || apellido.value.length > 14 || numeros.exec(apellido.value) == null) {
    
        apellido.classList.remove("true-input");
        apellido.classList.add("false-input");
    
    
        document.getElementById("mensaje6").classList.remove("true-texto");
        document.getElementById("mensaje6").classList.add("false-texto");
    
        apellido.nextSibling.classList.remove("fa-check");
        apellido.nextSibling.classList.add("fa-times");
        apellido.nextSibling.classList.add("false-i");
    
    
      } else {
    
        apellido.classList.remove("false-input");
        apellido.classList.add("true-input");
    
        document.getElementById("mensaje6").classList.remove("false-texto");
        document.getElementById("mensaje6").classList.add("true-texto");
      
      apellido.nextSibling.classList.remove("fa-times");
      apellido.nextSibling.classList.remove("false-i");
      apellido.nextSibling.classList.add("fa-check");
    
    }
    
    
        }


/**
* Para la contraseña que sea de tamaño concreto y que 
*   tenga una letra minuscula,mayuscula,numero y caracter
* 
* Si cumple los requisitos:
* 
* Se queda el borde verde y el boton eliminando todas las clases del caso contrario
* 
* Si no cumple los requisitos:
* 
* Se queda el borde rojo y el boton eliminando todas las clases del caso contrario
*
*/

function comprobarPass(pass) {

  
  if (pass.value.length != 6) {

    pass.classList.remove("true-input");
    pass.classList.add("false-input");
    if (pass.name == "pass1") {

      document.getElementById("mensaje4").classList.remove("true-texto");
      document.getElementById("mensaje4").classList.add("false-texto");


    } else {
      document.getElementById("mensaje2").classList.remove("true-texto");
      document.getElementById("mensaje2").classList.add("false-texto");
    }
    pass.nextSibling.classList.remove("fa-check");
    pass.nextSibling.classList.add("fa-times");
    pass.nextSibling.classList.add("false-i");


  } else {

    pass.classList.remove("false-input");
    pass.classList.add("true-input");

    if (pass.name == "pass1") {

      document.getElementById("mensaje4").classList.remove("false-texto");
      document.getElementById("mensaje4").classList.add("true-texto");


    } else {

      document.getElementById("mensaje2").classList.remove("false-texto");
      document.getElementById("mensaje2").classList.add("true-texto");


    }

    pass.nextSibling.classList.remove("fa-times");
    pass.nextSibling.classList.remove("false-i");
    pass.nextSibling.classList.add("fa-check");

  }


}


function comprobarDni(dni){

  let patron=/^[0-9]{8}[A-Z]{1}$/g;

  if (patron.exec(dni.value) == null) {

     dni.classList.remove("true-input");
     dni.classList.add("false-input");
 
       document.getElementById("mensaje2").classList.remove("true-texto");
       document.getElementById("mensaje2").classList.add("false-texto");
 
     dni.nextSibling.classList.remove("fa-check");
     dni.nextSibling.classList.add("fa-times");
     dni.nextSibling.classList.add("false-i");
 
 
   } else {
 
     dni.classList.remove("false-input");
     dni.classList.add("true-input");
 
       document.getElementById("mensaje2").classList.remove("false-texto");
       document.getElementById("mensaje2").classList.add("true-texto");
     
     dni.nextSibling.classList.remove("fa-times");
     dni.nextSibling.classList.remove("false-i");
     dni.nextSibling.classList.add("fa-check");
 
   }



}




