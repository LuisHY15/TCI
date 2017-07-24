<?php 
	include '../db.php';
	$InvCruDateCrossing = $_GET["InvCruDateCrossing"];
	$InvCruTrailerNumber = $_GET["InvCruTrailerNumber"];
	$InvCruAmount = $_GET["InvCruAmount"];
	$InvCruDescription = "PDTO-".$_GET["InvCruDescription"];
	$txtInvCruFrom  = $_GET["txtInvCruFrom"];
	$InvId = $_GET["InvId"];
	$sql ="INSERT INTO invcruce(InvCruDateCrossing,InvCruTrailerNumber,InvCruAmount,InvCruDescription,txtInvCruFrom,InvId) values('".$InvCruDateCrossing."','".$InvCruTrailerNumber."',".$InvCruAmount.",'".$InvCruDescription."','".$txtInvCruFrom."',".$InvId.")";
	$stmt = $db->prepare($sql);
    $stmt->execute();                            
	/*if (mysqli_query($db,$sql)) {
	$db->close();
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($db);
	    $db->close();
		}
	*/
 ?>