<?php 
  $sql = "SELECT max(InvNum) as NumeroFactura FROM invinfo";
  $hoy = date("Y-m-d");
  $numInicial = 0;
  foreach ($db->query($sql) as $row) {
        $numInicial = $row['NumeroFactura'];
    }
 ?>

<div class="panel panel-default">
  <div class="panel-heading">Formato</div>
  <div class="panel-body">
  		<div class="row form-horizontal">
  			<div class="col-lg-4">
            <div class="form-group">
              <label class="control-label col-sm-5" for="email">Invoice date:</label>
              <div class="col-sm-7">
                    <input type='text'  class="form-control" value="<?php echo $hoy; ?>" id='InvDate' disabled />
                  <script type="text/javascript">
                      $(function () {
                          $('#InvDate').datetimepicker({
                              format: 'YYYY/MM/DD'  
                          });
                          $('#txtInvCruDateCrossing').datetimepicker({
                              format: 'YYYY/MM/DD'  
                          });
                      });
                  </script>
              </div>
            </div>
      			<div class="form-group">
    				    <label class="control-label col-sm-5" >Customer Num:</label>
    				    <div class="col-sm-7">
    		           		<input type='text' class="form-control" id='txtCustumerNum' />
    				    </div>
    				</div>
            <div class="form-group">
                <label class="control-label col-sm-5" >Invoice Num:</label>
                <div class="col-sm-7">
                      <input type='text'  value="<?php echo $numInicial+1; ?>" text="<?php echo $numInicial; ?>" class="form-control" disabled id="txtInvNum" />
                </div>
            </div>
            <input value="0" type="hidden"  id="txtInvId">            
            <span id="ErrorMsg"  class="pull-right"></span>

            <div class="form-group">
                <div class="col-sm-6 pull-right ">
                  <button class="btn btn-success" id="btnAsignar"  >Asignar</button>
                      <button class="btn btn-primary"  id="btnNuevo" >Nuevo</button>
                </div>
            </div>
  			</div>
        <div class="col-lg-8" style="border-left:  1px dashed #333;">
            <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label col-sm-5" >DATE OF CROSSING:</label>
                  <div class="col-sm-7">
                        <input type='text' class="form-control" id='txtInvCruDateCrossing' disabled />
                  </div>
                </div>
            </div>
            <div class="col-lg-6" >
                <div class="form-group">
                  <label class="control-label col-sm-5">TRAILER NUMBER:</label>
                  <div class="col-sm-7">
                        <input type='text' class="form-control" id='txtInvCruTrailerNumber' disabled />
                  </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label col-sm-5">AMOUNT:</label>
                  <div class="col-sm-7">
                        <input type='text' class="form-control" id='txtInvCruAmount' disabled />
                  </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label col-sm-5">DESCRIPTION:</label>
                  <div class="col-sm-7">
                        <input type='text' class="form-control" id='txtInvCruDescription' disabled />
                  </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label col-sm-5">FROM:</label>
                  <div class="col-sm-7">
                        <input type='text' class="form-control" value="MAHLE" id='txtInvCruFrom' disabled />
                  </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                  <button id="btnGuardar" type="button" class="btn btn-primary  pull-right">Guardar</button>
                </div>
            </div>
          </div>
    	</div>
    </div>
      
      <div class="line line-dashed line-lg pull-in"></div>
    	<table class="table table-responsive" id="tablacruces" style=" text-align: center; ">
    		<thead>
    			<tr>
    				<th align="center" width="200"><center>DATE OF CROSSING</center></th>
		    		<th width="150"><center>TRAILER NUMBER</center></th>
		    		<th width="150"><center>AMOUNT<center></th>
		    		<th width="250"><center>DESCRIPTION</center></th>
		    		<th width="100"><CENTER>FROM</CENTER></th>	
            <th><center>INVOICE NUMBER</center></th>	
    			</tr>
    		</thead>
    		<tbody>
		    </tbody>
    	</table>
  </div>
</div>