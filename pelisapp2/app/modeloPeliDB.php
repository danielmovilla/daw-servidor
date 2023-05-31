<?php

include_once 'config.php';
include_once 'Pelicula.php';

class ModeloUserDB {

     private static $dbh = null; 
     private static $consulta_peli = "Select * from peliculas where codigo_pelicula = ?";
     private static $consultaTitulo = "Select * from peliculas where nombre like ?";
     private static $consultaDirector = "Select * from peliculas where director like ?";
     private static $consultaGenero = "Select * from peliculas where genero like ?";
     private static $insertarPelicula = "Insert into peliculas (`nombre`, `director`, `genero`, `imagen`, `url`) VALUES (?,?,?,?,?)";
     private static $borrarPelicula = "Delete from peliculas where codigo_pelicula = ?";
     private static $actualizarPelicula = "UpdATE PELICULAS SET nombre =: nombre";
     private static $actualizarVoto = "Update peliculas set votos = ?, media = ? where codigo_pelicula = ?";


    
// Primera función: consultarTitulo (funciona) -----------------

public static function consultarTitulo($titulo) {

    echo $titulo;
    $stmt = self::$dbh->prepare(self::$consultaTitulo);
    $stmt->bindValue(1,$titulo."%");
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
    $stmt->execute();
    $tpelis = [];
    while ( $peli = $stmt->fetch()){
        $tpelis[] = $peli;       
    }
    return $tpelis;
}

// ------------------------------------------------------------
// Segunda función: consultarDirector /////////////////////////

public static function consultarDirector($titulo) {

    echo $titulo;
    $stmt = self::$dbh->prepare(self::$consultaDirector);
    $stmt->bindValue(1,$titulo);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
    $stmt->execute();
    $tpelis = [];
    while ( $peli = $stmt->fetch()){
        $tpelis[] = $peli;       
    }
    return $tpelis;

}

// ------------------------------------------------------------
// Tercera función: consultaGenero ////////////////////////////

public static function consultarGenero($titulo) {

    echo $titulo;
    $stmt = self::$dbh->prepare(self::$consultaGenero);
    $stmt->bindValue(1,$titulo);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
    $stmt->execute();
    $tpelis = [];
    while ( $peli = $stmt->fetch()){
        $tpelis[] = $peli;       
    }
    return $tpelis;
}

// -----------------------------------------------------------
// Cuarta funcion: insertarPelicula //////////////////////////

public static function insertarPelicula($nombre, $director, $genero, $imagen, $url) {
    echo "Nombre a introducir: "  . $nombre . "<br>";
    echo "Director a introducir: " . $director . "<br>";
    echo "Género a introducir: " . $genero . "<br>";
    echo "Imagen/enl. a introducir: " . $imagen . "<br>";
    echo "URL a introducir: " . $url . "<br>";

    $stmt = self::$dbh->prepare(self::$insertarPelicula);
    $stmt->bindValue(1, $nombre);
    $stmt->bindValue(2, $director);
    $stmt->bindValue(3, $genero);
    $stmt->bindValue(4, $imagen);
    $stmt->bindValue(5, $url);
    $stmt->execute();

    // Invalid parameter number: number of bound variables does not match number of tokens 

    $tpelis = [];
    while ( $peli = $stmt->fetch()){
        $tpelis[] = $peli;       
    }
    return $tpelis;
    
    include_once 'app/verpeliculas.php';
}

// ----------------------------------------------------------
// Quinta función: borrarPelicula 

public static function borrarPelicula($codigo) {
    $stmt = self::$dbh->prepare(self::$borrarPelicula);
    $stmt->bindValue(1,$codigo);
    $stmt->execute();
    if ($stmt->rowCount() > 0 ){
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
        $peli = $stmt->fetch();
        return $peli;
    }
    echo "La película elegida ha sido borrada. <br>";
    echo "Recargue la página para ver los cambios. <br>";

    // Para ver los resultados simplemente hay que ir de nuevo al index.php

    $tpelis = [];
    while ( $peli = $stmt->fetch()){
        $tpelis[] = $peli;       
    }
    return $tpelis;

    include_once 'app/verpeliculas.php';
}

// -----------------------------------------------------------
// Sexta función: votarPelicula

public static function votarPelicula($voto, $codigo) {

    $stmt = self::$dbh->prepare("Select media from peliculas where codigo_pelicula = ?");
    $stmt -> bindValue(1, $codigo);
    $stmt -> execute();
    $media2 = $stmt -> fetchColumn();

    $stmt = self::$dbh->prepare("Select votos from peliculas where codigo_pelicula = ?");
    $stmt -> bindValue(1, $codigo);
    $stmt -> execute();
    $votos2 = $stmt -> fetchColumn();

    // print_r($media2);
    // print_r($votos2);
    // echo ("La media es: " . $media2);
    // echo ("Los votos son: " . $votos2);

    $multiplicar = $media2 * $votos2;
    $divisor = $votos2 + 1;
    $resultado = $multiplicar / $divisor;

    $stmt = self::$dbh->prepare(self::$actualizarVoto);
    $stmt->bindValue(1, $divisor);
    $stmt->bindValue(2, $resultado);
    $stmt->bindValue(3, $codigo);
    $stmt->execute();

}


// -----------------------------------------------------------
// Séptima funcion: imprimirPDF

public static function imprimirPDF() {
    // no tocar
}

// -----------------------------------------------------------
// Octava función: imprimirJSON

public static function imprimirJSON() {
    // no tocar
}

// ---------------------------------------------------------- 

public static function init(){
   
    if (self::$dbh == null){
        try {
            // Cambiar  los valores de las constantes en config.php
            $dsn = "mysql:host=".DBSERVER.";dbname=".DBNAME.";charset=utf8";
            self::$dbh = new PDO($dsn,DBUSER,DBPASSWORD);
            // Si se produce un error se genera una excepción;
            self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        
    }
}

// Tabla de objetos con todas las peliculas
public static function GetAll ():array{
    // Genero los datos para la vista que no muestra la contraseña
    
    $stmt = self::$dbh->query("select * from peliculas");
    
    $tpelis = [];
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
    while ( $peli = $stmt->fetch()){
        $tpelis[] = $peli;       
    }
    return $tpelis;
}

public static function DeleteOne ():array{
    $stmt = self::$dbh->prepare(self::$borrarPelicula);
    $stmt->bindValue(1,$codigo);
    $stmt->execute();
    if ($stmt->rowCount() > 0 ){
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
        $peli = $stmt->fetch();
        return $peli;
    }
}

public static function GetById($codigo){
    $stmt = self::$dbh->prepare(self::$consulta_peli);
    $stmt->bindValue(1,$codigo);
    $stmt->execute();
    if ($stmt->rowCount() > 0 ){
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
        $peli = $stmt->fetch();
        return $peli;
    }
    return null;    
}

private $codigo_pelicula;
private $nombre;
private $director;
private $genero;
private $imagen;


public static function closeDB(){
    self::$dbh = null;
}

} // class

