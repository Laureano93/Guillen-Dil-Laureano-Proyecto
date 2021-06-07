<?php

session_start();

require_once("../src/profesor.php");

require_once("../src/coordinador.php");

require_once("../src/incidencias.php");

require_once("../src/externa.php");

if (isset($_GET['usuario'])) {

    $_SESSION['usuario'] = $_GET['usuario'];
}

if (isset($_GET['tipo'])) {

    $_SESSION['tipo'] = $_GET['tipo'];
}

if (isset($_GET['idsesion'])) {

    $_SESSION['idsesion'] = $_GET['idsesion'];
}



if (isset($_GET['creador']) && $_GET['creador'] != "") {

    $_SESSION['usuario'] = $_GET['creador'];
    $_SESSION['tipo'] = "coordinador";
}

$lista = null;

if ($_SESSION['tipo'] == "coordinador") {

    $coordinador = new Coordinador();

    $lista = $coordinador->profesorCoordinador($_SESSION['idsesion']);

    $coordinador = null;
} else {


    $profesor = new Profesor();

    $coord = new Coordinador();

    $lista = $profesor->read();

    $lista2 = $coord->read();

    $profesor = null;

    $coord = null;
}

$incidencia = new Incidencia();

$incidencia = null;

$externa = new Externa();

$lista3 = $externa->read();
$externa = null;


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sala De Incidencias</title>


    <link rel="stylesheet" href="styles.css">


    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>


    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.css" />
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.js"></script>
</head>

