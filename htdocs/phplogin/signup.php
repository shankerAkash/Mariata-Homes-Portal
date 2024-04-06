<?php
ini_set('session.gc_maxlifetime', 300);
session_set_cookie_params(300);
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
	header("Location: ../phpregister/dashboard.php");
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- Always force latest IE rendering engine or request Chrome Frame -->
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- Use title if it's in the page YAML frontmatter -->
	<title>Mariata Homes Charitable</title>

	<meta name="description" content="XAMPP is an easy to install Apache distribution containing MariaDB, PHP and Perl." />
	<meta name="keywords" content="xampp, apache, php, perl, mariadb, open source distribution" />

	<link href="/dashboard/stylesheets/normalize.css" rel="stylesheet" type="text/css" /><link href="/dashboard/stylesheets/all.css" rel="stylesheet" type="text/css" />
	<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

	<script src="/dashboard/javascripts/modernizr.js" type="text/javascript"></script>


	<link href="/dashboard/images/favicon.png" rel="icon" type="image/png" />


</head>

<body class="index">
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=277385395761685";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<header class="header contain-to-grid">
		<nav class="top-bar" data-topbar>
			<ul class="title-area">
				<li class="toggle-topbar menu-icon">
					<a href="#">
						<span>Menu</span>
					</a>
				</li>
			</ul>

			<section class="top-bar-section">
				<!-- Left Nav Section -->
				<!-- <ul class="left">
					<li class="item "><a href="/dashboard/development.html">DEVELOPMENT</a></li>
				</ul> -->
				<ul class="right">
					<li class="item "><a href="../phplogin/login.php">Login</a></li>
				</ul>
			</section>
		</nav>
	</header>

	<div class="wrapper">
		<div class="hero">
			<div class="row">
				<div class="large-12 columns">
					<h1><a href="http://localhost/dashboard/" ><img src="/dashboard/images/xampp-logo.png" /></a></h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<h2>Welcome to Mariata Homes Charitable!</h2>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<div id="form" class="signupform">
					<?php
					include('../con/connection.php');
					if (isset($_POST['submit'])) {
						$name = mysqli_real_escape_string($conn, $_POST['name']);
						$email = mysqli_real_escape_string($conn, $_POST['email']);
						$pass = mysqli_real_escape_string($conn, $_POST['pass']);
						$cpass = mysqli_real_escape_string($conn, $_POST['cpass']);



						$sql = "Select * from User where user_email='$email'";
						$result = mysqli_query($conn, $sql);        
						$count_user = mysqli_num_rows($result); 

						if($count_user == 0){  

							if($pass == $cpass) {

								if (strlen($pass) < 8) {
									echo '<p style="color: red;">Password should be at least 8 characters long.</p>';
								} elseif (!preg_match('/[A-Z]/', $pass) || !preg_match('/[a-z]/', $pass) || !preg_match('/\d/', $pass) || !preg_match('/[^a-zA-Z\d]/', $pass)) {
									echo '<p style="color: red;">Password should include at least one uppercase letter, one lowercase letter, one digit, and one special character...</p>';
								} else {
									$sql = "INSERT INTO User(user_email, password, user_name, user_type) VALUES('$email', '$pass', '$name', 'USER')";
									$result = mysqli_query($conn, $sql);

									if ($result) {
										header("Location: login.php");
									}
								}	
							} 
							else { 
								echo '<p style="color: red;">Passwords do not match.</p>';
							}      
						}  
						else{  
							if($count_user>0){
								echo '<p style="color: red;">Email already exists!!.</p>';
							}
						}     
					}
					?>
					<form name="form" action="" method="POST">
						<h2>Signup Form</h2>
						<input type="text" id="name" name="name" placeholder="Enter Full Name" required>
						<input type="email" id="email" name="email" placeholder="Enter Email" required>
						<input type="password" id="pass" name="pass" placeholder="Create Password" required>
						<input type="password" id="cpass" name="cpass" placeholder="Retype Password" required>
						<button class="action-button" type="submit" id="btn" value="SignUp" name = "submit">Sign Up</button>
					</form>
				</div>
			</div>
		</div>


	</div>

	<footer class="footer">
		<div class="columns">
			<div class="footer_lists-container row collapse">
				<div class="footer_social columns large-2">
					<p class="footer_copyright">All Rights Reserved</p>
				</div>
				<ul class="footer_links columns large-9">
				</ul>
			</div>
		</div>
	</footer>

	<!-- JS Libraries -->
	<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="/dashboard/javascripts/all.js" type="text/javascript"></script>
</body>
</html>