<?php
include_once 'app/Pelicula.php';
// Ruta del propio script 
$ruta = $_SERVER['PHP_SELF'];
// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();

?>


<table>
<th> Nº </th><th>Nombre</th><th>Director</th><th>Género</th>
<?php foreach ($peliculas as $peli) : ?>
<tr>		
<td><b><?= $peli->codigo_pelicula ?></b></td>
<td><?= $peli->nombre ?></td>
<td><?= $peli->director ?></td>
<td><?= $peli->genero ?></td>
<!-- -->
<td><a href="<?= $ruta?>?orden=Borrar&codigo=<?=$peli->codigo_pelicula?>"  onclick="confirmarBorrar('<?= $peli->nombre."','".$peli->codigo_pelicula."'"?>);"><img src="web/img/trash.png"</img></a></td>
<td><a href="<?= $ruta?>?orden=Modificar&codigo=<?=$peli->codigo_pelicula?>"><img src="web/img/pen-square.png"</img></a></td>
<!-- --> 
<td><a href="<?= $ruta?>?orden=Detalles&codigo=<?= $peli->codigo_pelicula?>"><img src="web/img/file-circle-info.png"</img></a></td>
</tr>
<?php endforeach; ?>
</table>
<br>
<form name='f2' action='index.php'>
<a href="index.php?orden=Alta"><img src="web/img/add-document.png"</img></a>
<a href="index.php?orden=ImprimirPDF"><img src="web/img/print-info.png"/></a>
<a href="index.php?orden=ImprimirJSON"><img src="web/img/print-json.png"/></a>
</form>
<?php
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido de la página principal
$contenido = ob_get_clean();
include_once "principal.php";

?>