<body>
    <input type="checkbox" id="nav-toggle">
    <input type="hidden" id="id" value="<?php echo $_SESSION['idsesion'] ?>">
    <input type="hidden" id="tipo" value="<?php echo $_SESSION['tipo'] ?>">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="lab la-accusoft"></span>Administracion</h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="" class="active"><span class="las la-igloo"></span><span>Bienvenido</span></a>
                </li>

                <?php
                if ($_SESSION['tipo'] == "administrador" || $_SESSION['tipo'] == "coordinador") {


                ?>


                    <li>
                        <a href="#tablapro" id="listap"><span class="las la-users"></span><span>Profesores</span></a>
                    </li>

                <?php

                }

                ?>

                <?php

                if ($_SESSION['tipo'] == "administrador") {


                ?>
                    <li>
                        <a href="#tablapro2"><span class="las la-users"></span><span>Coordinadores</span></a>
                    </li>

                <?php

                }

                ?>

                <?php
                if ($_SESSION['tipo'] == "administrador" || $_SESSION['tipo'] == "coordinador") {


                ?>

                    <li>
                        <a href="#tablapro4"><span class="las la-users"></span><span>Externos</span></a>
                    </li>

                <?php

                }

                ?>
                <li>
                    <a href="#tablapro3"><span class="las la-clipboard-list"></span><span>Incidencias</span></a>
                </li>
                <li>
                    <a href="cerrarsesion.php"><span class="las la-window-close"></span><span>Cerrar Sesion</span></a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label>
                Inicio
            </h2>

            <div class="user-wrapper">
                <div>
                    <h4 id="correo"><?php echo $_SESSION['usuario'] ?></h4>
                    <small><?php echo $_SESSION['tipo'] ?></small>
                </div>
            </div>
        </div>


        <main>
            <div class="cards">
                <div class="card-single">
                    <div>
                        <h1 id="cprofesores"></h1>
                        <span>Profesores</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>

                <div class="card-single">
                    <div>
                        <h1 id="ccoordinadores"></h1>
                        <span>Coordinadores</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>

                <div class="card-single">
                    <div>
                        <h1 id="cadministradores"></h1>
                        <span>Administradores</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>

                </div>

                <div class="card-single">
                    <div>
                        <h1 id="cincidencias"></h1>
                        <span>Incidencias</span>
                    </div>
                    <div>
                        <span class="las la-clipboard-list"></span>
                    </div>

                </div>

            </div>

            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Lista Incidencias</h3>
                            <?php

                            if ($_SESSION['tipo'] == "profesor") {

                            ?>

                                <button><a onclick="capturar()">Nuevo</a></button>


                            <?php
                            }
                            ?>

                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td>Naula</td>
                                            <td>Clase</td>
                                            <td>Problema</td>
                                        </tr>
                                    </thead>
                                    <tbody id="inciden">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                if ($_SESSION['tipo'] == "administrador" || $_SESSION['tipo'] == "coordinador") {
                ?>

                    <div class="customers">
                        <div class="card">
                            <div class="card-header">
                                <h3>Nuevo Profesor</h3>

                                <button><a href="#m1">Nuevo</a></button>

                            </div>

                            <div id="profesores">

                            </div>

                        </div>
                    </div>
            </div>

        <?php
                }
        ?>

        <div id="m1" class="modal1">
            <div>
                <a href="#close" title="Close" class="close">X</a>
                <h2 style="text-align:center;">Nuevo Profesor</h2>
                <form class="inicio-campos" action="../src/agregarusuario.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="accion" value="admincreate" />
                        <p><input type="text" class="campos" id="Dni" name="dni" placeholder="Escriba su dni" required /><i class="fas fa-times"></i></p>
                        <span class="oculto" id="mensaje1">Dni Debe llevar 8 numeros una letra mayuscula</span>
                        <p><input type="text" class="campos" id="Nombre" name="nombre" placeholder="Escriba su nombre" required /><i class="fas fa-times"></i></p>
                        <span class="oculto" id="mensaje2">Nombre sin numeros,signos, mayor de 4 y menor de 14 caracteres</span>
                        <p><input type="text" class="campos" id="Apellido1" name="apellido1" placeholder="Escriba su apellido" required /><i class="fas fa-times"></i></p>
                        <span class="oculto" id="mensaje3">Apellido 1 sin numeros,signos, mayor de 4 y menor de 14 caracteres</span>
                        <p><input type="text" class="campos" id="Apellido2" name="apellido2" placeholder="Escriba su apellido" required /><i class="fas fa-times"></i></p>
                        <span class="oculto" id="mensaje4">Apellido 2 sin numeros,signos, mayor de 4 y menor de 14 caracteres</span>
                        <p><input type="password" class="campos" id="Pass" name="pass" placeholder="Escriba su contraseña" required /><i class="fas fa-times"></i></p>
                        <span class="oculto" id="mensaje5">Contraseña debe tener 6 caracteres</span>
                        <p><input type="email" class="campos" id="Email" name="email" placeholder="Escriba su email" required /></p><br>
                        <?php
                        if ($_SESSION['tipo'] == "coordinador") {

                        ?>

                            <input type="hidden" name="coordinador" value="<?php echo $_SESSION['idsesion'] ?>" />

                        <?php
                        } else {

                        ?>

                            <select name="coordinador">

                                <?php

                                while (($fila = $lista2->fetch(PDO::FETCH_OBJ)) != null) {

                                ?>
                                    <option <?php echo 'value=' . '"' . $fila->id_coordinador . '"' ?>><?php echo $fila->Apellidos . " " . $fila->Nombre ?></option>


                                <?php

                                }

                                ?>

                            </select>

                        <?php

                        }

                        ?>
                        <p><input type="submit" id="crear" value="Crear"></p>
                    </div>
                </form>

            </div>
        </div>

        <div id="m2" class="modal1">
            <div>
                <a href="#close" title="Close" class="close">X</a>
                <h2 style="text-align:center;">Seleccione la empresa externa</h2>
                <form class="inicio-campos" action="../src/enviarcorreo.php" method="POST">

                    <div class="modal-body" id="correoexterno">

                        <select id="eexterna" name="externo">

                            <?php

                            while (($fila = $lista3->fetch(PDO::FETCH_OBJ)) != null) {

                            ?>

                                <option value="<?php echo $fila->email ?>"><?php echo $fila->email ?></option>

                            <?php
                            }
                            ?>
                        </select>

                        <p><input type="submit" id="enviar2" value="Enviar"></p>
                    </div>
                </form>

            </div>
        </div>

        <div id="tablapro" class="contenido">
            <div>
                <a href="#close" title="Close" class="close">X</a>
                <h2 style="text-align: center;">Tabla Profesores</h2>
                <div class="projects">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tablaprofesores1" class="display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Email</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>


        <div id="tablapro3" class="contenido1">
            <div>
                <a href="#close" title="Close" class="close1">X</a>
                <h2 style="text-align: center;">Tabla Incidencias</h2>
                <div class="projects">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tablain" class="display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <td>Id</td>
                                            <td>Naula</td>
                                            <td>Clase</td>
                                            <td>Problema</td>
                                            <td>FechaAlta</td>
                                            <td>Solucionado</td>
                                            <td>Acciones</td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>


        <div id="tablapro4" class="contenido1">
            <div>
                <a href="#close" title="Close" class="close1">X</a>
                <h2 style="text-align: center;">Tabla Coordinadores Externos</h2>
                <div class="projects">
                    <div class="card">
                        <div class="card-body">
                            <a href="#m3" class="editar"><i class="fas fa-user-plus"></i></a>
                            <div class="table-responsive">
                                <table id="tablaex" class="display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>

                                            <td>Id</td>
                                            <td>Nombre</td>
                                            <td>Apellidos</td>
                                            <td>Email</td>
                                            <td>Acciones</td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div id="m3" class="modal1">
            <div>
                <a href="#close" title="Close" class="close">X</a>
                <h2 style="text-align:center;">Nueva Empresa Externa</h2>
                <form class="inicio-campos" action="../src/nuevaempresa.php" method="POST">

                    <div class="modal-body" id="empresaexterna">

                        <p><input type="text" class="campos"  name="nombre" placeholder="Escriba su nombre" required /><i class="fas fa-times"></i></p>

                        <p><input type="text" class="campos"  name="apellido1" placeholder="Escriba su apellido 1" required /><i class="fas fa-times"></i></p>

                        <p><input type="text" class="campos" name="apellido2" placeholder="Escriba su apellido 2" required /><i class="fas fa-times"></i></p>

                        <p><input type="email" class="campos" name="email" placeholder="Escriba su email" required /></p>

                        <p><input type="submit" id="enviar3" value="Crear"></p>
                    </div>
                </form>

            </div>
        </div>




        <?php

        if ($_SESSION['tipo'] == "administrador") {

        ?>

            <div id="tablapro2" class="contenido1">
                <div>
                    <a href="#close" title="Close" class="close1">X</a>
                    <h2 style="text-align: center;">Tabla Coordinadores</h2>
                    <div class="projects">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="tablacoordinadores1" class="display" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <td>Id</td>
                                                <td>Nombre</td>
                                                <td>Apellidos</td>
                                                <td>Email</td>
                                                <td>Fecha-Ingreso</td>
                                                <td>Acciones</td>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        <?php

        }

        ?>




        </main>

    </div>







    <script type="text/javascript" src="../js/administracion.js"></script>
</body>

</html>