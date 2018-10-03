<?php

require("model/account.php");
require('view/header.php');
session_start();

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
	header("Location: /maintain.php");
	exit;
}

Login("signin.php");

?>