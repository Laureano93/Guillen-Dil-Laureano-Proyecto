
 let correo=document.getElementById("correo").textContent;

 localStorage.setItem('correo', correo);

$("document").ready(function () {

  let idcoordinador;

  let tipo = document.getElementById("tipo").value;

  if (document.getElementById("id") != null) {

    idcoordinador = document.getElementById("id").value;

  } else {

    idcoordinador = -1;

  }




  $.ajax({

    url: "listaprofesores.php",

    type: 'POST',

    data: {

      id: idcoordinador,
      tipo: tipo



    },

    success: function () {

      $("#profesores").show();


    }
  });

  $("#profesores").html("<img src='https://media.tenor.com/images/965beb93fefb499a174d45bfcef23c30/tenor.gif' width='10px' height='20px'></img>").load("listaprofesores.php?id=" + idcoordinador + "&tipo=" + tipo);

  setInterval(function () {

    $("#profesores").load("listaprofesores.php?id=" + idcoordinador + "&tipo=" + tipo);



  }, 4000);


});


$("document").ready(function () {

  let idcoordinador;

  let tipo = document.getElementById("tipo").value;

  if (document.getElementById("id") != null) {

    idcoordinador = document.getElementById("id").value;

  } else {

    idcoordinador = -1;

  }


  $.ajax({

    url: "ajaxincidencias.php",

    type: 'POST',

    data: {

      id: idcoordinador,
      tipo: tipo



    },

    success: function () {

      $("#inciden").show();


    }
  });

  $("#inciden").html("<img src='https://media.tenor.com/images/965beb93fefb499a174d45bfcef23c30/tenor.gif' width='10px' height='20px'></img>").load("ajaxincidencias.php?id=" + idcoordinador + "&tipo=" + tipo);

  setInterval(function () {

    $("#inciden").load("ajaxincidencias.php?id=" + idcoordinador + "&tipo=" + tipo);

  }, 4000);


});


$(document).ready(function () {

  let idcoordinador;

  let tipo = document.getElementById("tipo").value;

  if (document.getElementById("id") != null) {

    idcoordinador = document.getElementById("id").value;

  } else {

    idcoordinador = -1;

  }

  let datatable = $("#tablaprofesores1").DataTable({
    ajax: {

      url: "datatableprofesores.php",
      type: 'POST',

      data: {

        id: idcoordinador,
        tipo: tipo
      }

    },

    "pagingType": "simple_numbers",
    "language": {
      "lengthMenu": "Mostrar _MENU_ registros por  página.",
      "zeroRecords": "No se encontró registro.",
      "info": "  _START_ de _END_ (_TOTAL_ registros totales).",
      "infoEmpty": "0 de 0 de 0 registros",
      "infoFiltered": "(Encontrado de _MAX_ registros)",
      "search": "Buscar: ",
      "processing": "Procesando la información",
      "paginate": {
        "first": " |< ",
        "previous": "Ant.",
        "next": "Sig.",
        "last": " >| "
      }
    },
    columns: [
      { data: "id_profesor" },
      { data: "Nombre" },
      { data: "Apellidos" },
      { data: "email" },
      {
        data: null,
        defaultContent:
          ' <a id="editar" class="editar" onclick="editarFila(this)"><i class="fas fa-user-edit"></i></a>',
      },
    ],
  });

  let datatable2 = $("#tablacoordinadores1").DataTable({

    ajax: {

      url: "datatablecoordinadores.php",
      type: 'POST',

      data: {

        id: idcoordinador,
        tipo: tipo
      }

    },

    "pagingType": "simple_numbers",
    "language": {
      "lengthMenu": "Mostrar _MENU_ registros por  página.",
      "zeroRecords": "No se encontró registro.",
      "info": "  _START_ de _END_ (_TOTAL_ registros totales).",
      "infoEmpty": "0 de 0 de 0 registros",
      "infoFiltered": "(Encontrado de _MAX_ registros)",
      "search": "Buscar: ",
      "processing": "Procesando la información",
      "paginate": {
        "first": " |< ",
        "previous": "Ant.",
        "next": "Sig.",
        "last": " >| "
      }
    },
    columns: [
      { data: "id_coordinador" },
      { data: "Nombre" },
      { data: "Apellidos" },
      { data: "email" },
      { data: "Fecha_ingreso" },
      { data: "acciones" },
    ],
  });

  let datatable3 = $("#tablain").DataTable({

    ajax: {

      url: "datatableincidencias.php",
      type: 'POST',

      data: {

        tipo: tipo
      }


    },

    "pagingType": "simple_numbers",
    "language": {
      "lengthMenu": "Mostrar _MENU_ registros por  página.",
      "zeroRecords": "No se encontró registro.",
      "info": "  _START_ de _END_ (_TOTAL_ registros totales).",
      "infoEmpty": "0 de 0 de 0 registros",
      "infoFiltered": "(Encontrado de _MAX_ registros)",
      "search": "Buscar: ",
      "processing": "Procesando la información",
      "paginate": {
        "first": " |< ",
        "previous": "Ant.",
        "next": "Sig.",
        "last": " >| "
      }
    },
    columns: [
      { data: "Id_incidencia" },
      { data: "Naula" },
      { data: "Clase" },
      { data: "Problema" },
      { data: "Fecha_alta" },
      { data: "Solucionado" },
      { data: "acciones" },
    ],
  });

  let datatable4 = $("#tablaex").DataTable({

    ajax: {

      url: "datatableempresaexterna.php",
      type: 'POST',

      data: {

        tipo: tipo
      }


    },

    "pagingType": "simple_numbers",
    "language": {
      "lengthMenu": "Mostrar _MENU_ registros por  página.",
      "zeroRecords": "No se encontró registro.",
      "info": "  _START_ de _END_ (_TOTAL_ registros totales).",
      "infoEmpty": "0 de 0 de 0 registros",
      "infoFiltered": "(Encontrado de _MAX_ registros)",
      "search": "Buscar: ",
      "processing": "Procesando la información",
      "paginate": {
        "first": " |< ",
        "previous": "Ant.",
        "next": "Sig.",
        "last": " >| "
      }
    },
    columns: [
      { data: "id_empresa" },
      { data: "Nombre" },
      { data: "Apellidos" },
      { data: "email" },
      { data: "acciones" },
    ],
  });
});

