<?php
	require("../model/events_db.php");
	
	$ID = $_GET["ID"];
	$event = event($ID);

		echo $event["Title"]." ";
		if($event["StartDate"] != $event["EndDate"]){
			echo $event["StartTime"]," ",$event["StartDate"], " to ", $event["EndTime"], $event["EndDate"];
		}
		else{
			echo $event["StartTime"], " - ", $event["EndTime"], " ", $event["StartDate"];
		}
		echo "<br>", $event["Summary"];

	echo '<form action="iframe.php">
	<input type="submit" value="back">
	</form>'
?>