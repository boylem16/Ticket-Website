<?php

	session_start();
	require('model/account.php');
	require('view/header.php');

	if($_POST["ID"] != NULL){
		$_SESSION['ID'] = $_POST['ID'];
		$_SESSION['Price']  = $_POST['Price'];
		$_SESSION['Title']  = $_POST['Title'];
	}

	if(!isset($_SESSION['user'])){
		$user = $_POST['Username'];
		$password = $_POST['Password'];


		$num = signIn($user,$password);

		if($num == 1){
			$_SESSION['user'] = $user;
			$array = select($user);
			$_SESSION['company'] = $array['Company'];
			$_SESSION['fname'] = $array['FName'];
			$_SESSION['lname'] = $array['LName'];
			$_SESSION['email'] = $array['Email'];
			header("Refresh: 0");
		}
		else{
			Login("ticket.php");
		}


	}
	else{




	buyTicket($ID, $_SESSION["user"]);

	echo "Event: ",$_SESSION["Title"], "<br>";
	echo "Price: $",$_SESSION["Price"];
	}

?>