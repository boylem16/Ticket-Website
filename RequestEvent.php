<?php
	session_start();
	require('model/events_db.php');
	require('model/database.php');
	require('view/header.php');

	echo "Your event has been requested. We will review the request and conctact you once it is approved";

	$StartTime = $_POST['StartTime'];
	$StartDay = $_POST['StartDay'];
	$StartMonth = $_POST['StartMonth'];
	$StartYear = $_POST['StartYear'];
	$EndTime = $_POST['EndTime'];
	$EndDay = $_POST['EndDay'];
	$EndMonth = $_POST['EndMonth'];
	$EndYear = $_POST['EndYear'];
	$Title = $_POST['Title'];
	$Summary =  $_POST['Summary'];
	$company = $_POST['Company'];
	$email = $_POST['email'];
	$tickets = $_POST['tickets'];
	$price = $_POST['price'];

	SubmitEvent($Title, $StartTime, $StartDay, $StartMonth, $StartYear, $EndTime, $EndDay, $EndMonth, $EndYear, $Summary, $company, $email, $tickets, $price);

	header("Location: maintain.php");	

?>