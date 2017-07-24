<?php 
	include '../db.php';
	$InvDate = $_GET["InvDate"];
	$CustumerNum = $_GET["CustumerNum"];
	$InvNumber = $_GET["InvNumber"];
	$idUsuario  = 1;
	$idPagina = 0;
	$query = $db->query("CALL spLoadInvoice('".$InvDate."',".$CustumerNum.",".$InvNumber.")");
	$row =  $query->fetchAll(PDO::FETCH_NUM);
	//$QueryBitacora = $db->query("CALL spInsBitacora('spLoadInvoice',".$row[0][0].",'". date("Y-m-d")."',".$idUsuario.",".$idPagina.")");
		//echo "CALL spInsBitacora('spLoadInvoice',".$row[0][0].",'". date("Y-m-d")."',".$idUsuario.",".$idPagina.")" ;
	echo $row[0][0];
	
 ?>