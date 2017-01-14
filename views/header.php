<?php
require_once("assets/config/db.php");
require_once("assets/php/LoginScript.php");
$login = new Login();
?>


<html>
	<head>
		<title>CCAudio</title>
		<!-- Styles -->
			<link rel="stylesheet" type="text/css" href="assets/css/header.css">
			<link rel="stylesheet" type="text/css" href="assets/css/form.css">
			<link rel="stylesheet" type="text/css" href="assets/css/styles.css">		
        <!-- JS -->
			<!-- JQuery -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>			
			<!-- Scripts -->
			<script src="assets/js/wavesurfer.min.js"></script>
			<script src="assets/js/tooltip.js"></script>   
			<script src="assets/js/ajax.js"></script>
			
	</head>	
	
    <body>
		<div id="headerbck">
			<div id="header">	
				
				<h1><a href="index.php"> CCAudio </a></h1> <p class="beta">Beta</p>		
				
				<form action="search.php" method="get">
					  <input type="text" name="q" placeholder="Click here to search..">
				</form>	        			
				
				<ul id="nav">         
					<li><img src="assets/images/defaultpp.png"></li> 
					
					<li>
						<a href="profile.php"><?php 
							if ($login->isUserLoggedIn() == true) {
								echo $_SESSION['user_name'];
							} 
							else {
								echo 'Guest';
							}

							?></a>
						
					</li>
					<li><a href="upload.php" >Upload</a></li>                      
				</ul>	
			</div>
		</div>
	</body>
</html>


