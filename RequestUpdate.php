<?php
	require("model/account.php");

	$Title = $_POST['Title'];
	$Summary = $_POST['Summary'];
	$StartTime = $_POST['StartTime'];
	$EndTime = $_POST['EndTime'];
	$Price = $_POST['Price'];
	$StartDay = $_POST['StartDay'];
	$StartMonth = $_POST['StartMonth'];
	$StartYear = $_POST['StartYear'];

	$EndDay = $_POST['EndDay'];
	$EndMonth = $_POST['EndMonth'];
	$EndYear = $_POST['EndYear'];

	$StartDate = $StartYear."-".$StartMonth."-".$StartDay;
	$EndDate = $EndYear."-".$EndMonth."-".$EndDay;

	update($ID, $Title, $StartTime, $StartDate, $EndTime, $EndDate, $Price, $Tickets, $Summary);
	header("Location: maintain.php");

?>