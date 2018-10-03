<?php
require("../model/events_db.php");

echo "Upcoming Events <br><br>";

$events = iframeEvents();

foreach($events as $val){
	echo '<a href="event.php?ID='.$val["ID"].'"\>'.$val["Title"].' </a>', "<br>";
}

?>