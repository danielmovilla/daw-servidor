<?php

require("fpdf185/fpdf.php");
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B', 13);
$pdf->Cell(0,10, 'Listado de peliculas', 0, 0, 'C');
$pdf->Ln(15);
$pdf->SetFont('Arial','B', 10);

$peliculas =  ModeloUserDB::GetAll();
$pdf->Cell(20,10, 'Codigo');
$pdf->Cell(70,10, 'Nombre');
$pdf->Cell(70,10, 'Director');
$pdf->Cell(70,10, 'Genero');
$pdf->Ln(15);


foreach ($peliculas as $pelicula){
    $pdf->Cell( 20, 0,  $pelicula->codigo_pelicula );
    $pdf->Cell( 70, 0, $pelicula->nombre);
    $pdf->Cell( 70, 0, $pelicula->director);
    $pdf->Cell( 70, 0, $pelicula->genero);
    $pdf->Ln(15);
}

$pdf->Output();

?>