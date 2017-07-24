<?php 

	include '../db.php';
	$id = $_GET["id"];
	$clave = $_GET["clave"];
	if ($clave == 1) {
		$sql = "SELECT invcruce.InvCruDateCrossing as DateCrossing, invcruce.InvCruTrailerNumber as trailerNumber, invcruce.InvCruAmount as CruAmount,invcruce.InvCruDescription as Description, invcruce.txtInvCruFrom as CruFrom,invinfo.InvNum as InvNum FROM invcruce join invinfo on invcruce.InvId = invinfo.InvId WHERE invinfo.InvId =".$id;
	}
	if($clave == 2){
		$sql = "SELECT  invcruce.InvCruDateCrossing as DateCrossing, invcruce.InvCruTrailerNumber as trailerNumber, invcruce.InvCruAmount as CruAmount,invcruce.InvCruDescription as Description, invcruce.txtInvCruFrom as CruFrom,invinfo.InvNum as InvNum FROM invcruce join invinfo on invcruce.InvId = invinfo.InvId WHERE invcruce.InvCru=".$id;
	}
	
	$querySql = [];
	$query = $db->prepare($sql);
	$query->execute();
	while ($row = $query->fetch(PDO::FETCH_OBJ))
	{
		$arr = array("InvCruDateCrossing"=>$row->DateCrossing,"InvCruTrailerNumber"=>$row->trailerNumber,"InvCruAmount"=>$row->CruAmount,"InvCruDescription"=>$row->Description,"txtInvCruFrom"=>$row->CruFrom,"InvNum"=>$row->InvNum);
		array_push($querySql, $arr);
	}
	echo json_encode($querySql);
	//print_r($row);
	//echo count($row);
	
	/*if ($resultado = mysqli_query($db,$sql)) {
			while ($fila =$resultado->fetch_row()) {
				$arr = array("InvCruDateCrossing"=>$fila[0],"InvCruTrailerNumber"=>$fila[1],"InvCruAmount"=>$fila[2],"InvCruDescription"=>$fila[3],"txtInvCruFrom"=>$fila[4],"InvNum"=>$fila[5]);
				array_push($querySql, $arr);
			}
		
		$db->close();
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($db);
	    $db->close();
	}*/
	
 ?>