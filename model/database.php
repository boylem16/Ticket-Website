<?php
try{
	$conn = new PDO('mysql:host=localhost;dbname=Events','root','Password1!!');
}
catch(PDOException $e){
	exit();
}
?>