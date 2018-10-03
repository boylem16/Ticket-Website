<?php
	require("model/account.php");

	$ID = $_POST["ID"];
	deleteEvent($ID);

	header("location: maintain.php");

?>