window.addEventListener('load', cargar);

function capturar() {

  window.location.href="../public/escanear.php";


}



let inputs = document.getElementsByClassName("campos");

const asignar = function (e) {

  let campo = e.target.id;

  switch (campo) {

    case "Dni":

      validarDni(e.target);


      break;

    case "Nombre":

      validarNombre(e.target);


      break;

    case "Apellido1":

      validarApellido1(e.target);


      break;


    case "Apellido2":

      validarApellido2(e.target);


      break;


    case "Pass":

      validarPass(e.target);


      break;



  }


}

for (let i = 0; i < inputs.length; i++) {

  inputs[i].addEventListener('keyup', asignar);
  inputs[i].addEventListener('mouseout', asignar);


}


function editarIncidencia(e) {

  let campos = ["id1", "aula", "clase", "problema", "fechaingreso", "solucionado"];
  let i = 0;


  let filas = e.parentNode.parentNode;

  let inicio = filas.firstElementChild;

  while (inicio != null) {


    let dato = inicio.textContent;

    let campo = campos[i];


    if ((inicio.firstElementChild) != null && (inicio.firstElementChild.id) != "problem") {


      inicio.innerHTML = "<a id='guardar' class='editar' onclick='guardarIncidencia()'><i class='fas fa-edit'></i></a>";


      break;
    }

    if (campo == "id1") {

      inicio.innerHTML = '<input id="campo' + campo + '"' + 'type="email" style="width:150px;" value="' + dato + '"' + 'readonly>';

    } else if (campo == "problema") {

      dato = inicio.firstElementChild.textContent;

      inicio.innerHTML = '<textarea id="campo' + campo + '" rows="2" cols="26">' + dato + '</textarea>';

    } else if (campo == "solucionado") {

      if(dato=="Pendiente"){

        inicio.innerHTML='<select id="campo' + campo +'"name="estado"><option value="N">Sin Comenzar</option><option value="P" selected>Pendiente</option></select>';
      }else{

        inicio.innerHTML='<select id="campo' + campo +'"name="estado"><option value="N" selected>Sin Comenzar</option><option value="P">Pendiente</option></select>';
      }

      


    } else if (campo == "fechaingreso") {

      inicio.innerHTML = '<input id="campo' + campo + '"' + 'type="date" style="width:150px;" value="' + dato + '"' + 'readonly>';

    } else {

      inicio.innerHTML = '<input id="campo' + campo + '"' + 'type="text" style="width:150px;" value="' + dato + '"' + 'required>';
    }

    inicio = inicio.nextElementSibling;
    i++;

  }



}


