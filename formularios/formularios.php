<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PARTE PHP </title>
</head>
<body>
    <script>
        <?php
        print "<pre>";
        print_r($_REQUEST);
        print "</pre>\n";
        ?> 
        
        // Primer test: para el tamaño
        for ($i=0; $i < count($array['archivos']['size']); $i++) { 
                    $suma += $array['archivos']['size'][$i];
                }
                if ($suma > 300000) {
                    echo "Se supera el límite de tamaño de archivos total.";
                }
                echo "No se supera el límite de tamaño total.";
        }

        // Segundo test: para el formato
        if ($tipo == "image/jpeg" || $tipo == "image/png") {
                    echo "Se respeta el formato.";               
                }
            echo "No se respeta el formato.";
        }
    </script>
</body>
</html>
