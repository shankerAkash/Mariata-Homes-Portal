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
			<!-- 	<ul class="left">
					<li class="item "><a href="/dashboard/development.html">DEVELOPMENT</a></li>
				</ul> -->
				<ul class="right">
					<li class="item "><a href="../phplogin/signup.php">Sign Up</a></li>
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
						$email = mysqli_real_escape_string($conn, $_POST['email']);
						$pass = mysqli_real_escape_string($conn, $_POST['pass']);

						$sql = "Select * from User where user_email='$email' and password='$pass'";
						$result = mysqli_query($conn, $sql);
						$row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
						$count = mysqli_num_rows($result); 

						if($count == 1){  
							session_start();
							$_SESSION["id"] = $row["id"];
							$_SESSION["email"] = $email;
							$_SESSION["logged_in"] = true;

							setcookie("username", $username, time() + (60), "/");
							header("Location: ../phpregister/dashboard.php");
						}  
						else{  
							echo '<p style="color: red;">Login failed. Invalid username or password!!.</p>';
						}     
					}
					?>
					<form name="form" action="login.php" method="POST">
						<h2>Login Form</h2>
						<input type="email" id="email" name="email" placeholder="Enter Email" required>
						<input type="password" id="pass" name="pass" placeholder="Create Password" required>
						<button class="action-button" type="submit" id="btn" value="login" name = "submit">Login</button>
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
