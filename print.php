<?php
require('fpdf/fpdf.php');

//db connection
$con = mysqli_connect('localhost','root','');
mysqli_select_db($con,'inventory_auto');

//get invoices data
$sql2 = "UPDATE cart SET quantity =1";
	mysqli_query($con, $sql2);
$query = mysqli_query($con,"select * from cart");
//$invoices = mysqli_fetch_array($query);

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm
$num= mt_rand(10,1000);
$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130  ,5,'Playtech',0,0);
$pdf->Cell(59 ,5,'Invoice',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','B',12);

$pdf->Cell(130  ,5,'KLEMSCET',0,0);
$pdf->Cell(59 ,5,'',0,1);//end of line

$pdf->Cell(130  ,5,'Belagavi',0,0);
$pdf->Cell(25 ,5,'Date : ',0,0);
$pdf->Cell(34 ,5,date('Y/m/d'),0,1);//end of line

$pdf->Cell(130  ,5,'Phone 9481706372',0,0);
$pdf->Cell(25 ,5,'Invoice Id',0,0);
$pdf->Cell(34 ,5,$num,0,1);//end of line

//$pdf->Cell(130  ,5,'Fax [+12345678]',0,0);
$pdf->Cell(25 ,5,'Employee_ID:1001',0,0);
//$pdf->Cell(34 ,5,$invoice['clientID'],0,1);//end of line


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30 ,10,'',0,1,'C');
$pdf->Cell(30, 10, 'Id',1,0,'C');
$pdf->Cell(30, 10, 'product_name',1,0,'C');
$pdf->Cell(30, 10, 'Quantity',1,0,'C');
$pdf->Cell(30, 10, 'sale_price',1,0,'C');
//$pdf->Cell(30, 10, 'Total',1,0,'C');
//$pdf->Cell(50, 10, 'date',1,0,'C');
//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);
$i=1;
$sum=0;

while($invoice= mysqli_fetch_array($query))
{

  	$result=$invoice['quantity']*$invoice['sale_price'];
               	$sum=$sum+$result;

              	
//billing address
//$pdf->Cell(100  ,5,'Bill to',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(30 ,10,'',0,1,'C');
//$pdf->Cell(50 ,10, $i, 1,0,'C');
$pdf->Cell(30, 10, $invoice['id'],1,0,'C');
$pdf->Cell(30, 10, $invoice['name'],1,0,'C');
$pdf->Cell(30, 10, $invoice['quantity'],1,0,'C');
$pdf->Cell(30, 10, $invoice['sale_price'],1,0,'C');
//$pdf->Cell(30, 10, $invoice['total'],1,0,'C');
$i++;
}
$pdf->Cell(30 ,10,'',0,1,'C');
$pdf->Cell(30, 10, );
$pdf->Cell(30, 10, );
$pdf->Cell(30, 10, 'Total',1,0,'C');
$pdf->Cell(30, 10, $sum,1,0,'C');
//$pdf->header_Table()
$pdf->Output();
$sql1 = "delete from cart";
	mysqli_query($con, $sql1)

?>