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
// Modificar pelicula 

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
    $peliculas = ModeloUserDB::GetAll();
    include_once 'plantilla/verpeliculas.php';
}

// --------------------------------------------------    
// Controller 6 - votarPelicula

function ctlPeliVotar() {
    
    // ----------------------------------------------
    // Cookie 1 - No votar más de 5 veces al día ----

    if ( !isset($_COOKIE["numeroDeVotos"])) {
        setcookie("numeroDeVotos", 0 , time() + 84600);
        // para no resetear el tiempo si vota
        setcookie("tiempoFinal"  , time() + 86400, time() + 86400); 
    } else {
        setcookie("numeroDeVotos", $_COOKIE["numeroDeVotos"] + 1, $_COOKIE["tiempoFinal"]);
    }

    $codigo = $_GET['codigo']; // codigo de pelicula
    $voto = $_GET['voto']; // numero de voto

    if ($_COOKIE["numeroDeVotos"] > 5) { // menor de 5, pasa // mas de 5, no pasa
        ModeloUserDB::votarPelicula($codigo, $voto);
    } else {
        alert("Superaste el número de votos en 24 horas."); 
    }

    $peliculas = ModeloUserDB::GetAll();
    include_once 'plantilla/verpeliculas.php';

}

// --------------------------------------------------
// Controller 7 - imprimirPDF

function ctlPeliImprimirPDF() {
    include_once 'plantilla/imprimir/imprimirPDF.php';
}
// --------------------------------------------------
// Controller 8 - imprimirJSON

function ctlPeliImprimirJSON() {
    $peliculas = ModeloUserDB::GetAll();
    $salidaPeliculas = json_encode($peliculas);

    if ( $salidaPeliculas == false ) {
        echo "Ha fallado el JSON.";
    } else {
        header ("Content-Type: application/json");
        echo $salidaPeliculas;
        exit();
    }
}

// --------------------------------------------------
// Controller 9 -