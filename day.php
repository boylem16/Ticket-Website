<?php
	require('model/events_db.php');
	require('model/database.php');
	require('view/header.php');
	session_start();

	$day = $_GET["day"];
	$month = $_GET["month"];
	$year = $_GET["year"];

	echo '<a href="ScheduleEvent.php?day='.$day.'&month='.$month.'&year='.$year.'"> Schedule Event </a> <br>';


	$events = getEvents($day, $month, $year);

	foreach ($events as $event){
		echo $event["Title"]." ";
		if($event["StartDate"] != $event["EndDate"]){
			echo $event["StartTime"]," ",$event["StartDate"], " to ", $event["EndTime"], $event["EndDate"];
		}
		else{
			echo $event["StartTime"], " - ", $event["EndTime"], " ", $event["StartDate"];
		}

		if($event['Tickets'] > 0){
			echo '&nbsp &nbsp &nbsp <form action="ticket.php" method="POST" style="display: inline">
				<input type="submit" value="Buy Ticket:">
				<input type="hidden" name="User" value="'.$_SESSION["user"].'">
				<input type="hidden" name="ID" value="'.$event["ID"].'">
				<input type="hidden" name="Company" value="'.$event["Company"].'">
				<input type="hidden" name="Price" value="'.$event["Price"].'">
				<input type="hidden" name="Title" value="'.$event["Title"].'">
			</form>';
		}

		else{
			echo '&nbsp &nbsp &nbsp <button onclick="buyTicket('.$event["ID"].','.$_SESSION["user"].','.$event["Price"].','.$event["Tickets"].')">Sold Out</button>';
		}

		echo "<br>", $event["Summary"], "<br><br>";
	}


?>