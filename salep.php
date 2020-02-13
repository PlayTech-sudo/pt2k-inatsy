<?php
require('fpdf/fpdf.php');

//db connection
$con = mysqli_connect('localhost','root','');
mysqli_select_db($con,'inventory_auto');

//get invoices data
$query = mysqli_query($con,"select * from sales");
//$invoices = mysqli_fetch_array($query);

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');



$pdf->AddPage();

$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130	,5,'                                         Sales Report ',0,0,'C');


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(35	,10,'',0,1,'C');
$pdf->Cell(35, 10, 'Id',1,0,'C');
$pdf->Cell(35, 10, 'product_id',1,0,'C');
$pdf->Cell(35, 10, 'Quantity',1,0,'C');
$pdf->Cell(35, 10, 'price',1,0,'C');
$pdf->Cell(50, 10, 'date',1,0,'C');
//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

while($invoice= mysqli_fetch_array($query))
{

//billing address
//$pdf->Cell(100	,5,'Bill to',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(35	,10,'',0,1,'C');
$pdf->Cell(35, 10,$invoice['id'],1,0,'C');
$pdf->Cell(35, 10, $invoice['product_id'],1,0,'C');
$pdf->Cell(35, 10, $invoice['qty'],1,0,'C');
$pdf->Cell(35, 10, $invoice['price'],1,0,'C');
//$pdf->Cell(50, 10, $invoice['total'],1,0,'C');
$pdf->Cell(50, 10, $invoice['date'],1,0,'C');

}
//$pdf->header_Table()
$pdf->Output();
?>