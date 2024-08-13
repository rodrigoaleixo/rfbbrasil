<?php
require __DIR__ . "/../vendor/autoload.php";

use RodrigoAleixo\RFBrasil\ReceitaFederal;



$pdf = new ReceitaFederal();
$pdf->openPDF("cartao.pdf");


