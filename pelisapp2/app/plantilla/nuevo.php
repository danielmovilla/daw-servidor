<?php

// Iniciar el bufer de salida
ob_start();

?>
<h2> Nueva película</h2> 
<form action="index.php?orden=Insertar" method="post" enctype="multipart/form-data">
<fieldset>
    <legend> Datos de la película </legend>
    <table>
        <tr>
            <td> <label>Nº - automático</label> </td>
            <td> <input type="text" name="codigoNuevo" placeholder="/!\ No introducir ningún dato." readonly value="" size="50" maxlength="50" required> </input> </td>
        </tr>
        <tr>
            <td> <label>Nombre</label> </td>
            <td> <input type="text" name="nombre" value="" size="50" maxlength="50" required> </input> </td>
        </tr>
        <tr>
            <td> <label>Director</label> </td>
            <td> <input type="text" name="director" value="" size="50" maxlength="50" required> </input> </td>
        </tr>
        <tr>
            <td> <label>Género</label> </td>
            <td> <input type="text" name="genero" value="" size="50" maxlength="50" required> </input> </td>
        </tr>
        <tr>
            <td> <label>Póster</label> </td>
            <td> <input type="file" name="poster" value=""> </input> </td>
        </tr>
        <tr>
            <td> <label>URL del tráiler</label> </td>
            <td> <input type="text" name="link" value="" size="50" maxlength="50" required> </input> </td>
        </tr>
    </table>
</fieldset>
<button name="orden" value="Insertar" type="submit"> Enviar </button>
</form>

<input type="button" value="Volver" size="10" onclick="javascript:window.location='index.php'" >
<?php 

$contenido = ob_get_clean();
include_once "principal.php";

?>