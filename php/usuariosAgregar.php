<?php
if ( isset($_POST['nombre']) ){
	$nombre 	    = ($_POST['nombre']);
	$usuario 		= ($_POST['usuario']);
    $password 	    = ($_POST['password']);
    $correo         = ($_POST['correo']);
    $fexpira        = ($_POST['fexpira']);
    $tipo			= ($_SESSION['tipo']);
 //getdate converted day
    $sql = "INSERT INTO usuarios (
		usunombre,
		usuusuario,
		usupassword,
		usucorreo,
		usutipo,
		usuingreso,
		usuexpiracion,
		usuactivo,
		usuip) VALUES (
		'$nombre',
		'$usuario',
		'$password',
		'$correo',
		'$tipo',
		'".$_SESSION['date']."', 
		'$fexpira', 
		1,
		'10.10.10.20')";
   
	 if ($result = $db->query($sql))
	 {
		$errorMsg = '<div class="alert alert-success">
				<i class="fa fa-check"></i> Usuario agregado correctamente.
			</div>';
	}
	 else
	{
		$errorMsg = '<div class="alert alert-danger">
			<i class="fa fa-times"></i> Error, intenta nuevamente.
		</div>';
	}
}

function getRealIP() {

       if (isset($_SERVER["HTTP_CLIENT_IP"]))
    {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
    {
        return $_SERVER["HTTP_X_FORWARDED"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED"]))
    {
        return $_SERVER["HTTP_FORWARDED"];
    }
    else
    {
        return $_SERVER["REMOTE_ADDR"];
    }
}
 

?>	
<section class="panel panel-default">
	<header class="panel-heading">
		<i class="fa fa-user"></i> Agregar Usuario
		<?php 
			//echo $_SERVER["REMOTE_ADDR"];
		 ?>
	</header>
	<div class="panel-body">
		<form class="bs-example form-horizontal" action="" method="post">
			<?php echo $errorMsg; ?>
			<div class="row">
				<div class="col-md-6">
					<div class="col-md-12">
						<div class="form-group">
							<label class="col-md-3 control-label">Nombre</label>
							<div class="col-md-9"><input type="text" name="nombre" class="form-control"></div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="col-md-3 control-label">Usuario</label>
							<div class="col-md-9"><input type="text" name="usuario" class="form-control"></div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="col-md-3 control-label">Password</label>
							<div class="col-md-9"><input type="text" name="password" class="form-control"></div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="col-md-3 control-label">Correo</label>
							<div class="col-md-9"><input type="email" name="correo" class="form-control"></div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="col-md-12">
						<div class="form-group">
							<label class="col-md-3 control-label">Tipo</label>
							<div class="col-md-9">
								<select class="form-control" id="sel1">
								    <option>1</option>
								    <option>2</option>
								    <option>3</option>
									<option>4</option>
								</select>
							</div>
						</div>
					</div>
			    	<div class="col-md-12">
						<div class="form-group">
						<label class="col-md-3 control-label">Fecha Ingreso</label>
							<div class="col-md-9">
							<input type="text" name="nombre" class="form-control" placeholder="<?php echo $_SESSION['date']; ?>" disabled>
							</div>
						</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label class="col-md-3 control-label">Fecha Expiracion</label>
				        <div class='col-sm-9'>
			                <div class='input-group date' id='datetimepicker1'>
			                    <input type='text' class="form-control" name='fexpira'/>
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
				        </div>
					</div>
				</div
				</div>
			</div>
			<div class="line line-dashed line-lg pull-in"></div>
			<div class="form-group text-right">
				<div class="col-lg-12"> 
					<button type="submit" class="btn btn-md btn-success"><i class="fa fa-check icon"></i> Agregar</button>
					<a href="admin.php?m=usuarios" class="btn btn-md btn-danger"><i class="fa fa-times icon"></i> Cancelar</a>
				</div>
			</div>
		</form>
	</div>
</section>
<script type="text/javascript">
$(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY/MM/DD'
        });;
    });
</script>