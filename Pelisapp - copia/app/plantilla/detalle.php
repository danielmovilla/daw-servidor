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
<tr><td>Código de la película </td><td> <?= $userid ?></td></tr>
<tr><td>Nombre   </td><td>   <?= $nombre ?></td></tr>
<tr><td>Director  </td><td>     <?= $director ?></td></tr>
<tr><td>Género </td><td>    <?= $genero  ?></td></tr>
<tr><td>Póster </td><td>    <img src="app/img/<?= $poster ?>" width="100%" height="100%" alt="Poster de la película" /></td></tr>
<tr><td>Tráiler  </td><td><iframe width="560" height="315" src="https://www.youtube.com/embed/<?=$trailer?>" title="YouTube video player" frameborder="0" 
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></td></tr>
</table>
<input type="button" value=" Volver " size="10" onclick="javascript:window.location='index.php'" >
<?php 
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido

$contenido = ob_get_clean();
include_once "principal.php";

?>