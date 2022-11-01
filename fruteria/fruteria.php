<?php
//Iniciamos sesión
session_start();
    $terminar=false;
    
//Si no existe cliente se cogen los datos por get, se limpian y se crea sesión de cliente

if (isset ($_GET['cliente']) ) {
    
    $nombre = $_GET['cliente'];
    $nombre = trim($nombre);
    $nombre = htmlspecialchars($nombre);
    $nombre = stripslashes($nombre);
    $_SESSION["cliente_"] = $nombre;
}
?>
 <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>frutería</title>
    </head>

    <body>
        <h1>La Frutería del siglo XXI</h1>
        <h2>BIENVENIDO A LA NUESTRA FRUTERÍA DEL SIGLO XXI</h2>
<?php

//Si cliente está vacío se muestra el html de formulario de inicio 
if (!isset($_GET['cliente'])) {
?>
        <form action="laFruteria.php" method="GET">
            <p>
                <label for="">Introduzca su nombre de cliente: </label>
                <input type="text" name="cliente">
            </p>
        </form>
<?php
//Si no está vacío se cogen los datos de cliente y el html de elegir frutas
}else{
    
    //Si se pulsa anotar se crea sesión de frutas y se va acumulando el array
    if (isset($_POST["anotar"])) {
        //Si no existe la sesión de listadecompra se crea nueva y se agregan los datos
        if(!isset($_SESSION["listadecompra"])){
            $_SESSION["listadecompra"]=[];
            $elegida = "";
            $cantidad = 0;
            $elegida = $_POST["fruta"];
            $cantidad = $_POST["cantidad"];
            if($cantidad!=0){
                $_SESSION["listadecompra"]=array($elegida=>$cantidad);
            }
            
        //Si existe la sesión se conserva el array de sesión y se agregan los datos que el usuario anota
        }elseif (isset($_SESSION["listadecompra"])){
            $elegida = "";
            $cantidad = 0;
            $elegida = $_POST["fruta"];
            $cantidad = $_POST["cantidad"];
            //Se van incrementando las cantidades de las claves que ya se han anotado
            foreach($_SESSION["listadecompra"] as $clave=>$valor){
                if($elegida==$clave){
                    if($cantidad!=0){
                        $cantidad=$valor+$cantidad;
                    }
                    
                }
            }
            $_SESSION["listadecompra"][$elegida] = $cantidad;
        }
    }
//Si se pulsa terminar se cierra la sesión
    
//Si cliente no está vacío se muestra el html con el nombre de cliene y con los datos de la lista de compra
//Si existen datos de fruta se muestra el formulario con la lista del carrito

    if(isset($_POST['terminar'])){
    ?>
        <h6>Este es su pedido:</h6>
        <table border="1">
            <th>Fruta</th>
            <th>Cantidad</th>
            <?php
            //Se muestran los datos de la compra en formato tabla y se deja al cliente que siga agregando artículos al carrito
            foreach($_SESSION["listadecompra"] as $clave=>$valor){
                echo "<tr>";
                echo "<td>".$clave."</td>";
                echo "<td>".$valor."</td>";
                echo "</tr>";
            }
            ?>
        </table>
    <h2>MUCHAS GRACIAS POR SU COMPRA</h2>
    <?php echo "<input type='button' name='nuevo_cliente' value='NUEVO CLIENTE' onclick='location.href=\"" . $_SERVER['PHP_SELF'] . "\"' >";?>
    <?php session_destroy();?>
    </body>
    <?php
    }
    elseif(isset($_POST["fruta"])){
        ?>
        <h6>Este es su pedido:</h6>
        <table border="1">
            <th>Fruta</th>
            <th>Cantidad</th>
            <?php
            //Se muestran los datos de la compra en formato tabla y se deja al cliente que siga agregando artículos al carrito
            foreach($_SESSION["listadecompra"] as $clave=>$valor){
                echo "<tr>";
                echo "<td>".$clave."</td>";
                echo "<td>".$valor."</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <h2>REALICE SU COMPRA <?php echo $nombre ?></h2>
        <form action="#" method="POST">
            <p>
                <label for="">Selecciona la fruta: </label>
                <select name="fruta">
                    <option>Platanos</option>
                    <option>Naranjas</option>
                    <option>Limones</option>
                </select>
            </p>
            
            <p>
                <input type="number" name="cantidad">
            </p>
            <input type="submit" name="anotar" value="ANOTAR">
            <input type="submit" name="terminar" value="TERMINAR">
        </form>
        <?php

    }elseif(!isset($_POST["fruta"])){
        //Si no existen datos de fruta se muestra el formulario sin datos del carrito
        ?>
        <h2>REALICE SU COMPRA <?php echo $nombre ?></h2>
        <form action="#" method="POST">
            <p>
                <label for="">Selecciona la fruta: </label>
                <select name="fruta">
                    <option>Platanos</option>
                    <option>Naranjas</option>
                    <option>Limones</option>
                </select>
            </p>
            <p>
                <input type="number" name="cantidad">
            </p>
            <input type="submit" name="anotar" value="ANOTAR">
            <input type="submit" name="terminar" value="TERMINAR">
        </form>
<?php
    }
}
?>
   </body>
 </html>