<?php
        define ('PIEDRA1',  "&#x1F91C;");
        define ('PIEDRA2',  "&#x1F91B;");
        define ('TIJERAS',  "&#x1F596;");
        define ('PAPEL'  ,  "&#x1F91A;" );
    
        // 1. Funciones
            // 1A. Partida (.php) - Primero derecha y luego izquierda
            $jugador1    = generaNumero();
            $pinta1      = pintaSalidaDerecha($jugador1);

            $jugador2    = generaNumero();
            $pinta2      = pintaSalidaIzquierda($jugador2);

            $tirada      = tirada($jugador1, $jugador2);
            // 1B. Mensaje (.php)
            $mensaje     = generaMensaje($tirada);
    
        // 2. Sacamos el resultado
            function generaNumero(){
        return random_int(1,3); // Siendo Piedra (1), Papel (2) y Tijeras (3)
    }

        // 3. Sacamos el resultado de la tirada
    function tirada($jugador1, $jugador2){

        if ($jugador1 == $jugador2)
        { return 0; } // Caso de empate
        if ($jugador1 == 1 && $jugador2 == 2)
        { return 2; } // 1 - Piedra y 2 - Papel
        if ($jugador1 == 1 && $jugador2 == 3)
        { return 1; } // 1 - Piedra y 3 - Tijeras
        if ($jugador1 == 2 && $jugador2 == 1)
        { return 1; } // 2 - Papel y  1 - Piedra
        if ($jugador1 == 2 && $jugador2 == 3)
        { return 2; } // 2 - Papel y  3 - Tijeras
        if ($jugador1 == 3 && $jugador2 == 1)
        { return 1; } // 3 - Papel y  1 - Piedra
        if ($jugador1 == 3 && $jugador2 == 2)
        { return 2; } // 3 - Papel y  2 - Papel
        
    }
        
    // Salida hacia derecha de PIEDRA1
    function pintaSalidaDerecha ($salida) {

        switch ($salida) {
            case 1:
                return PIEDRA1;
            case 2:
                return PAPEL;
            case 3:
                return TIJERAS;
        }
    }

    //Salida hacia izquierda de PIEDRA2
    function pintaSalidaIzquierda ($salida) {

        switch ($salida) {
            case 1:
                return PIEDRA2;
            case 2:
                return PAPEL;
            case 3:
                return TIJERAS;
        }
    }

    function generaMensaje($tirada) {

       $mensaje=($tirada==0)?"Empate":"El ganador es el jugador  $tirada";
       return $mensaje;
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        td{
            font-size: 125px;
        }
        .mensajeJugador{
            font-size: 100px;
        }
        .mensaje{
            font-size: 50px;
        }
    </style>
    <title> ¡Piedra, papel o tijera! </title>
</head>

<body>
    <table>
        <tr>
            <td class="jugador1">
                <div class="mensajeJugador">Jugador 1</div>
                <?= $pinta1 ?> <!-- Pintamos la derecha !-->
            </td>
                <td class="jugador2">
                <div class="mensajeJugador">Jugador 2</div>
                <?= $pinta2 ?> <!-- Pintamos la izquierda !-->
            </td>
        </tr>
        <tr>
            <td class="mensaje" colspan="2"><?=$mensaje ?></td>
            <!-- Sacamos el mensaje de victoria !-->
        </tr>
    </table>
</body>

</html>
