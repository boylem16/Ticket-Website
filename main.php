<html>
<head>
<link href="calendar.css" type="text/css" rel="stylesheet" />
<?php require('view/header.php') ?>
</head>
<body>

<?php
	session_start();
	$username = $_post["username"];
	if($username != NULL and $password != NULL){
		$password = hash('sha512', $_post["password"]);
		$num = signIn($username, $password);
		if($num == 1){
			$_SESSION['user'] = $username;
		}
	}

include 'calendar.php';
 
$calendar = new Calendar();

echo $calendar->show();
?>


</body>
</html>        
