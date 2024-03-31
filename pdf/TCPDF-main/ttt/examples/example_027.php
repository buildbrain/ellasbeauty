<?php
// Incluir la biblioteca TCPDF
require_once('tcpdf_include.php');

// Crear un nuevo objeto TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(25.4, 50.8), true, 'UTF-8', false);

// Configurar la información del documento

// Establecer los márgenes

// Tamaño del código de barras
$barcodeWidth = 20; // Ancho del código de barras
$barcodeHeight = 3; // Altura del código de barras
$barcodeMargin = 0; // Margen alrededor del código de barras

// Crear una nueva página
$pdf->AddPage();

// Nombre del producto
$nombreProducto = "Pestañas 1 par";
$pdf->SetFont('helvetica', '5', 5);
$nombreWidth = $pdf->GetStringWidth($nombreProducto);
$pdf->Cell(0, 0, $nombreProducto, 0, 1, 'C');

// Precio del producto
$precioProducto = "99 L";
$pdf->SetFont('helvetica', 'B', 6);
$precioWidth = $pdf->GetStringWidth($precioProducto);
$pdf->Cell(0, 0, $precioProducto, 0, 1, 'C');

// Calcular el ancho total del contenido
$contentWidth = max($nombreWidth, $precioWidth);

// Calcular la posición X para centrar el contenido horizontalmente
$centerX = ($pdf->getPageWidth() - $contentWidth) / 2;

// Generar el código de barras
$barcode = '00990099';
$barcodeStringWidth = $pdf->GetStringWidth($barcode);
$halfBarcodeWidth = $barcodeStringWidth / 2;
$pdf->write1DBarcode($barcode, 'C128', $centerX - $halfBarcodeWidth - $barcodeMargin, null, $barcodeWidth + 2 * $barcodeMargin, $barcodeHeight + 2 * $barcodeMargin, 0.4, $style = null, 'N');

// Mostrar el número de código debajo del código de barras
$pdf->SetFont('helvetica', '', 6);
$pdf->Cell(0, 0, $barcode, 0, 1, 'C');

// Mover a la posición X centrada
$pdf->SetXY($centerX, null);

// Salida del PDF
$pdf->Output('etiqueta_producto.pdf', 'I');
?>
