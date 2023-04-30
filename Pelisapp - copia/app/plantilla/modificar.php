<?php

// Recoger el id de la pelicula
$userid = $_GET['codigo'];

// Recoger los datos de la pelicula
$nombre = $peli->nombre;
$director = $peli->director;
$genero = $peli->genero;
$poster = $peli->imagen;
$trailer = $peli->url;

// Iniciar el bufer de salida
ob_start();

// Insertar en el hueco de trailer un video sacado de youtube
$trailer2 = str_replace("https://www.youtube.com/watch?v=","embed/",$trailer);


?>
<h2> Detalles </h2>
<table>
<tr><td>Código de la película </td><td><input readonly type="text" value="<?= $userid ?>"> </input></td></tr>
<tr><td>Nombre </td><td><input type="text" value="<?= $nombre ?>"> </input></td></tr>
<tr><td>Director </td><td><input  type="text" value="<?= $director ?>"> </input></td></tr>
<tr><td>Género </td><td><input type="text" value="<?= $genero ?>"> </input></td></tr>
<tr><td>Póster </td><td><input readonly type="text" value="<?= $poster ?>"> </input></td></tr>
<tr><td>URL del tráiler </td><td><input type="text" value="<?= $trailer ?>"> </input></td></tr>
</table>
<input type="button" value=" Volver " size="10" onclick="javascript:window.location='index.php'" >
<?php 
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido

$contenido = ob_get_clean();
include_once "principal.php";

?>