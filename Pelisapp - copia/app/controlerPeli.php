<?php
// ------------------------------------------------
// Controlador que realiza la gestión de usuarios
// ------------------------------------------------

include_once 'config.php';
include_once 'modeloPeliDB.php'; 

// INICIO

function  ctlPeliInicio(){
    die(" No implementado.");
   }

// ------------------------------------------------------
// Modificar pelicula (aún no implementado)

function ctlPeliModificar (){
    $peli = ModeloUserDB::GetById($_GET['codigo']);
    include_once 'plantilla/modificar.php';
}

// ---------------------------------------------------
// Detalles de la pelicula.

function ctlPeliDetalles(){
    // Mostrar detales de la pelicula desde Pelicula.php
    $peli = ModeloUserDB::GetById($_GET['codigo']);
    include_once 'plantilla/detalle.php';
}

// --------------------------------------------------
// Cierra sesión y datos. ---------------------------

function ctlPeliCerrar(){
    session_destroy();
    modeloUserDB::closeDB();
    header('Location:index.php');
}

// --------------------------------------------------
// Para ver todos los datos.

function ctlPeliVerPelis (){
    // Obtengo los datos del modelo
    $peliculas = ModeloUserDB::GetAll(); 
    // Invoco la vista 
    include_once 'plantilla/verpeliculas.php';
   
}

// ----------------------------------------------------
// Primer controller: buscarTitulo (funciona) ---------

function ctlPeliBuscarTitulo(){
    $titulo = $_GET['buscar'];
    $peliculas = ModeloUserDB::consultarTitulo($titulo);
    include_once 'plantilla/verpeliculas.php';
}

// ----------------------------------------------------
// Segundo controller: buscarDirector (funciona) ------

function ctlPeliBuscarDirector(){
    $titulo = $_GET['buscar'];
    $peliculas = ModeloUserDB::consultarDirector($titulo);
    include_once 'plantilla/verpeliculas.php';
}

// ---------------------------------------------------
// Tercer controller: buscarGenero (funciona) --------

function ctlPeliBuscarGenero(){
    $titulo = $_GET['buscar'];
    $peliculas = ModeloUserDB::consultarGenero($titulo);
    include_once 'plantilla/verpeliculas.php';
}

// --------------------------------------------------
// Controller 4A -> redireccionar a la página de nuevo

function ctlPeliAlta() {
    include_once 'plantilla/nuevo.php';
}

// Controller 4B -> introducir película

function ctlPeliInsertar() {
    $nombre = $_POST['nombre'];
    $director = $_POST['director'];
    $genero = $_POST['genero'];
    $imagen = $_FILES['poster']['name'];
    $url = $_POST['link'];
    $peliculas = ModeloUserDB::insertarPelicula($nombre, $director, $genero, $imagen, $url);
    include_once 'plantilla/verpeliculas.php';


    // necesito una funcion para subir fotos al (subirfichero)
    // transportar desde tmp (fichero temporal) al app/img
}

// --------------------------------------------------
// Controller 5 - borrarPelicula

function ctlPeliBorrar(){
    $codigo = $_GET['codigo'];
    ModeloUserDB::borrarPelicula($codigo);
    // funciona, pero recarga la pagina despues
}

// --------------------------------------------------     