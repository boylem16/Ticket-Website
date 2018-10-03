<?php
	require("model/account.php");
	$ID = $_POST["ID"];

	$event = getUpdate($ID);
	echo $event["Title"];

		echo '<form action="RequestUpdate.php" method="POST">
		Event Title: <input type="text" name="Title" value="'.$event['Title'].'"><br>
		Start Date:  Time <input type="text" name="StartTime value="'.$event["StartTime"].'"> Day <input type="text" name="StartDay"> Month <input type="text" name="StartMonth"> Year <input type="text" name="StartYear">  <br>
		End Date: Time <input type="text" name="EndTime" value="'.$event["EndTime"].'"> Day <input type="text" name="EndDay"> Month <input type="text" name="EndMonth"> Year <input type="text" name="EndYear">  <br>
		
		Tickets: 
		<input type="text" name="Tickets" value='.$event["Tickets"].'> &nbsp &nbsp &nbsp
		Price: 
		<input type="text" name="Price" value='.$event["Price"].'> <br><br>
		Event Summary:<br>
		<input type="text" name="Summary" value='.$event["Summary"].'>
		<br>
		<input type="submit" value="Submit">
		</form>';
?>