<?php 
require('fpdf/fpdf.php');
include '../db.php';
$id = $_GET["id"];
$sql = "SELECT invcruce.InvCruDateCrossing as DateCrossing, invcruce.InvCruTrailerNumber as trailerNumber, invcruce.InvCruAmount as CruAmount,invcruce.InvCruDescription as Description, invcruce.txtInvCruFrom as CruFrom,invinfo.InvNum as InvNum,invinfo.InvDate as InvDate,invinfo.InvNum as InvNum,invinfo.InvDate as InvDate FROM invcruce join invinfo on invcruce.InvId = invinfo.InvId WHERE invinfo.InvId =".$id;
$querySql = [];
$sum= 0;
$InvId = "";
$InvDate = "";
$query = $db->prepare($sql);
$query->execute();
while ($row = $query->fetch(PDO::FETCH_OBJ))
	{
		$arr = array($row->DateCrossing,$row->trailerNumber,$row->CruAmount,$row->Description,$row->CruFrom);
        $sum = $sum + $row->CruAmount;
        $InvDate = $row->InvDate;
        $InvId = $row->InvNum;
		array_push($querySql, $arr);
	}
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('fpdf/tutorial/logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(50);
    // Título
    $this->Cell(70,50,'TRANSPORTADORA DE COMERCIO INTERNACIONAL, S.A. DE C.V.',90,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
function LoadData($file)
{
    // Leer las líneas del fichero
    $data = array();
    foreach($file as $lines)
        $data[] = $lines;
    return $data;
}

// Tabla coloreada
function FancyTable($header, $data)
{
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(16,16,16);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Cabecera
    $w = array(45, 30, 30, 40,40);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(254,254,254);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Datos
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'C',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'C',$fill);
        $this->Cell($w[2],6,'$'.number_format($row[2]),'LR',0,'C',$fill);
        $this->Cell($w[3],6,$row[3],'LR',0,'C',$fill);
         $this->Cell($w[3],6,$row[4],'LR',0,'C',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}

}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Ln(5);
$pdf->Cell(70,10,'Prolongacion Guerrero 3600               Nuevo Laredo Tamaulipas.  CP. 88270   ',90,0);
$pdf->Ln(5);
$pdf->Cell(70,10,'Tel:.(867) 712-75-21                                 ',90,0);
$pdf->Ln(10);
$pdf->Cell(50,10,'INVOICE # '.$InvId,1,0);
$pdf->Cell(75);
$pdf->Cell(60,10,'INVOICE DATE  '.$InvDate,1,0);
$pdf->Ln(20);
$header = array('DATE OF CROSSING', ' # TRAILER', 'AMOUNT', 'DESCRIPTION','FROM');
// Carga de datos
$data = $pdf->LoadData($querySql);
$pdf->SetFont('Arial','',10);
$pdf->FancyTable($header,$data);
$pdf->Ln(20);
$pdf->Cell(10);
$pdf->Cell(70,10,'TOTAL AMOUNT DUE  $'.$sum,1,0,'C');
$pdf->Cell(40);
$pdf->Cell(70,10,'This Merchandise will be shipped at',0,0,'C');
$pdf->Ln(5);
$pdf->Cell(120);
$pdf->Cell(70,10,'customer risk due to no inssurance.',0,0,'C');
$pdf->Output();

 ?>