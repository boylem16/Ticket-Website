<?php

session_start();
session_unset();

$loc = $_GET["url"];
header("Location:".$loc." ");

?>