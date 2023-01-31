<?php

/*
 *  Funciones para limpiar la entrada de posibles inyecciones
 */

function limpiarEntrada(string $entrada):string{
    $salida = trim($entrada); // Elimina espacios antes y después de los datos
    $salida = strip_tags($salida); // Elimina marcas
    return $salida;
}
// Función para limpiar todos elementos de un array
function limpiarArrayEntrada(array &$entrada){
 
    foreach ($entrada as $key => $value ) {
        $entrada[$key] = limpiarEntrada($value);
    }
}

function comprobarDatos($cli, $email, $ip, $telefono) {
    $db = AccesoDatos::getModelo();
    $access = true;
    $msg = "<script>alert('Los siguientes campos no son validos: ";
    if ($db->checkMail($cli->email) && $cli->email != $email) {
        $access = false;
    } else if (!validarTelefono($telefono)) {
        $access = false;
    } else if (!validarIp($ip)) {
        $access = false;
    } else if (!filter_var($cli->email, FILTER_VALIDATE_EMAIL)) {
        $access = false;
    }
    $msg .= "');</script>";
    if (!$access) echo $msg;
    return $access;
}

function validarTelefono($telefono) {
    return preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{3,4}$/', $telefono);
}

function validarIp($ip) {
    return filter_var($ip, FILTER_VALIDATE_IP);
}
