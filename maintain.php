<?php

require('view/header.php');
require('model/account.php');

session_start();
echo "Username: ".$_SESSION["user"]."<br>";
echo "Email: ".$_SESSION["email"]."<br>";
echo "First Name: ".$_SESSION['fname']."<br>";
echo "Last Name: ".$_SESSION["lname"]."<br>";
echo "Company: ".$_SESSION["company"]."<br>";

echo "<br><br>";


TicketEvent($_SESSION["company"], $_SESSION["user"]);


?>