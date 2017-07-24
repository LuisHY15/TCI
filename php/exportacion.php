<?php 
  require_once 'PHPExcel/PHPExcel/IOFactory.php';
  ?>
  <form>
        <div class="typeahead__container">
            <div class="typeahead__field">

            <span class="typeahead__query">
                <input class="js-typeahead"
                       name="q"
                       type="search"
                       autofocus
                       autocomplete="on">
            </span>
            <span class="typeahead__button">
                <button type="submit">
                    <span class="typeahead__search-icon"></span>
                </button>
            </span>

            </div>
        </div>
    </form>
<section class="container">
	<div class="panel panel-default">
	    <div class="panel-heading">Formato</div>
		    <div class="panel-body">
		    	<div class="row form-inline">
		    		<div class="form-group">
		    			 <label class=" col-md-4">Tipo de Operacion</label>
		    			 <div class="col-md-6">
		    			 	<select id="TipOpe" name="TipOpe" class="form-control">
		    			 		<option></option>
		    			 		<option value="1">TOCE.EXP</option>
		    			 		<option value="2">TOCE.IMP</option>
		    			 	</select>
		    			 </div>
		    		</div>
		    		<hr>
		    		
		    	</div>
		        <div class="row">
		        	<div class="col-md-12">
		        		 <form action="file.php" method="post" enctype="multipart/form-data">
		        		 		<div class="">
		        		 			<?php
		        		 				$total =0;
		        		 				$arrays =  array();
		        		 				$nombreArchivo = 'test.xlsx';
		        		 				$objPHPExcel = PHPExcel_IOFactory::load($nombreArchivo);
		        		 				//Asigno la hoja de calculo activa
										$objPHPExcel->setActiveSheetIndex(0);
										//Obtengo el numero de filas del archivo
										$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
										echo "Fecha de Expedicion : ".substr($objPHPExcel->getActiveSheet()->getCell('D2')->getCalculatedValue(), -10)."<BR>";
										echo "INCOTERM : ".substr($objPHPExcel->getActiveSheet()->getCell('A7')->getCalculatedValue(), -3)."<br>";
										echo "FACTURA : ".$objPHPExcel->getActiveSheet()->getCell('J3')->getCalculatedValue()."<br>";
										echo "REGIMEN : ".substr($objPHPExcel->getActiveSheet()->getCell('D2')->getCalculatedValue(), -10)."<br>";
										echo '<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">';
										echo "<thead><tr><th>Numero de Parte</th><th>Descripcion</th><th>Fraccion</th><th>Peso</th><th>C.O.</th><th>UMT</th><th>Cantidad</th><th>Precio</th><th>Valor Agregado</th><th>Total</th></tr></thead><tbody>";
										for ($i = 12; $i <= $numRows; $i++) {
											if ($objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue() == "") {
												break;
											}else{
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
												 $total = $total + $valr;
												  array_push($arrays, $valr);
											}

										 }
										 echo "</tbody></table>";
										 echo  "Total USD  :  $" .$total;
										 //echo $total;
		        		 			 ?>
		        		 		</div>
		        		 		<script type="text/javascript">
		        		 			$(document).ready(function() {
									    $('#example').DataTable();
									} );
		        		 		</script>
						 </form>
		        	</div>
		        </div>
		    </div>
		</div>
	</div>
</section>
    <script>

        var data = [{
            "name": "Ducks",
            "img": "ducks",
            "city": "Anaheim",
            "id": "ANA",
            "conference": "Western",
            "division": "Pacific"
        }];

        var storageKey = 'TYPEAHEAD_SUGGESTIONS',
            storageData = JSON.parse(localStorage.getItem(storageKey)) || [];

        function clearSuggestions () {
            localStorage.removeItem(storageKey);
            storageData = [];
        }

        typeof $.typeahead === 'function' && $.typeahead({
            input: ".js-typeahead",
            minLength: 1,
            maxItem: 8,
            maxItemPerGroup: 6,
            order: "asc",
            hint: true,
            searchOnFocus: true,
            display: ["name", "city"],
            emptyTemplate: 'no result for {{query}}',
            source: {
                suggestion: {
                    template: "{{name}} {{city}} <small class='typeahead__suggestion-label'>Suggestion</small>",
                    minLength: 0, // Start showing suggestion when the input is focused
                    maxLength: 5, // when 4 characters are entered, the suggestions will stop showing
                    dynamic: true,
                    filter: false, // Always show these suggestion regardless of what is typed
                    data: function () {
                        var deferred = $.Deferred();

                        // setTimeout simulates a delay if you are getting the data from
                        // a call to an API or a backend endpoint to get the user's preferences
                        setTimeout(function () {

                            deferred.resolve(storageData);

                        }, 250);

                        return deferred;
                    }
                },
                teams: {
                    data: data,
                    matcher: function (item, displayKey) {
                        var isSuggestion;
                        for (var i = 0, ii = storageData.length; i < ii; ++i) {
                            if (storageData[i].name === item.name) {
                                isSuggestion = true;
                                break;
                            }
                        }
                        return isSuggestion ? undefined : true;

                        // return undefined to skip to next item
                        // return false to attempt the matching function on the next displayKey
                        // return true to add the item to the result list
                        // return item object to modify the item and add it to the result list
                    }
                }
            },
            callback: {
                // onClick add the clicked item into the suggestion array inside localStorage
                // or it could also send a request to store it in database so the user get its last searched terms
                onClick: function (node, a, item, event) {
                    var maxSuggestions = 2;

                    if (storageData.length >= maxSuggestions) {
                        storageData.pop();
                    }
                    storageData.unshift(item);

                    localStorage.setItem(storageKey, JSON.stringify(storageData));
                }
            },
            debug: true
        });

    </script>