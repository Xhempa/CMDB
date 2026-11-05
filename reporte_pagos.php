<?php
require_once('tcpdf/tcpdf.php');
include("conexion.php");

// CREAR PDF
$pdf = new TCPDF();
$pdf->AddPage();

// TÍTULO
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Reporte de Pagos - CMDB', 0, 1, 'C');

$pdf->Ln(5);

// TABLA
$pdf->SetFont('helvetica', '', 10);

$html = '
<table border="1" cellpadding="5">
<tr style="background-color:#f2f2f2;">
<th><b>Cliente</b></th>
<th><b>Monto</b></th>
<th><b>Fecha</b></th>
</tr>
';

// 🔥 CONSULTA CORREGIDA (CON JOIN)
$sql = "
SELECT pagos.*, clientes.nombre 
FROM pagos 
JOIN clientes ON pagos.cliente_id = clientes.id
";

$res = $conexion->query($sql);

while($row = $res->fetch_assoc()){

    $monto = number_format($row['valor'], 0, ',', '.');

    $html .= "
    <tr>
        <td>".$row['nombre']."</td>
        <td>$".$monto."</td>
        <td>".$row['fecha']."</td>
    </tr>";
}

$html .= "</table>";

// IMPRIMIR HTML
$pdf->writeHTML($html, true, false, true, false, '');

// DESCARGAR PDF
$pdf->Output('reporte_pagos.pdf', 'I');
?>