<?php

// Recoger el id de la pelicula
$userid = $_GET['codigo'];

// Recoger los datos de la pelicula
$nombre = $peli->nombre;
$director = $peli->director;
$genero = $peli->genero;
$poster = $peli->imagen;
$trailer = $peli->url;
$votos = $peli->votos;
$media = $peli->media;

// Insertar en el hueco de trailer un video sacado de youtube
$trailer2 = str_replace("https://www.youtube.com/watch?v=","embed/",$trailer);

// Para los votos
$ruta = $_SERVER['PHP_SELF']."?orden=Votar&codigo=".$peli->codigo_pelicula."&";
$total = "Esta película ha recibido ningún voto";

if ($peli->votos > 0 ) {
    $total = $peli->total_votos/$peli->votos;
}

// Iniciar el bufer de salida
ob_start();

?>
<h2> Detalles </h2>
<style> 
img#voto {
   height: 32px;
   width: 32px; 
}
</style>
<table>
<tr><td>Código de la película </td><td> <?= $userid ?></td></tr>
<tr><td>Nombre   </td><td>   <?= $nombre ?></td></tr>
<tr><td>Director  </td><td>     <?= $director ?></td></tr>
<tr><td>Género </td><td>    <?= $genero  ?></td></tr>
<tr><td>Póster </td><td>    <img src="app/img/<?= $poster ?>" width="100%" height="100%" alt="Poster de la película" /></td></tr>
<tr><td>Tráiler  </td><td><iframe width="560" height="315" src="https://www.youtube.com/embed/<?=$trailer?>" title="YouTube video player" frameborder="0" 
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></td></tr>
<tr><td> Nº de votos: </td><td> <?= $votos ?> </td></tr>
<tr><td> Puntuación media: </td><td> <?= $media ?> </td></tr>
</table>

<form>
    <fieldset>
        <legend> // ¿Qué te ha parecido la película? ¡Vota! //  </legend>        
            <a href="<?= $ruta.'voto=1'?>"><img id="voto" src="web/img/numero-1.png"/> </a>
            <a href="<?= $ruta.'voto=2'?>"><img id="voto" src="web/img/numero-2.png"/> </a>
            <a href="<?= $ruta.'voto=3'?>"><img id="voto" src="web/img/numero-3.png"/> </a>
            <a href="<?= $ruta.'voto=4'?>"><img id="voto" src="web/img/numero-4.png"/> </a>
            <a href="<?= $ruta.'voto=5'?>"><img id="voto" src="web/img/numero-5.png"/> </a>
            <a href="<?= $ruta.'voto=6'?>"><img id="voto" src="web/img/numero-6.png"/> </a>
            <a href="<?= $ruta.'voto=7'?>"><img id="voto" src="web/img/numero-7.png"/> </a>
            <a href="<?= $ruta.'voto=8'?>"><img id="voto" src="web/img/numero-8.png"/> </a>
            <a href="<?= $ruta.'voto=9'?>"><img id="voto" src="web/img/numero-9.png"/> </a>
            <a href="<?= $ruta.'voto=10'?>"><img id="voto" src="web/img/numero-10.png"/> </a>
        </fieldset>
</form>
<input type="button" value=" Volver " size="10" onclick="javascript:window.location='index.php'" >
<?php 
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido

$contenido = ob_get_clean();
include_once "principal.php";

?>

        <!-- <?php for ($i=1; $i<=10; $i++) { ?>
            <a href="index.php?orden=Votar&codigo=<?=$userid?>&voto=<?=$i?>"><img id="voto" src="web/img/numero-<?=$i?>.png"</img></a>
            <?php } ?> -->