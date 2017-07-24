<?php 
/*
$serv = "localhost";
$user = "anuncia2_aldia";
$pass = "yBQdKBduDala";
$data = "anuncia2_frontera";
*/
$user = "3649hostNLD";
$pass = "h-M0c3d4RT";

### FUNCIONES DE SEGURIDAD ###
/*function xss($vuln){
	return htmlentities(strip_tags($vuln));
}
function sqli($vuln){
	return mysql_real_escape_string($vuln);
}
##############################
 	 	
mysql_connect($serv, $user, $pass);
mysql_select_db($data);

$errorMsg = "";
*/
try
{
	$bdd = new PDO('mysql:host=189.206.120.155:3322;dbname=SAAIWEB', $user, $pass);
}catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>