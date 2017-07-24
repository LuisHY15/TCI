<div class="row">
	<div class="col-md-12">
		<section class="panel panel-default pos-rlt clearfix">

			<header class="panel-heading"> <i class="fa fa-calendar"></i> Citas para hoy</header>
			
			<div class="table-responsive">
				<table class="table ">
					<tr>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Cliente</th>
						<th>Descripcion</th>
					</tr>
<?php
					$query = mysql_query("SELECT * FROM citas JOIN clientes ON clientes.idclientes=citas.idcliente WHERE citas.fecha='".date("Y-m-d")."' ORDER BY citas.idcitas ASC");
					while($q = mysql_fetch_object($query)){
						echo "<tr>
							<td>".$q->fecha."</td>
							<td>".$q->hora."</td>
							<td>".$q->nombre."</td>
							<td>".$q->descripcion."</td>
						<tr>";
					}
?>
				</table>
			</div>
			
		</section>
	</div>
</div>