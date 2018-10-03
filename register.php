<?php 	
	require('view/header.php');
	require('model/account.php');
	session_start();

	$username = $_POST['username'];
	$password = $_POST['password'];
	$email    = $_POST['email'];
	$company  = $_POST['company'];
	$FName	  = $_POST['FName'];
	$LName	  = $_POST['LName'];
	$dupUser = 0;
	$dupEmail = 0;
	$dupCompany = 0;

	if($company == 0 && $username != 0){
		$company = $username.'$';
	}

	if($username != NULL && $password != NULL && $email != NULL && $FName != NULL && $LName != NULL){
		$dupUser = verify($username, "Username");
		$dupEmail = verify($email, "Email");
		$dupCompany = verify($company, "Company");

		if($dupEmail == 0 && $dupCompany == 0 && $dupUser == 0){			
			register($username, $password, $email, $company, $FName, $LName);
			$_SESSION['user'] = $username;
			$_SESSION['company'] = $company;
			$_SESSION['email'] = $email;
			$_SESSION['fname'] = $FName;
			$_SESSION['lname'] = $LName;
		}
	}


	if(!isset($_SESSION['user'])){
		userRegister($username, $password, $email, $company, $FName, $LName, $dupUser, $dupEmail, $dupCompany);

	}
	else{
		header("Location: /maintain.php");
	    exit;
	}

?>