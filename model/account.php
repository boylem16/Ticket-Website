<?php
session_start();
try{
	$conn = new PDO('mysql:host=localhost;dbname=Events','root','Password1!!');
}
catch(PDOException $e){
	exit();
}

	function userRegister($username, $password, $email, $company="", $FName, $LName, $dupUsername, $dupEmail, $dupCompany){

		if($dupUsername == 1){
			$username = "Username already taken";
		}

		if($dupEmail == 1){
			$email = "Email already in use";
		}

		if($dupCompany == 1){
			$company = "Name already in use";
		}

		echo '<form action="register.php" method="POST">
		First Name &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Last Name<br><input type="text" name="FName" value="'.$FName.'"> &nbsp &nbsp &nbsp &nbsp <input type="text" name="LName" value="'.$LName.'"><br> <br>

		E-mail   &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp Company Name (Optional) <br><input tupe="text" name="email" value="'.$email.'"> &nbsp &nbsp &nbsp &nbsp  <input type="text" name="company" value="'.$company.'"><br><br>

		Username &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp Password<br><input type="text" name="username" value="'.$username.'""> &nbsp &nbsp &nbsp  &nbsp <input type="text" name="password" value="'.$password.'"><br>
		
		<input type="submit" value="Register" >
		</form>';
	}


	function Login($name){
		echo '<form action="'.$name.'" method="POST">
		Username <input type="text" name="Username"><br>
		Password <input type="text" name="Password"><br>
		<input type="submit" value="Submit">
		</form>';
	}


	function verify($data, $name){

		if($name == 0){
			return 0;
		}

		global $conn;
		$query = 'SELECT count(1) FROM USERS WHERE ' .$name. ' = :data';
		$statement = $conn->prepare($query);
		$statement->bindValue(":data", $data);
		$statement->execute();
		$num = $statement->fetch();
		$statement->closeCursor();

		return $num[0];

	}

function register($username, $password, $email, $company, $FName, $LName){
	global $conn;
	$query = 'INSERT INTO USERS (Username, Password, Email, Company, FName, LName ) VALUES (:username, :password, :email, :company, :FName, :LName)';

	$password = hash('sha512', $password);
	$statement = $conn->prepare($query);
	$statement->bindValue(":username", $username);
	$statement->bindValue(":password",  $password);
	$statement->bindValue(":company", $company);
	$statement->bindValue(":FName", $FName);
	$statement->bindValue(":LName", $LName);
	$statement->bindValue(":email", $email);

	$statement->execute();

	
	$statement->closeCursor();
}

function signIn($username, $password){
	global $conn;
	$query = 'SELECT count(1) FROM USERS WHERE Username = :username and Password = :password';
	$password = hash('sha512', $password);
	$statement = $conn->prepare($query);
	$statement->bindValue(":username", $username);
	$statement->bindValue(":password", $password);
	$statement->execute();
	$num = $statement->fetch();
	$statement->closeCursor();
	return $num[0];

}


function select($user){

		global $conn;
		$query = 'SELECT * FROM USERS WHERE Username = :data';
		$statement = $conn->prepare($query);
		$statement->bindValue(":data", $user);
		$statement->execute();
		$array = $statement->fetch();
		$statement->closeCursor();

		return $array;
}


function buyTicket($ID, $User){
		global $conn;



		$query = 'INSERT INTO Tickets (EventID, Username, Tickets) VALUES (:ID, :Username, 1)';
		$statement = $conn->prepare($query);
		$statement->bindValue(":ID", $ID);
		$statement->bindValue(":Username", $User);
		$statement->execute();
		$statement->closeCursor();	

}



function TicketEvent($company, $user){
		global $conn;
		$query = 'SELECT * FROM EVENT WHERE Company = :data';
		$statement = $conn->prepare($query);
		$statement->bindValue(":data", $company);
		$statement->execute();
		$array = $statement->fetchAll();		
		$statement->closeCursor();

		echo "Events Planned: <br>";
		foreach ($array as $event) {
			echo $event["Title"].": ".$event["StartDate"]." - ".$event["EndDate"]."<br>"."<form style='display: inline' action='Update.php' method='POST'> <input style='display: inline' type='submit' value='Update'><input type='hidden' name='ID' value=".$event["ID"].">"."</form>";
			echo "<form action='Delete.php' method='POST' style='display: inline;'> <input style='display: inline' type='submit' value='Delete'><input type='hidden' name='ID' value=".$event["ID"]."</form> <br><br>";
		}
		echo "<br> <br>";

		$query = 'SELECT * FROM Tickets WHERE Username = :data';
		$statement = $conn->prepare($query);
		$statement->bindValue(":data", $user);
		$statement->execute();
		$array = $statement->fetchAll();
		$statement->closeCursor();

		echo "Events Attending: <br>";
		foreach ($array as $val) {
			$query = 'SELECT * FROM EVENT WHERE ID = :data';
			$statement = $conn->prepare($query);
			$statement->bindValue(":data", $val['EventID']);
			$statement->execute();
			$event = $statement->fetch();
			echo $event["Title"].": ".$event["StartDate"]." - ".$event["EndDate"]."<br>";
			$statement->closeCursor();
		}


}

function deleteEvent($ID){
	global $conn;
	$query = 'DELETE FROM EVENT WHERE ID = :data';
	$statement = $conn->prepare($query);
	$statement->bindValue(":data", $ID);
	$statement->execute();
	$statement->closeCursor();

}


function getUpdate($ID){
	global $conn;
	$query = 'SELECT * FROM EVENT WHERE ID = :data';
	$statement = $conn->prepare($query);
	$statement->bindValue(":data", $ID);
	$statement->execute();
	$array = $statement->fetch();
	$statement->closeCursor();

	return $array;
}

function update($ID, $Title, $StartTime, $StartDate, $EndTime, $EndDate, $Price, $Tickets, $Summary){
	global $conn;
	$query = 'UPDATE EVENT SET Title = :Title, StartTime = :StartTime, EndTime = :EndTime, StartDate = :StartDate, EndDate = :EndDate, Price = :Price, Tickets = :Tickets, Summary = :Summary WHERE ID = :ID';
	$statement = $conn->prepare($query);
	$statement->bindValue(":ID", $ID);
	$statement->bindValue(":Title", $Title);
	$statement->bindValue(":StartDate", $StartDate);
	$statement->bindValue(":EndDate", $EndDate);
	$statement->bindValue(":Summary", $Summary);
	$statement->bindValue(":Price", $Price);
	$statement->bindValue(":Tickets", $Tickets);
	$statement->bindValue(":StartTime", $StartTime);
	$statement->bindValue(":EndTime", $EndTime);

	$statement->execute();
	$statement->closeCursor();	
}


?>