<?php 	
	include '../db.php';
	$sql = 'DELETE FROM invcruce WHERE InvCru = ?';
	$stmt = $db->prepare($sql);
	$OK = $stmt->execute(array($_GET['id']));	
	$error = $stmt->errorInfo();
	if (!$OK) {
		echo $error[2];
	}