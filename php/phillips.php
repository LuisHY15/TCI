<?php
    $hoy = getdate();
    $Date =  $hoy['year'].$hoy['mon'].$hoy['wday'].$hoy['hours'].$hoy['minutes'].$hoy['seconds'];
    echo $Date;
    print_r($hoy);
?>
<section >
    <hr>
	<div class="panel panel-default">
	    <div class="panel-heading">Formato</div>
		    <div class="panel-body">
		    	<div class="row form-inline container " >
		    			 <div class="row">
		    			 	<form action="admin.php?m=exportacion" method="post" enctype="multipart/form-data" name="subir">
                                <div class="col-md-9">
                                    <input class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" type="file" name="archivo" id="archivo">
                                    <button class="btn btn-primary" type="Submit"    name="subir" id="subir" ><i class="fa fa-upload"></i><span class="bold"> Subir</span></button>
                                    <a href="phillips.xml" class="btn btn-primary" download="phillips<?php echo $Date;?>.xml"><i class="fa fa-download" aria-hidden="true"></i> Descarga XML</a>
                                </div>
                            </form>
		    			 </div>
		    	</div>
		        <div class="row">
		        	<div class="col-md-12">
<?php 
                            require_once 'php/PHPExcel/PHPExcel/IOFactory.php';
                            $nameArchivo ="";
                            $fechaExpedicion = "";
                            $Factura = "";
                            $total =0;
                            $Mercancia =  array();
                            if(isset($_POST['subir'])){                            
                                $RFC = "";
                                $target_path = "php/"; 
                                $target_path = $target_path . basename( $_FILES['archivo']['name']); 
                                if(move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path)) 
                                    { 
                                        $nameArchivo = basename( $_FILES['archivo']['name']);                                  
                                        $arrays =  array();
                                        $nombreArchivo = 'php/'.$nameArchivo;
                                        $objPHPExcel = PHPExcel_IOFactory::load($nombreArchivo);
                                        //Asigno la hoja de calculo activa
                                        $objPHPExcel->setActiveSheetIndex(0);
                                        //Obtengo el numero de filas del archivo
                                        $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
                                        echo "Fecha de Expedicion : ".substr($objPHPExcel->getActiveSheet()->getCell('D2')->getCalculatedValue(), -10)."<BR>";
                                        echo "INCOTERM : ".substr($objPHPExcel->getActiveSheet()->getCell('A7')->getCalculatedValue(), -3)."<br>";
                                        echo "FACTURA : ".$objPHPExcel->getActiveSheet()->getCell('J3')->getCalculatedValue()."<br>";
                                        $Factura= $objPHPExcel->getActiveSheet()->getCell('J3')->getCalculatedValue();
                                        echo "REGIMEN : ".substr($objPHPExcel->getActiveSheet()->getCell('D2')->getCalculatedValue(), -10)."<br>";
                                        echo '<table id="phillips" class="table table-striped table-bordered" cellspacing="0" width="100%">';
                                        echo "<thead><tr><th>Numero de Parte</th><th>Descripcion</th><th>Fraccion</th><th>Peso</th><th>C.O.</th><th>UMT</th><th>Cantidad</th><th>Precio</th><th>Valor Agregado</th><th>Total</th></tr></thead><tbody>";
                                        for ($i = 12; $i <= $numRows; $i++) {
                                            if ($objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue() == "") {
                                                break;
                                            }else{
                                                $arrayAuxiliar = [];
                                                //
                                                $M605  = $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
                                                $DSC = substr($M605,1);
                                                $CIA  =  str_replace(',','',$DSC);
                                                $M605DSCMCIA = $CIA;
                                                //
                                                $M605  = $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
                                                $DSC = substr($M605,1);
                                                $CIA  =  str_replace(',','',$DSC);
                                                $F605VALTOT = $CIA;
                                                //
                                                $arrayAuxiliar = array("M605DSCMCIA"=>$objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue(),
                                                "C605UNIUMC"=>$objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue(),
                                                "C605TIPMON"=>$objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue(),
                                                "F605CANUMC"=>$objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue(),
                                                "F605VALUNI"=>$M605DSCMCIA,
                                                "F605VALTOT"=>$F605VALTOT,
                                                "F605VALDOL"=>$F605VALTOT);
                                                array_push($Mercancia,$arrayAuxiliar);
                                                echo "<tr>";
                                                echo "<td>";
                                                echo $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
                                                echo "</td>";
                                                echo "<td>";
                                                echo $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
                                                echo "</td>";
                                                echo "<td>";
                                                echo $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
                                                echo "</td>";
                                                echo "<td>";
                                                echo $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
                                                echo "</td>";
                                                echo "<td>";
                                                echo $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
                                                echo "</td>";
                                                echo "<td>";
                                                echo $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
                                                echo "</td>";
                                                echo "<td>";
                                                echo $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
                                                echo "</td>";
                                                echo "<td>";
                                                echo $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
                                                echo "</td>";
                                                echo "<td>";
                                                echo $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
                                                echo "</td>";
                                                echo "<td>";
                                                echo $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
                                                echo "</td>";
                                                echo "</tr>";
                                                //echo  $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue() . " -> $i <br>";
                                                 $var   = $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
                                                 $valor = substr($var,1);
                                                 $valr  =  str_replace(',','',$valor);
                                                 //cho $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue().'*'
                                                  //  .$objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue().'='
                                                    //.($objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue() * $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue())."<br>";
                                                 $total = $total + ($objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue() * $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue());
                                                 array_push($arrays, $valr);
                                                 
                                            }

                                         }
                                         echo "</tbody></table><script>
                        $(document).ready(function() {
                            $('#phillips').DataTable();
                        } );
                    </script>";
                                         echo  "Total USD  :  $" .$total;
                                         //echo $total;
                                          $xmlEstructure = "<?xml version='1.0' encoding='utf-8' ?>
                                                    <solicitarRecibirCoveServicio>
                                                        <comprobantes>
                                                            <C601PATEN>3649</C601PATEN> 
                                                            <C601ADUSEC>240</C601ADUSEC>
                                                            <C601TIPOPE>TOCE.EXP</C601TIPOPE>
                                                            <C602PATEN>3649</C602PATEN>
                                                             <D601FECEXP>".$fechaExpedicion."</D601FECEXP>
                                                            <M601OBSERV />
                                                            <C603RFC>RPI140509NN2</C603RFC>
                                                            <C601TIPFIG>1</C601TIPFIG>
                                                            <C601EMAIL>exportacion@tramitaciones.com</C601EMAIL>
                                                            <C601FACDORI>".$Factura."</C601FACDORI>
                                                            <factura>
                                                                <I604CERTORI>0</I604CERTORI>
                                                                <I604SUBDIV>0</I604SUBDIV>
                                                                <C604CVEINC>DAP</C604CVEINC>
                                                                <C604VINCU>S</C604VINCU>
                                                                <C604MONFAC>USD</C604MONFAC>
                                                                <F604VALMEX>".$total."</F604VALMEX>
                                                                <F604FACMEX>1.0000000</F604FACMEX>
                                                                <F604VALDOL>".$total."</F604VALDOL>
                                                                <C604PAIS>MEX</C604PAIS>
                                                            </factura>
                                                            <emisor>
                                                                <C607CVEAM3>R.A.P</C607CVEAM3>
                                                                <I607TIPIDE>1</I607TIPIDE>
                                                                <C607IDENTIF>RPI140509NN2</C607IDENTIF>
                                                                <C607APPAT />
                                                                <C607APMAT />
                                                                <C607NOM>R.A. PHILLIPS INDUSTRIES DE MEXICO S. DE R.L. DE C.V.</C607NOM>
                                                                <domicilio>
                                                                    <C607CALLE> AV. BOB PHILLIPS</C607CALLE>
                                                                    <C607NUMEXT>755</C607NUMEXT>
                                                                    <C607NUMINT />
                                                                    <C607COLONIA> </C607COLONIA>
                                                                    <C607LOCALI />
                                                                    <C607MCPIO>COL. EL LLANO,ARTEAGA</C607MCPIO>
                                                                    <C607ESTADO>CO</C607ESTADO>
                                                                    <C607PAIS>MEX</C607PAIS>
                                                                    <C607CODPOS>25350</C607CODPOS>
                                                                </domicilio>
                                                            </emisor>
                                                            <destinatario>
                                                                <C608CVEAM3>R.A PHILLIPS INDUSTRIES, INC.</C608CVEAM3>
                                                                <I608TIPIDE>0</I608TIPIDE>
                                                                <C608IDENTIF>95-2596625</C608IDENTIF>
                                                                <C608APPAT />
                                                                <C608APMAT />
                                                                <C608NOM>PHILLIPS INDUSTRIES</C608NOM>
                                                                <domicilio>
                                                                    <C608CALLE> BURKE STREET </C608CALLE>
                                                                    <C608NUMEXT>1</C608NUMEXT>
                                                                    <C608NUMINT>12012</C608NUMINT>
                                                                    <C608COLONIA />
                                                                    <C608LOCALI />
                                                                    <C608MCPIO>SANTA FE SPRINGS</C608MCPIO>
                                                                    <C608ESTADO>CA</C608ESTADO>
                                                                    <C608PAIS>USA</C608PAIS>
                                                                    <C608CODPOS>0670</C608CODPOS>
                                                                </domicilio>
                                                            </destinatario>";
                                        for($i = 0; $i < count($Mercancia);$i++){
                                                $xmlEstructure =   $xmlEstructure . "<mercancias>
                                                                                            <M605DSCMCIA>".$Mercancia[$i]['M605DSCMCIA']."</M605DSCMCIA>
                                                                                            <C605UNIUMC>EA</C605UNIUMC>
                                                                                            <C605TIPMON>USD</C605TIPMON>
                                                                                            <F605CANUMC>".$Mercancia[$i]['F605CANUMC']."</F605CANUMC>
                                                                                            <F605VALUNI>".$Mercancia[$i]['F605VALUNI']."</F605VALUNI>
                                                                                            <F605VALTOT>".$Mercancia[$i]['F605VALTOT']."</F605VALTOT>
                                                                                            <F605VALDOL>".$Mercancia[$i]['F605VALDOL']."</F605VALDOL>
                                                                                            <descripcionesEspecificas>
                                                                                                <C606MARCA />
                                                                                                <C606MODELO />
                                                                                                <C606SUBMOD />
                                                                                                <C606NUMSER />
                                                                                            </descripcionesEspecificas>
                                                                                        </mercancias>"    ;
                                        }
                                        $xmlEstructure = $xmlEstructure . " </comprobantes>
                                                                                </solicitarRecibirCoveServicio>";
                                         unlink("Phillips.xml");
                                        $file=fopen("Phillips.xml","a") or die("Problemas");
                                        if (fwrite($file, $xmlEstructure) === TRUE) { 
                                            
                                        } 
                                        fclose($file);
                                    } 
                                     else
                                        { 
                                            echo '<div class="alert alert-danger" style="width:500px;">Error! archivo no valido.</div>'; 
                                        }
                                }
  ?>
		        	</div>
		        </div>
		    </div>
	</div>
</section>


