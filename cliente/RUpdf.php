<?php
require("lib/fpdf186/fpdf.php");
class PDF extends FPDF
{
    function Header()
    {
        $this->Image("img/logo.png", 10, 8, 33);

        $this->setFont("Arial", 'B', 15);

        $this->Cell(60, 10, 'Reporte de usuarios existentes', 0, 0, 'C');

        $this->Ln(30);
        $this->SetFillColor(171,195,250); //color a la selda
        $this->SetTextColor(000,000,000); //color de texto
        $this->SetFont("Arial", 'B', 12);

        $this->Cell(30, 10, 'Nombre', 1, 0, 'C', true);
        $this->Cell(40, 10, 'APaterno', 1, 0, 'C', true);
        $this->Cell(40, 10, 'AMaterno', 1, 0, 'C',true);
        $this->Cell(100, 10, 'Correo', 1, 0, 'C', true);
        $this->Cell(40, 10, 'Telefono', 1, 0, 'C', true);

        $this->Ln();
    }

    function Footer() {
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(0,10,'Pagina'.$this->PageNo(),0, 0, 'C');
    }
}
require("../servidor/conexion.php");
$consulta = "SELECT * FROM usuarios";
$resultado = mysqli_query($conexion, $consulta);
$pdf=new PDF('L');

$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);
while($row=$resultado->fetch_assoc()){
    $pdf->Cell(30,10,$row['unombre'], 1, 0, 'C');
    $pdf->Cell(40,10,$row['uap'], 1, 0, 'C');
    $pdf->Cell(40,10,$row['uam'], 1, 0, 'C');
    $pdf->Cell(100,10,$row['ucorreo'], 1, 0, 'C');
    $pdf->Cell(40,10,$row['utelefono'], 1, 0, 'C');

    $pdf->Ln();

}
$pdf->Output();
?>