function editarCoordinador(e) {

  let campos = ["id2", "nombre1", "apellidos1", "email1", "fechaingreso"];
  let i = 0;


  let filas = e.parentNode.parentNode;

  let inicio = filas.firstElementChild;

  while (inicio != null) {

    let dato = inicio.textContent;

    let campo = campos[i];

    if ((inicio.firstElementChild) != null) {

      inicio.innerHTML = "<a id='guardar' class='editar' onclick='guardarCoordinador()'><i class='fas fa-edit'></i></a>";


      break;
    }

    if (campo == "email1") {

      inicio.innerHTML = '<input id="campo' + campo + '"' + 'type="email" style="width:150px;" value="' + dato + '"' + 'required>';

    } else if (campo == "id2") {

      inicio.innerHTML = '<input id="campo' + campo + '"' + 'type="email" style="width:150px;" value="' + dato + '"' + 'readonly>';

    } else if (campo == "fechaingreso") {

      if (dato == "Usuario dado de baja") {

        inicio.innerHTML = '<input id="campo' + campo + '"' + 'type="text" style="width:150px;" value="' + dato + '"' + 'readonly>';
      } else {

        inicio.innerHTML = '<input id="campo' + campo + '"' + 'type="date" style="width:150px;" value="' + dato + '"' + 'readonly>';
      }
    } else {

      inicio.innerHTML = '<input id="campo' + campo + '"' + 'type="text" style="width:150px;" value="' + dato + '"' + 'required>';
    }

    inicio = inicio.nextElementSibling;
    i++;

  }



}


function editarFila(e) {

  let campos = ["id", "nombre", "apellidos", "email"];
  let i = 0;


  let filas = e.parentNode.parentNode;

  let inicio = filas.firstElementChild;

  while (inicio != null) {

    let dato = inicio.textContent;

    let campo = campos[i];

    if ((inicio.firstElementChild) != null) {

      inicio.innerHTML = "<a id='guardar' class='editar' onclick='guardarFila()'><i class='fas fa-edit'></i></a>";

      break;
    }

    if (campo == "email") {

      inicio.innerHTML = '<input id="campo' + campo + '"' + 'type="email" style="width:150px;" value="' + dato + '"' + 'required>';

    } else if (campo == "id") {

      inicio.innerHTML = '<input id="campo' + campo + '"' + 'type="email" style="width:150px;" value="' + dato + '"' + 'readonly>';

    } else {

      inicio.innerHTML = '<input id="campo' + campo + '"' + 'type="text" style="width:150px;" value="' + dato + '"' + 'required>';

    }

    inicio = inicio.nextElementSibling;
    i++;

  }





}


function guardarFila() {

  let campos = ["id", "nombre", "apellidos", "email"];

  let datos = [];

  for (let i = 0; i < campos.length; i++) {

    datos.push(document.getElementById("campo" + campos[i]).value);

    console.log(document.getElementById("campo" + campos[i]).value);

  }
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      if (this.responseText == "formatos no validos") {

        alert("Los campos deben tener el formato concreto");

      } else {

        location.reload();

        alert("datos actualizados");

      }


    }


  };

  xhr.open("GET", "editarprofesor.php?id=" + datos[0] + "&nombre=" + datos[1] + "&apellidos=" + datos[2] + "&email=" + datos[3], true);
  xhr.send();
}


function guardarCoordinador() {

  let campos = ["id2", "nombre1", "apellidos1", "email1", "fechaingreso"];

  let datos = [];

  for (let i = 0; i < campos.length; i++) {

    datos.push(document.getElementById("campo" + campos[i]).value);

    console.log(document.getElementById("campo" + campos[i]).value);

  }
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      if (this.responseText == "formatos no validos") {

        alert("Los campos deben tener el formato concreto");

      } else {

        location.reload();

        alert("datos actualizados");

      }


    }


  };

  xhr.open("GET", "editarcoordinador.php?id=" + datos[0] + "&nombre=" + datos[1] + "&apellidos=" + datos[2] + "&email=" + datos[3], true);
  xhr.send();



}

