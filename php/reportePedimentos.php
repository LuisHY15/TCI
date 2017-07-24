<?php
		$mensaje = "";

		include '../dbReplica.php';
		$DateInicial =  $_GET['DateInicial'];
		$DateFinal =  $_GET['DateFinal'];
		$tipop = $_GET['tipop'];
		$cve = $_GET['cve'];
		$fechaInicial 		= date('Y-m-d', strtotime($DateInicial));
		$fechaFinal 		= date('Y-m-d', strtotime($DateFinal));
		$NoCliente      	= $_GET['txtClave'];
		$Aduana = $_GET['AduSec'];
		$array1 = array();
		$array2 = array();
		$array3 = array();
		$array4 = array();
		$IGIIGE 		= 0;
		$DTA    		= 0;
		$IVA    		= 0;
		$PREV   		= 0;
		$TodosImpuesto 	= 0;
		$IdTemporal = 0;
		$Consulta1 ="SELECT SQL_BIG_RESULT C001PATEN AS PATENTE,
		C001ADUSEC AS ADUANA,
		C001REFPED AS REFERENCIA,
		C001NUMPED AS NUMEROPEDIMENTO,
		D001FECPAG AS FECHAPAGO,
		C001CVEDOC AS CLAVE,
		F001VALCOE AS VALORCOMERCIAL,
		N001TOTINC AS INCREMENTABLE,
		F001TIPCAM AS TIPODECAMBIO, 
		C001TIPREG AS REGIMEN,
		C001FIRELE AS FIRMAVALIDACION,
		C001FIRBAN AS FIRMAPAGO,
		C001MEDTRS AS MEDIOTRANSPORTE 
		FROM AT001 
		WHERE  C001CVECLI = '".$NoCliente."' AND C001TIPOPE=".$tipop." AND  C001CVEDOC='".$cve."' AND C001ADUSEC='".$Aduana."' AND  D001FECPAG BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' ORDER BY(D001FECPAG)";
		$query1 =$bdd->prepare($Consulta1);
		$query1->execute();
		while($row1 = $query1->fetch(PDO::FETCH_OBJ)){
			$IdTemporal = $IdTemporal + 1;
			$arrayTemp = array( "IdTemporal"=>$IdTemporal
								,"PATENTE" => $row1->PATENTE
								,"ADUANA"=>$row1->ADUANA
								,"REFERENCIA"=>$row1->REFERENCIA
								,"NUMEROPEDIMENTO"=>$row1->NUMEROPEDIMENTO
								,"FECHAPAGO"=>$row1->FECHAPAGO
								,"CLAVE"=>$row1->CLAVE
								,"VALORCOMERCIAL"=>$row1->VALORCOMERCIAL
								,"INCREMENTABLE"=>$row1->INCREMENTABLE
								,"TIPODECAMBIO"=>$row1->TIPODECAMBIO
								,"REGIMEN"=>$row1->REGIMEN
								,"FIRMAVALIDACION"=>$row1->FIRMAVALIDACION
								,"FIRMAPAGO"=>$row1->FIRMAPAGO
								,"MEDIOTRANSPORTE"=>$row1->MEDIOTRANSPORTE);
			array_push($array1, $arrayTemp);
		}
		echo 'Consulta 1  : '.$Consulta1;
		for ($i=0; $i <count($array1); $i++) { 
			//CONSULTA AT005
			$consulta2 = "SELECT SQL_SMALL_RESULT  C005NOMPRO AS PROVEEDOR
								,C005NUMFAC AS FACTURA
								,D005FECFAC AS FECHAFACTURA
								,C005EDOC AS COVE
								, C005IDEPRO AS TAXID
								, C005PAISPR AS IDPAIS 
						 FROM AT005 
						 WHERE C005REFPED='".$array1[$i]["REFERENCIA"]."' AND C005NUMPED='".$array1[$i]["NUMEROPEDIMENTO"]."'";
			$query2 = $bdd->prepare($consulta2);
			$query2->execute();
			$arrayTemp2 = array();
			//echo 'Consulta 2 :'. $consulta2;
			while ($row =$query2->fetch(PDO::FETCH_OBJ) ) {
				array_push($arrayTemp2 , $array1[$i]["IdTemporal"]
										,$row->PROVEEDOR
										,$row->FACTURA
										,$row->FECHAFACTURA
										,$row->COVE
										,$row->TAXID
										,$row->IDPAIS);
			}
			array_push($array2,$arrayTemp2);
			//CONSULTA AT016
			$consulta3 ="SELECT  SQL_SMALL_RESULT C016FRAC AS FRACCION
								,C016DESMER AS DESCRIPCION
								,F016CANUMC AS CANTIDAD
								,F016VALDOL AS VALDOLARES
								,C016PAISOD AS PV
								,C016PAISCV AS PO
								,N016VALCOM AS VALORP 
						 FROM AT016 
						 WHERE C016NUMPED='".$array1[$i]["NUMEROPEDIMENTO"]."' AND C016REFPED='".$array1[$i]["REFERENCIA"]."' LIMIT 1";
			$query3 = $bdd->prepare($consulta3);
			$query3->execute();
			while ($row3 =$query3->fetch(PDO::FETCH_OBJ) ) {
				$arrayTemp3 = array("Id16"=>$array1[$i]["IdTemporal"]
									,"FRACCION"=>$row3->FRACCION
									,"DESCRIPCION"=>$row3->DESCRIPCION
									,"CANTIDAD"=>$row3->CANTIDAD
									,"VALDOLARES"=>$row3->VALDOLARES
									,"PV"=>$row3->PV
									,"PO"=>$row3->PO
									,"VALORP"=>$row3->VALORP);
				array_push($array3,$arrayTemp3);
			}
			//CONSULTA AT008
			$consulta4 ="SELECT SQL_SMALL_RESULT  C008CVECON AS TITULO
								,N008IMPCON AS VALOR 
						 FROM AT008 
						 WHERE C008NUMPED='".$array1[$i]["NUMEROPEDIMENTO"]."' AND C008REFPED='".$array1[$i]["REFERENCIA"]."'";
			$query4 = $bdd->prepare($consulta4);
			$query4->execute();
			while ($row4 =$query4->fetch(PDO::FETCH_OBJ) ) {
				$arrayTemp4 = array("Id08"=>$array1[$i]["IdTemporal"]
									,"TITULO"=>$row4->TITULO
									,"VALOR"=>$row4->VALOR);
				array_push($array4,$arrayTemp4);
			}
		}
		$arrayFinal =  array();

		for ($i=0; $i < count($array1); $i++) { 
			$arrayTemp5 = array();
			array_push($arrayTemp5,$array1[$i]['IdTemporal']
									,$array1[$i]["PATENTE"],
									$array1[$i]["REFERENCIA"]
									,$array1[$i]["ADUANA"]
									,$array1[$i]["NUMEROPEDIMENTO"]
									,$array1[$i]["FECHAPAGO"]
									,$array1[$i]["CLAVE"]
									,$array1[$i]["TIPODECAMBIO"]
									,$array1[$i]["REGIMEN"]
									,$array1[$i]["FIRMAVALIDACION"],
									$array1[$i]["FIRMAPAGO"],
									$array1[$i]["MEDIOTRANSPORTE"]);
			for ($e=0; $e < count($array3); $e++) { 
				if($array1[$i]["IdTemporal"] == $array3[$e]["Id16"])
				{
				    array_push($arrayTemp5,$array3[$e]["FRACCION"]
				    						,$array3[$i]["DESCRIPCION"]
				    						,$array3[$i]["CANTIDAD"]
				    						,$array3[$i]["VALDOLARES"]
				    						,$array3[$e]["PV"]
				    						,$array3[$i]["PO"]
										,$array3[$e]["VALORP"]);
				}
			}
			array_push($arrayTemp5,$array1[$i]["INCREMENTABLE"]);
		
			for ($v=0; $v < count($array4); $v++) { 

				if($array1[$i]["IdTemporal"] == $array4[$v]["Id08"])
				{		
					//echo $array4[$v]["TITULO"].'-'.$array4[$v]["VALOR"];
					switch ($array4[$v]["TITULO"]) {
						case 'IGI/IGE':
							 $IGIIGE = $array4[$v]["VALOR"];
						case 'DTA':
							 $DTA = $array4[$v]["VALOR"];
						case 'IVA':
							 $IVA = $array4[$v]["VALOR"];
							break;
						case 'PREV':
							 $PREV = $array4[$v]["VALOR"];
							break;						
						default:
							 $TodosImpuesto =  $array4[$v]["VALOR"];
							break;
					}

				}
				
			}
			array_push($arrayTemp5,$IGIIGE,$DTA,$IVA,$PREV,$TodosImpuesto);
			$IGIIGE = 0;
			$DTA = 0;
			$IVA = 0;
			$PREV= 0;
			$TodosImpuesto = 0;
			array_push($arrayFinal, $arrayTemp5);

		}
		
		//print_r($array2);
		//Numero de pedimento echo $array2[0][0];
		//Referencia de pedimento echo $array2[0][1];
	
	require_once 'PHPExcel/PHPExcel.php';
				// Se crea el objeto PHPExcel
				$objPHPExcel = new PHPExcel();
				// Se asignan las propiedades del libro
				$objPHPExcel->getProperties()->setCreator("") //Autor
							 ->setLastModifiedBy("Miriam") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Pedimentos")
							 ->setSubject("")
							 ->setDescription("Reporte")
							 ->setKeywords("Reporte ")
							 ->setCategory("Reporte excel");

				if($tipop == 1){
					$tituloReporte = "REPORTE DE OPERACIONES DE IMPORTACION DEL ".$fechaInicial." AL ".$fechaFinal;
				}else{
					$tituloReporte = "REPORTE DE OPERACIONES DE EXPORTACION DEL ".$fechaInicial." AL ".$fechaFinal;
				}
				

				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(14);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(16);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(70);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(14);
				$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(9);
				$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(9);
				$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(9);
				$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(25);
				$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(35);
				$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(30);
				$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(20);
				$objPHPExcel->setActiveSheetIndex(0)
        		->mergeCells('A1:AD1');

		// Se agregan los titulos del reporte
				$objPHPExcel->setActiveSheetIndex(0)
					 ->setCellValue('A1',$tituloReporte)
					 ->setCellValue('A2',"DEL CLIENTE: <".$NoCliente.">")
    		  		->setCellValue('A3','REFERENCIA')
            		->setCellValue('B3','PATENTE     ')
    				->setCellValue('C3','ADUANA')
        			->setCellValue('D3','PEDIMENTO')
            		->setCellValue('E3','FRACCION')
            		->setCellValue('F3','DESCRIPCION')
            		->setCellValue('G3','CANTIDAD')
            		->setCellValue('H3','VALOR DOLARES')
            		->setCellValue('I3','FECHA DE PAGO')
            		->setCellValue('J3','CLAVE')
            		->setCellValue('K3','P.V')
            		->setCellValue('L3','P.O')
            		->setCellValue('M3','VALOR COMERCIAL')
           		 	->setCellValue('N3','INCREMENTABLE')
            		->setCellValue('O3','AD VALOREM')
            		->setCellValue('P3','D.T.A')
            		->setCellValue('Q3','I.V.A')
            		->setCellValue('R3','PREV')
            		->setCellValue('S3','OTROS IMP.')
            		->setCellValue('T3','PROVEEDOR')
            		->setCellValue('U3','FACTURA')
            		->setCellValue('V3','FECHA PAG.')
            		->setCellValue('W3','TIP. CAMBIO')
            		->setCellValue('X3','COVE')
            		->setCellValue('Y3','TAX-ID')
            		->setCellValue('Z3','ID PAIS')
            		->setCellValue('AA3','REGIMEN')
            		->setCellValue('AB3','FIRMA DE VALIDACION.')
            		->setCellValue('AC3','FIRMA DE PAGO')
            		->setCellValue('AD3','MEDIO DE TRANSPORTE')
            		->setCellValue('AE3','IDENTIFICADOR')
            		->setCellValue('AF3','COMPLEMENTO');

					//Se agregan los datos de los alumnos
					$i = 4;
				for ($a=0; $a < count($arrayFinal); $a++) { 
							$objPHPExcel->setActiveSheetIndex(0)
				    		->setCellValue('A'.$i, $arrayFinal[$a][2])
				            ->setCellValue('B'.$i, $arrayFinal[$a][1])
				    		->setCellValue('C'.$i, $arrayFinal[$a][3])
				            ->setCellValue('D'.$i, $arrayFinal[$a][4])
				            ->setCellValue('E'.$i, $arrayFinal[$a][12])
				            ->setCellValue('F'.$i, $arrayFinal[$a][13])
				            ->setCellValue('G'.$i, $arrayFinal[$a][14])
				            ->setCellValue('H'.$i, $arrayFinal[$a][15])
				            ->setCellValue('I'.$i, $arrayFinal[$a][5])
				            ->setCellValue('J'.$i, $arrayFinal[$a][6])
				            ->setCellValue('K'.$i, $arrayFinal[$a][16])
				            ->setCellValue('L'.$i, $arrayFinal[$a][17])
				            ->setCellValue('M'.$i, $arrayFinal[$a][18])
				            ->setCellValue('N'.$i, $arrayFinal[$a][19])
				            ->setCellValue('O'.$i, $arrayFinal[$a][20])
				            ->setCellValue('P'.$i, $arrayFinal[$a][21])
				            ->setCellValue('Q'.$i, $arrayFinal[$a][22])
				            ->setCellValue('R'.$i, $arrayFinal[$a][23])
				            ->setCellValue('S'.$i, $arrayFinal[$a][24])
				            ->setCellValue('W'.$i, $arrayFinal[$a][7])
				            ->setCellValue('AA'.$i, $arrayFinal[$a][8])
				            ->setCellValue('AB'.$i, $arrayFinal[$a][9])
				            ->setCellValue('AC'.$i, $arrayFinal[$a][10])
				            ->setCellValue('AD'.$i, $arrayFinal[$a][11]);
				            for ($q=0; $q < count($array2); $q++) { 
								$valor = 0;
								$valor = count($array2[$q])/7;
								$valorIncremento = 0;
								for ($c=0; $c < $valor ; $c++) { 
									if ($array2[$q][0] == $arrayFinal[$a][0]) {
										$objPHPExcel->setActiveSheetIndex(0)
					    					->setCellValue('T'.$i, $array2[$a][1+$valorIncremento])
					    					->setCellValue('U'.$i, $array2[$a][2+$valorIncremento])
					    					->setCellValue('V'.$i, $array2[$a][3+$valorIncremento])
					    					->setCellValue('X'.$i, $array2[$a][4+$valorIncremento])
					    					->setCellValue('Y'.$i, $array2[$a][5+$valorIncremento])
					    					->setCellValue('Z'.$i, $array2[$a][6+$valorIncremento]);
					    				if($c != $valor ){
					    					$valorIncremento  = $valorIncremento+7;
					    					$i++;
					    				}	
									}
								}
							}
			
					$i++;
				}
				for($i = 'A'; $i <= 'AD'; $i++){
					$objPHPExcel->setActiveSheetIndex(0)
						->getColumnDimension($i)->setAutoSize(TRUE);
				}
				// Se asigna el nombre a la hoja
				$objPHPExcel->getActiveSheet()->setTitle('Reporte de Pedimentos');
				// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
				$objPHPExcel->setActiveSheetIndex(0);
				// Inmovilizar paneles
				//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
				$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
				// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="Reporte.xlsx"');
				header('Cache-Control: max-age=0');

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		    	ob_end_clean();
				$objWriter->save('php://output');
				exit;
	
	  
	
 ?>