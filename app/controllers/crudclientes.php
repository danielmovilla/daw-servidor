<?php

function crudBorrar($id) {
    $db = AccesoDatos::getModelo();
    $tuser = $db->borrarCliente($id);
}

function crudTerminar() {
    AccesoDatos::closeModelo();
    session_destroy();
}

function crudAlta() {
    $cli = new Cliente();
    $orden = "Nuevo";
    include_once "app/views/formulario.php";
}

function crudDetalles($id) {
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    include_once "app/views/detalles.php";
}

function crudDetallesSiguiente($id) {
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteSiguiente($id);
    if ($cli) {
        include_once "app/views/detalles.php";
    } else {
        crudDetalles($id);
    }
}

function crudDetallesAnterior($id) {
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteAnterior($id);
    if ($cli) {
        include_once "app/views/detalles.php";
    } else {
        crudDetalles($id);
    }
}


function crudModificar($id) {
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    $orden = "Modificar";
    include_once "app/views/formulario.php";
}

function crudModificarSiguiente($id) {
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteSiguiente($id);
    if ($cli) {
        include_once "app/views/formulario.php";
    } else {
        crudModificar($id);
    }
}
function crudModificarAnterior($id) {
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteAnterior($id);
    if ($cli) {
        include_once "app/views/formulario.php";
    } else {
        crudModificar($id);
    }
}

function crudPostAlta() {
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $cli = new Cliente();
    $cli->id            = $_POST['id'];
    $cli->first_name    = $_POST['first_name'];
    $cli->last_name     = $_POST['last_name'];
    $cli->email         = $_POST['email'];
    $cli->gender        = $_POST['gender'];
    $cli->ip_address    = $_POST['ip_address'];
    $cli->telefono      = $_POST['telefono'];
    $db = AccesoDatos::getModelo();
    $db->addCliente($cli);
}

function crudPostModificar() {
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $cli = new Cliente();

    $cli->id            = $_POST['id'];
    $cli->first_name    = $_POST['first_name'];
    $cli->last_name     = $_POST['last_name'];
    $cli->email         = $_POST['email'];
    $cli->gender        = $_POST['gender'];
    $cli->ip_address    = $_POST['ip_address'];
    $cli->telefono      = $_POST['telefono'];
    $db = AccesoDatos::getModelo();
    $db->modCliente($cli);
}

function crudImprimir($id) {
    
        require('fpdf185\fpdf.php');
        $db = AccesoDatos::getModelo();
        $cli = $db->getCliente($id);
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,20,'Datos del cliente');
        $pdf->Ln();
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(20,10,'ID: '.$cli->id);
        $pdf->Ln();
        $pdf->Cell(20,10,'Nombre: '.$cli->first_name);
        $pdf->Ln();
        $pdf->Cell(20,10,'Apellido: '.$cli->last_name);
        $pdf->Ln();
        $pdf->Cell(20,10,'Email: '.$cli->email);
        $pdf->Ln();
        $pdf->Cell(20,10,'Genero: '.$cli->gender);
        $pdf->Ln();
        $pdf->Cell(20,10,'IP: '.$cli->ip_address);
        $pdf->Ln();
        $pdf->Cell(20,10,'Telefono: '.$cli->telefono);
        $pdf->Ln();
        $pdf->Cell(20,10,'Foto: ');

        if(file_exists("app/uploads/".$cli->id.".jpg")){
            $pdf->Image("app/uploads/".$cli->id.".jpg", 10, 80, 50, 50);
        }else {

             $imagen=file_get_contents('https://robohash.org/'.$cli->id);
            file_put_contents('app/uploads/'.$cli->id.'.png',$imagen);
            $pdf->Image('app/uploads/'.$cli->id.'.png', 0, 100, 90, 80, 'PNG', 'http://www.fpdf.org');
        }
        $pdf->Ln();
        
        $pdf->Output();
        //ob
        $pdf->Output('app\fpdf185\fpdf.php','F');
        header('Location: app\\fpdf185\fpdf.php');
    


}

function mostrarFoto($id)
{

    define("DIRECTORIO", 'app\uploads\\');
    $ceros = 0;
    $fichero = str_pad($ceros, 7, "0", STR_PAD_LEFT);
    $nombreFichero = substr($fichero, 0, 8 - strlen($id)) . $id;
    $fichero = 'app/uploads/' . $nombreFichero . '.jpg';

    return "<img src='https://robohash.org/$id' width='20' alt='Foto perfil robot'>";
}

function mostrarMapa($ip)
{
    $url = "http://ip-api.com/json/" . $ip;
    $json = file_get_contents($url);
    $datos = json_decode($json, true);

    if ($datos['status'] == "fail") {
        echo "Debido a la política de privacidad de Google Maps no podemos mostrar la ubicación de este usuario.";
    } else {
        $latitud = $datos['lat'];
        $longitud = $datos['lon'];
        echo "<iframe src='https://maps.google.com/maps?q=$latitud,$longitud&z=15&output=embed' width='250' height='300' frameborder='0' style='border:0' allowfullscreen></iframe>";
    }
}

function mostrarBandera($ip){

    $pais=file_get_contents('http://ip-api.com/json/'.$ip.'?fields=countryCode');
    $pais=substr($pais,16,2);
    $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
    if($ipdat->geoplugin_countryCode == null) {
      echo "<img src='https://media.tenor.com/IHdlTRsmcS4AAAAC/404.gif' width='20' alt='Oops...'>";
    } else {
        $codigo=$ipdat->geoplugin_countryCode;
        echo "<img src='https://flagcdn.com/".strtolower($codigo).".svg' width='10' alt='Bandera pais'>";
    }

}

// if (comprobarDatos($cli, $cli->email, $cli->ip_address, $cli->telefono)) {
//     $db->addCliente($cli);
// } else {
//     $orden = "Nuevo";
//     include_once "app/views/formulario.php";
// }
    ?>
