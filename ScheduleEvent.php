<?php
	session_start();
    require('view/header.php');
    require('model/account.php');
	$day = $_GET["day"];
	$month = $_GET["month"];
	$year = $_GET["year"];




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
			Login("ScheduleEvent.php?day=".$day."&month=".$month."&year=".$year);
		}


	}
	else{
		echo '<form action="RequestEvent.php" method="POST">
		Event Title: <input type="text" name="Title"><br>
		<input type="hidden" name="email" value="'.$_SESSION['email'].'"><br>
		Start Date:  Time <input type="text" name="StartTime"> Day <input type="text" name="StartDay" value='.$day.'> Month <input type="text" name="StartMonth" value='.$month.'> Year <input type="text" name="StartYear" value='.$year.'>  <br>
		End Date: Time <input type="text" name="EndTime"> Day <input type="text" name="EndDay" value='.$day.'> Month <input type="text" name="EndMonth" value='.$month.'> Year <input type="text" name="EndYear" value='.$year.'>  <br>
		
		Tickets: 
		<input type="text" name="tickets" value="0"> &nbsp &nbsp &nbsp
		Price: 
		<input type="text" name="price" value="0"> <br><br>
		Event Summary:<br>
		<input type="hidden" name="Company" value="'.$_SESSION['company'].'">
		<input type="text" name="Summary">
		<br>
		<input type="submit" value="Submit">
		</form>';
	}
	

?>