function guardarIncidencia() {

  let campos = ["id1", "aula", "clase", "problema","solucionado"];

  let datos = [];

  for (let i = 0; i < campos.length; i++) {

    datos.push(document.getElementById("campo" + campos[i]).value);

    console.log(document.getElementById("campo" + campos[i]).value);

  }

  console.log(datos[4]);
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {


      location.reload();

      alert("datos actualizados");

    }


  };

  xhr.open("GET", "editarincidencia.php?id=" + datos[0] + "&aula=" + datos[1] + "&clase=" + datos[2] + "&problema=" + datos[3]+"&estado="+datos[4], true);
  xhr.send();



}


function borrarCoordinador(e) {

  let id = e.parentNode.parentNode.firstElementChild.textContent;


  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {


      location.reload();

      alert("Coordinador dado de baja");

    }


  };

  xhr.open("GET", "borrarcoordinador.php?id=" + id, true);
  xhr.send();




}

function borrarEmpresa(e){


  let id = e.parentNode.parentNode.firstElementChild.textContent;


  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {


      location.reload();

      alert("Empresa Externa Borrada");

    }


  };

  xhr.open("GET", "borrarempresa.php?id=" + id, true);
  xhr.send();


}

function activarCoordinador(e) {

  let id = e.parentNode.parentNode.firstElementChild.textContent;


  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {


      location.reload();

      alert("Coordinador dado de alta");

    }


  };

  xhr.open("GET", "activarcoordinador.php?id=" + id, true);
  xhr.send();




}


function solucionIncidencia(e) {

  let id = e.parentNode.parentNode.firstElementChild.textContent;

  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {


      location.reload();

      alert("Incidencia Solucionada");

    }


  };

  xhr.open("GET", "solucionarincidencia.php?id=" + id, true);
  xhr.send();

}

function enviarmensaje(e){


    let padre=e.parentNode.parentNode;
  
    let id=padre.firstElementChild.textContent;
    let naula=padre.firstElementChild.nextElementSibling.textContent;
    let clase=padre.firstElementChild.nextElementSibling.nextElementSibling.textContent;
    let problema=padre.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.firstElementChild.textContent;
    let coordinador=document.getElementById("correo").textContent;

   
    let campocoordinador=document.createElement("input");
     campocoordinador.type="hidden";
     campocoordinador.name="coordinador";
     campocoordinador.value=coordinador;


    let campoid=document.createElement("input");
    campoid.type="hidden";
    campoid.name="id";
    campoid.value=id;

    let campoaula=document.createElement("input");
    campoaula.type="hidden";
    campoaula.name="aula";
    campoaula.value=naula;

    let campoclase=document.createElement("input");
    campoclase.type="hidden";
    campoclase.name="clase";
    campoclase.value=clase;

    let campoproblema=document.createElement("input");
    campoproblema.type="hidden";
    campoproblema.name="problema";
    campoproblema.value=problema;

  document.getElementById("correoexterno").append(campoaula,campoclase,campoproblema,campoid,campocoordinador);

}

function cargar() {


  cargarProfesores();
  cargarCoordinadores();
  cargarAdministradores();
  cargarIncidencias();

}


function cargarProfesores() {
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      document.getElementById("cprofesores").innerHTML = this.responseText;


    }


  };

  xhr.open("GET", "numeroprofesores.php", true);
  xhr.send();

}



function cargarCoordinadores() {

  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      document.getElementById("ccoordinadores").innerHTML = this.responseText;


    }


  };

  xhr.open("GET", "numerocoordinadores.php", true);
  xhr.send();


}


function cargarAdministradores() {

  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      document.getElementById("cadministradores").innerHTML = this.responseText;


    }


  };

  xhr.open("GET", "numeroadministradores.php", true);
  xhr.send();


}

function cargarIncidencias() {


  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      document.getElementById("cincidencias").innerHTML = this.responseText;


    }


  };

  xhr.open("GET", "numeroincidencias.php", true);
  xhr.send();


}


