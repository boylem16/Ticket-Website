<!DOCTYPE html>
<?php 
session_start();
	
?>
<head>
	<script>
		
		function home(){
			window.location.href = "/../main.php";
		}

		function signin(){
			window.location.href = "/../signin.php";
		}

		function register(){
			window.location.href = "/../register.php";
		}

		function signout(){
			window.location.href = "/../clear.php?url=main.php";
		}

		function maintain(){
			window.location.href = "/../maintain.php";
		}

	</script> 



	<div style="text-align: right;">
			<button onclick="home()">Home</button>
	<?php
		if(!isset($_SESSION['user'])){
			echo '<button onclick="signin()">Sign In</button>';
			echo '<button onclick="register()">Register</button>';
		}
		else{
			echo '<button onclick="signout()">Sign Out</button>';
			echo '<button onclick="maintain()">Account</button>';	
		}
	?>
	</div>

</head>