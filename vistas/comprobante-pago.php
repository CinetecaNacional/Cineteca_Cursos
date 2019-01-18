<?php
require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

require_once 'vista-comprobante-pago.php';
$html = ob_get_clean();
$html2pdf = new Html2Pdf('P', 'A4', 'es', 'true', 'UTF-8');
$html2pdf -> writeHTML($html);
$html2pdf->output('Orden de pago del curso.pdf');
?>