function validarDni(dni) {

  let patron = /^[0-9]{8}[A-Z]{1}$/g;

  if (patron.exec(dni.value) == null) {

    dni.classList.remove("true-input");
    dni.classList.add("false-input");

    document.getElementById("mensaje1").classList.remove("true-texto");
    document.getElementById("mensaje1").classList.add("false-texto");

    dni.nextSibling.classList.remove("fa-check");
    dni.nextSibling.classList.add("fa-times");
    dni.nextSibling.classList.add("false-i");


  } else {

    dni.classList.remove("false-input");
    dni.classList.add("true-input");

    document.getElementById("mensaje1").classList.remove("false-texto");
    document.getElementById("mensaje1").classList.add("true-texto");

    dni.nextSibling.classList.remove("fa-times");
    dni.nextSibling.classList.remove("false-i");
    dni.nextSibling.classList.add("fa-check");

  }



}


function validarNombre(nombre) {


  let numeros = /^[A-Za-z]+$/i;


  if (nombre.value.length < 3 || nombre.value.length > 14 || numeros.exec(nombre.value) == null) {

    nombre.classList.remove("true-input");
    nombre.classList.add("false-input");

    document.getElementById("mensaje2").classList.remove("true-texto");
    document.getElementById("mensaje2").classList.add("false-texto");

    nombre.nextSibling.classList.remove("fa-check");
    nombre.nextSibling.classList.add("fa-times");
    nombre.nextSibling.classList.add("false-i");


  } else {

    nombre.classList.remove("false-input");
    nombre.classList.add("true-input");

    document.getElementById("mensaje2").classList.remove("false-texto");
    document.getElementById("mensaje2").classList.add("true-texto");

    nombre.nextSibling.classList.remove("fa-times");
    nombre.nextSibling.classList.remove("false-i");
    nombre.nextSibling.classList.add("fa-check");

  }


}


function validarApellido1(apellido) {


  let numeros = /^[A-Za-z]+$/i;


  if (apellido.value.length < 3 || apellido.value.length > 14 || numeros.exec(apellido.value) == null) {

    apellido.classList.remove("true-input");
    apellido.classList.add("false-input");


    document.getElementById("mensaje3").classList.remove("true-texto");
    document.getElementById("mensaje3").classList.add("false-texto");

    apellido.nextSibling.classList.remove("fa-check");
    apellido.nextSibling.classList.add("fa-times");
    apellido.nextSibling.classList.add("false-i");


  } else {

    apellido.classList.remove("false-input");
    apellido.classList.add("true-input");

    document.getElementById("mensaje3").classList.remove("false-texto");
    document.getElementById("mensaje3").classList.add("true-texto");

    apellido.nextSibling.classList.remove("fa-times");
    apellido.nextSibling.classList.remove("false-i");
    apellido.nextSibling.classList.add("fa-check");

  }

}


function validarApellido2(apellido) {


  let numeros = /^[A-Za-z]+$/i;


  if (apellido.value.length < 3 || apellido.value.length > 14 || numeros.exec(apellido.value) == null) {

    apellido.classList.remove("true-input");
    apellido.classList.add("false-input");


    document.getElementById("mensaje4").classList.remove("true-texto");
    document.getElementById("mensaje4").classList.add("false-texto");

    apellido.nextSibling.classList.remove("fa-check");
    apellido.nextSibling.classList.add("fa-times");
    apellido.nextSibling.classList.add("false-i");


  } else {

    apellido.classList.remove("false-input");
    apellido.classList.add("true-input");

    document.getElementById("mensaje4").classList.remove("false-texto");
    document.getElementById("mensaje4").classList.add("true-texto");

    apellido.nextSibling.classList.remove("fa-times");
    apellido.nextSibling.classList.remove("false-i");
    apellido.nextSibling.classList.add("fa-check");

  }

}


function validarPass(pass) {

  
  if ((pass.value.length != 6) {

    pass.classList.remove("true-input");
    pass.classList.add("false-input");

    document.getElementById("mensaje5").classList.remove("true-texto");
    document.getElementById("mensaje5").classList.add("false-texto");

    pass.nextSibling.classList.remove("fa-check");
    pass.nextSibling.classList.add("fa-times");
    pass.nextSibling.classList.add("false-i");


  } else {

    pass.classList.remove("false-input");
    pass.classList.add("true-input");


    document.getElementById("mensaje5").classList.remove("false-texto");
    document.getElementById("mensaje5").classList.add("true-texto");



    pass.nextSibling.classList.remove("fa-times");
    pass.nextSibling.classList.remove("false-i");
    pass.nextSibling.classList.add("fa-check");

  }


}








