<?php

$id = ($_GET['id']);

if ( isset($_POST['nombre']) ){
	$nombre 	    = ($_POST['nombre']);
	$usuario 		= ($_POST['usuario']);
    $password 	    = ($_POST['password']);
    $correo         = ($_POST['correo']);
    $fexpira        = ($_POST['fexpira']);
	if ( $db->query("UPDATE usuarios SET 
		usunombre = '$nombre',
		usuusuario = '$usuario',
		usupassword = '$password',
		usucorreo = '$correo',
		usuingreso = '".$_SESSION["date"]."',
		usuexpiracion = '$fexpira',
		usuactivo = 1,
		usuip = '10.10.10.20'
		WHERE usuid='$id'") ){
		$errorMsg = '<div class="alert alert-success">
				<i class="fa fa-check"></i> Usuario agregado correctamente.
			</div>';
	} else {
		$errorMsg = '<div class="alert alert-danger">
			<i class="fa fa-times"></i> Error, intenta nuevamente.
		</div>';

	}
}

// $data = ($db->query("SELECT * FROM usuarios WHERE idusuarios='".$id."' LIMIT 1"));
 
   $result = $db->query("SELECT * FROM usuarios WHERE usuid='".$id."' LIMIT 1");
   
   $data = $result ->fetchObject();

?>	
<section class="panel panel-default">
	<header class="panel-heading">
		<i class="fa fa-user"></i> Agregar Usuario
	</header>
			<div class="panel-body">
		<form class="bs-example form-horizontal" action="" method="post">
			<?php echo $errorMsg; ?>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-6 control-label">Nombre</label>
						<div class="col-md-6"><input type="text" name="nombre" class="form-control" value="<?php echo $data->usunombre; ?>"	></div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-3 control-label">Usuario</label>
						<div class="col-md-7"><input type="text" name="usuario" class="form-control" value="<?php echo $data->usuusuario; ?>"></div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-6 control-label">Password</label>
						<div class="col-md-6"><input type="text" name="password" class="form-control" value="<?php echo $data->usupassword; ?>"></div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-3 control-label">Correo</label>
						<div class="col-md-7"><input type="email" name="correo" class="form-control" value="<?php echo $data->usucorreo; ?>"></div>
					</div>
				</div>
			</div>
			<div class="row">
			    <div class="col-md-6">
					<div class="form-group">
						<label class="col-md-6 control-label">Fecha Ingreso</label>
						<div class="col-md-6"><input type="text" name="nombre" class="form-control" placeholder="<?php echo $data->usuingreso; ?>" disabled></div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-3 control-label">Fecha Expiracion</label>
						<div class="container">
						    <div class="row">
						        <div class='col-sm-4'>
						            <div class="form-group">
						                <div class='input-group date' id='datetimepicker1'>
						                    <input type='text' class="form-control" name='fexpira' value="<?php echo $data->usuexpiracion; ?>" />
						                    <span class="input-group-addon">
						                        <span class="glyphicon glyphicon-calendar"></span>
						                    </span>
						                </div>
						            </div>
						        </div>
						    </div>
						</div>
					</div>
				</div
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
