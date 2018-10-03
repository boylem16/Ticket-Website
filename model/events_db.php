<?php
session_start();
	try{
		$conn = new PDO('mysql:host=localhost;dbname=Events','root','Password1!!');
	}
	catch(PDOException $e){
		exit();
	}

function getEvents($day, $month, $year){
	global $conn;
	$query = 'SELECT * FROM EVENT where :year"-":month"-":day >= StartDate and :year"-":month"-":day <= EndDate ORDER BY StartDate';
	$statement = $conn->prepare($query);
	$statement->bindValue(':day', $day);
	$statement->bindValue(':month', $month);
	$statement->bindValue(":year", $year);
	$statement->execute();
	$events = $statement->fetchAll();
	$statement->closeCursor();
	return $events;
}

function SubmitEvent($Title, $StartTime, $StartDay, $StartMonth, $StartYear, $EndTime, $EndDay, $EndMonth, $EndYear, $Summary, $Company, $email, $tickets, $price){
	global $conn;
	$query = 'INSERT INTO EVENT (Title, StartDate, EndDate, Summary, Company, StartTime, EndTime, email, Tickets, Price) VALUES (:Title, :StartDate, :EndDate, :Summary, :Company, :StartTime, :EndTime, :email, :tickets, :price)';
	if($Title != NULL){

	$StartDate = $StartYear."-".$StartMonth."-".$StartDay;
	$EndDate = $EndYear."-".$EndMonth."-".$EndDay;
	$statement = $conn->prepare($query);
	$statement->bindValue(":StartDate", $StartDate);
	$statement->bindValue(":EndDate", $EndDate);
	$statement->bindValue(":Title", $Title);
	$statement->bindValue(":Summary", $Summary);
	$statement->bindValue(":Company", $Company);
	$statement->bindValue(":StartTime", $StartTime);
	$statement->bindValue(":EndTime", $EndTime);
	$statement->bindValue(":email", $email);
	$statement->bindValue(":tickets", $tickets);
	$statement->bindValue(":price", $price);


	$statement->execute();

	
	$statement->closeCursor();


	}


}





function iframeEvents(){

	global $conn;
	$array = getdate();
	$StartDate = $array["year"]."-".$array["mon"]."-".$array["mday"];
	$EndDate = $array["year"]."-".$array["mon"]."-".($array["mday"]+14);
	$query = 'SELECT * FROM EVENT where :StartDate <= EndDate and :EndDate >= EndDate ORDER BY StartDate';
	$statement = $conn->prepare($query);
	$statement->bindValue(':StartDate', $StartDate);
	$statement->bindValue(':EndDate', $EndDate);
	$statement->execute();
	$events = $statement->fetchAll();
	$statement->closeCursor();
	return $events;
}

function event($id){
	global $conn;
	$query = 'SELECT * FROM EVENT where ID = :ID';
	$statement = $conn->prepare($query);
	$statement->bindValue(':ID', $id);
	$statement->execute();
	$events = $statement->fetch();
	$statement->closeCursor();
	return $events;
}


?>