<head>

<link rel="stylesheet" type="text/css" href="assets/css/splash.css">
<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
<link rel="stylesheet" type="text/css" href="assets/css/form.css">
</head>


<html>	
<body>	
	<div id="header">
		<p class="beta">Beta</p>
		<h1>CCAudio</h1>
		<br>
		<h4>Please login or register to upload or download material</h4>
	</div>

	<div id="loginform" >                        
		<form id="login" method="post" action="index.php" name="loginform" id="loginform"> 
			<h3>Login</h3>                                   
			<input id="login_input_username" class="login_input" type="text" name="user_name" placeholder="Username" required />
			<input id="login_input_password" class="login_input" type="password" name="user_password" placeholder="Password" autocomplete="off" required />                 
			<input type="submit"  name="login" value="Log in">
		</form>
	</div>

	<div id="loginform" >
		<form id="login" method="post" action="register.php" name="registerform" id="loginform">
			<h3>Register</h3>
			<input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" placeholder="Username" required />
			<input id="login_input_email" class="login_input" type="email" name="user_email" placeholder="Email" required />
			<input id="login_input_password_new" class="login_input" type="password" name="user_password_new" placeholder="Password" pattern=".{6,}" required autocomplete="off" />
			<input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" placeholder="Password Confirmation" pattern=".{6,}" required autocomplete="off" />
			<input id="t&c" type="checkbox" name="t&c">I have read and I agree to the <a>Terms and Conditions</a>
			<input type="submit"  name="register" value="Register" />  
		</form>
	</div>


	
   
	
</body>
</html>
								
