<?php 
if (isset($_SESSION['id'])) {
         header("Location: admin.php");
    }
    $dbError = "";

if ( isset($_GET['del']) ){
				$del = ($_GET['del']);
				echo "DELETE FROM usuarios WHERE usuid='".$del."'";
				$db->query("DELETE FROM usuarios WHERE usuid='".$del."'");
			}
   $sql = "SELECT usuid,usunombre,usuusuario,usupassword,usucorreo,usuactivo,usutipo FROM usuarios"; 
   $result = $db->query($sql);
   $row = $result ->fetchObject();
?>

<section class="panel panel-default pos-rlt clearfix">
	<header class="panel-heading"> 
		<div class="row wrapper">
			<div class="col-sm-10" >
				<i class="fa fa-users"></i> Usuarios
			</div>
			<div class="col-sm-2">
			  <a href="admin.php?m=usuariosAgregar" class="btn btn-primary">Agregar Usuario <i class="fa fa-plus"></i></a>
			</div>

		</div>
	</header>

	<div class="table-responsive">
		<table class="table table-striped b-t b-light">
			<thead>
				<tr>
				    <th>ID</th>
					<th>Nombre</th>
					<th>Usuario</th>
					<th>Password</th>
					<th>Correo</th>
					<th>Activo</th>
					<th>Tipo</th>
					<th width="120"></th>
				</tr>
			</thead>
			<tbody>

<?php

##### PAGINADOR #####
/*
$rows_per_page = 20;

if(isset($_GET['pag']))
	$page = mysql_real_escape_string($_GET['pag']);
else if (@$_GET['pag'] == "0")
	$page = 1;
else 
	$page = 1;

$num_rows 		= mysql_num_rows(mysql_query($consulta));
$lastpage		= ceil($num_rows / $rows_per_page);    		
$page     = (int)$page;
if($page > $lastpage){
	$page = $lastpage;
}
if($page < 1){
	$page = 1;
}
$limit 		= 'LIMIT '. ($page -1) * $rows_per_page . ',' .$rows_per_page;
$consulta  .=" $limit";

$consulta = mysql_query($consulta);
##### PAGINADOR ####
*/
			while($row = $result ->fetchObject()){ 
?>					<td><?php echo $row->usuid; ?></td>
					<td><?php echo $row->usunombre; ?></td>
					<td><?php echo $row->usuusuario; ?></td>
					<td><?php echo $row->usupassword; ?></td>
					<td><?php echo $row->usucorreo; ?></td>
					<td><?php echo $row->usuactivo; ?></td>
					<td><?php echo $row->usutipo; ?></td>
					<td class="text-right">
						<a href="admin.php?m=usuariosEditar&id=<?php echo $row->usuid; ?>" class="btn btn-sm btn-default"> <i class="fa fa-pencil"></i> </a> &nbsp;
						<a href="admin.php?m=usuarios&del=<?php echo $row->usuid; ?>" class="btn btn-sm btn-danger"> <i class="fa fa-times"></i> </a>					
					</td>
				</tr>
<?php
			}
?>
			</tbody>
		</table>
	</div>
<footer class="panel-footer">
		<div class="row">
			<div class="col-sm-12 text-right text-center-xs">
				<ul class="pagination pagination-sm m-t-none m-b-none">
<?php
/*
	if($num_rows != 0){
		$nextpage = $page + 1;
		$prevpage = $page - 1;

		if ($page == 1) {
			echo '<li class="disabled"><a href="#"><i class="fa fa-chevron-left"></i></a></li>';
			
			echo '<li class="active"><a href="">1</a></li>';
			
			for($i= $page+1; $i<= $lastpage ; $i++){
				echo '<li><a href="'.$url.'&pag='.$i.'">'.$i.'</a></li> ';
			}

			if($lastpage >$page ){
				echo '<li><a href="'.$url.'&pag='.$nextpage.'"><i class="fa fa-chevron-right"></i></a></li>';
			}else{	
				echo '<li class="disabled"><a href="#"><i class="fa fa-chevron-right"></i></a></li>';
			}
		} else {
			echo '<li><a href="'.$url.'&pag='.$prevpage.'"><i class="fa fa-chevron-left"></i></a></li>';
			
			for($i= 1; $i<= $lastpage ; $i++){
				if($page == $i){
					echo '<li class="active"><a href="#">'.$i.'</a></li>';
				} else {
					echo '<li><a href="'.$url.'&pag='.$i.'">'.$i.'</a></li> ';
				}
			}
         
			if($lastpage >$page ){
				echo '<li><a href="'.$url.'&pag='.$nextpage.'"><i class="fa fa-chevron-right"></i></a></li>';
			} else {
				echo '<li class="disabled"><a href="#"><i class="fa fa-chevron-right"></i></a></li>';
			}
		}
	}
	*/
?>
				</ul>
			</div>
		</div>
	</footer>
</section>
