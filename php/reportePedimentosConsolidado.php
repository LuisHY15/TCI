<?php
		include '../dbReplica.php';
		$arrayFinal = array();
		$DateInicial =  '2017/06/01';
		$DateFinal =  '2017/06/30';
		$fechaInicial 		= date('Y-m-d', strtotime($DateInicial));
		$fechaFinal 		= date('Y-m-d', strtotime($DateFinal));

		$fechaAjustada =  strtotime('+1 day', strtotime($fechaFinal));
		$fechaAjustada = date('Y-m-d', $fechaAjustada);

		$Consulta1 ="SELECT C041NUMPED 
				,C041TIPOPE
				,C041CVEDOC
				,I041CERRADO
				,C041RFCCLI
				,C041FIRELE
				,C041NOMUSU
				,C041ORIGEN
				,D041STAMP  
			FROM AT041 
		WHERE    D041STAMP BETWEEN '".$fechaInicial."' AND '".$fechaAjustada."' or D041STAMP='".$fechaAjustada."' ORDER BY(D041STAMP)";
		echo $Consulta1;
		$query1 =$bdd->prepare($Consulta1);
		$query1->execute();
		while($row1 = $query1->fetch(PDO::FETCH_OBJ)){
			$arrayTemp = array("C041NUMPED" => $row1->C041NUMPED
								,"C041TIPOPE"=>$row1->C041TIPOPE
								,"C041CVEDOC"=>$row1->C041CVEDOC
								,"I041CERRADO"=>$row1->I041CERRADO
								,"C041RFCCLI"=>$row1->C041RFCCLI
								,"C041FIRELE"=>$row1->C041FIRELE
								,"C041NOMUSU"=>$row1->C041NOMUSU
								,"C041ORIGEN"=>$row1->C041ORIGEN
								,"D041STAMP"=>$row1->D041STAMP);
			array_push($arrayFinal, $arrayTemp);
		}
		//Numero de pedimento echo $array2[0][0];
		//Referencia de pedimento echo $array2[0][1];
	
		 require_once 'PHPExcel/PHPExcel.php';
				// Se crea el objeto PHPExcel
				$objPHPExcel = new PHPExcel();
				// Se asignan las propiedades del libro
				$objPHPExcel->getProperties()->setCreator("") //Autor
							 ->setLastModifiedBy($_SESSION['nombre']) //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Pedimentos Consolidados")
							 ->setSubject("")
							 ->setDescription("Reporte")
							 ->setKeywords("Reporte ")
							 ->setCategory("Reporte excel");

				$tituloReporte = "REPORTE DE PEDIMENTOS CONSOLIDADOS DEL ".$fechaInicial." AL ".$fechaFinal;
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
				$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
				$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(19);
				$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(70);
				$objPHPExcel->setActiveSheetIndex(0)
        		->mergeCells('A1:AD1');

		// Se agregan los titulos del reporte
				$objPHPExcel->setActiveSheetIndex(0)
					 ->setCellValue('A1',$tituloReporte)
    		  		->setCellValue('B3','Pedimento')
            		->setCellValue('C3','Tip.Op')
    				->setCellValue('D3','Cve.Doc')
        			->setCellValue('E3','Cerrado?')
            		->setCellValue('F3','Remesas')
            		->setCellValue('G3','Rfc Cliente')
            		->setCellValue('H3','Firma Electronica')
            		->setCellValue('I3','Usuario')
            		->setCellValue('J3','Origen')
            		->setCellValue('K3','Fecha/Hora Creado');
				$i = 4;
				$cn = 1;
				for ($a=0; $a < count($arrayFinal); $a++) { 
							$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i, $cn)
				    		->setCellValue('B'.$i, $arrayFinal[$a]['C041NUMPED'])
				            ->setCellValue('C'.$i, $arrayFinal[$a]['C041TIPOPE'])
				    		->setCellValue('D'.$i, $arrayFinal[$a]['C041CVEDOC'])
				            ->setCellValue('E'.$i, $arrayFinal[$a]['I041CERRADO'])
				            ->setCellValue('F'.$i, '0')
				            ->setCellValue('G'.$i, $arrayFinal[$a]['C041RFCCLI'])
				            ->setCellValue('H'.$i, $arrayFinal[$a]['C041FIRELE'])
				            ->setCellValue('I'.$i, $arrayFinal[$a]['C041NOMUSU'])
				            ->setCellValue('J'.$i, $arrayFinal[$a]['C041ORIGEN'])
				            ->setCellValue('K'.$i, $arrayFinal[$a]['D041STAMP']);
							$i++;
							$cn++;
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