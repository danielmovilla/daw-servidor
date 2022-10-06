<?php

    // 1. Funciones principales
        $arrayDados = [];
        $arrayDadosResultado = [];
        $arrayDados = [
            1 => "&#9856;",
            2 => "&#9857;",
            3 => "&#9858;",
            4 => "&#9859;",
            5 => "&#9860;",
            6 => "&#9861;"
        ];
        define("arrayDados", $arrayDados);
        const ARRAYMENSAJES = ["Ha sucedido un empate.", "¡Ha ganado el jugador 1!", "¡Ha ganado el jugador 2!"];

        // 2. Generamos el array con los resultados
        function resultados ()
        {
            for ($i = 0; $i < count(arrayDados); $i++) {
                    $dado = random_int(1, 6);
                    $arrayDadosResultado[] = $dado;
                }
                return $arrayDadosResultado;
        }

        // 3. Hacemos los resultados
        function sumaResultado ($resultado)
        {
            $mayor = max($resultado);
            $menor = min($resultado);
            $mayorPasado = 2; // Ponemos 2 debido a que son los dados que
            $menorPasado = 2; // vamos a sacar fuera debido al juego
            $suma = 0;

            // 3B. Sistema para cotejar que el valor más grande (mayor) y el valor más pequeño (menor) se
            // guarda en menorPasado y mayorPasado para que vaya pasando el array.
            foreach ($resultado as $value) {
                $mayorPasado = ($value == $mayor) ? $mayorPasado - 1 : $mayorPasado;
                $menorPasado = ($value == $menor) ? $menorPasado - 1 : $menorPasado;
                if ($value != $mayor && $value != $menor) {
                    $suma += $value;
                } elseif ($value == $mayor && $mayorPasado < 1) {
                    $suma += $value;
                } elseif ($value == $menor && $menorPasado < 1) {
                    $suma += $value;
                }
            }

            return $suma;
        }

        // 4. Recorremos el array y ponemos el valor del dado con su respectivo dado (mirar parte 1).
        function pintaDados ($resultado)
        {
            foreach ($resultado as $key => $value) {
                $dado = arrayDados[$value];
                echo ("$dado");
            }
        }

        // 5. Generamos el sistema de partida para saber quién es el ganador.
        // Si sale 0 retornamos 0 (empate), si sale más gana jugador 
        // 1 y si sale menos gana jugador 2.
        function partida ($suma1, $suma2)
        {
            $retorno = null;
            $resultadoPartida = $suma2 - $suma1;
            if ($resultadoPartida == 0) {
                return 0;
            }
            $retorno = ($resultadoPartida < 0) ? 1 : 2;
            return $retorno;
        }

        // 6. Pintamos el mensaje 
        function colorMensaje ($partida)
        {
            return ARRAYMENSAJES[$partida];
        }

        // 7. Funciones principales
        $jugador1 = resultados(); // 7a. Sacamos los valores
        $jugador2 = resultados();

        $suma1 = sumaResultado($jugador1); // 7b. Sacamos la suma
        $suma2 = sumaResultado($jugador2);

        $partida = partida($suma1, $suma2); // 7c. Sacamos la partida

        $color = colorVencedor($partida); // 7d. Sacamos el color final

        // 8. Sacamos el color final desde 7d
        function colorVencedor($partida)
        {
            switch ($partida) {
                case 0:
                    return "green";
                case 1:
                    return "blue";
                case 2:
                    return "orange";
            }
        }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Los cinco dados</title>
    <style>
        body {
            font-size: 40px;
        }

        .jugador1 {
            font-size: 30px;
            color: blue;
            margin: 5px 2px 2px 5px;
        }

        .jugador2 {
            font-size: 30px;
            color: orange;
            margin: 5px 2px 2px 5px
        }

        .resultado {
            color: <?= $color ?>
        }
    </style>
</head>

<body>
    <table>
        <tr class="jugador1">
            <td> Jugador 1 --------> </td>
            <td><?php pintaDados($jugador1); ?></td>
            <td><?= "¡" . $suma1 . " puntos!"  ?></td>
        </tr>
        <tr class="jugador2">
            <td> Jugador 2 --------> </td>
            <td><?php pintaDados($jugador2); ?></td>
            <td><?= "¡" . $suma2 . " puntos!"  ?></td>
        </tr>
        <tr>
            <td class="resultado"> <?= colorMensaje($partida) ?></td>
        </tr>
    </table>
</body>
</html>
