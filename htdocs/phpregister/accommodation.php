<?php
ini_set('session.gc_maxlifetime', 300);
session_set_cookie_params(300);
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
	$email = $_SESSION['email'];
	include('../con/connection.php');

	$sql = "Select * from User where user_email='$email'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
	if($row["user_type"] == 'USER'){
		header("Location: /phpregister/dashboard.php");
	}
} else {
	header("Location: ../phplogin/login.php");
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
				<ul class="left">
					<li class="item "><a href="/phpregister/register.php">Register</a></li>
				</ul>
				<ul class="left">
					<li class="item "><a href="/phpregister/dashboard.php">Dashboard</a></li>
				</ul>
				<?php
				include('../con/connection.php');
				$sql = "Select * from User where user_email='$email'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
				if($row["user_type"] == 'ADMIN'){
					echo '<ul class="left"><li class="item "><a href="/phpregister/userList.php">User List</a></li></ul>';
				}
				?>
				<ul class="right">
					<li class="item "><a href="../phplogin/logout.php">Logout</a></li>
				</ul>
			</section>
		</nav>
	</header>

	<div class="wrapper">
		<div class="row">
			<div class="large-12 columns">
				<div id="form" class="signupform">
					<?php
					include('../con/connection.php');

					if (isset($_POST['submit'])) {
						$name = mysqli_real_escape_string($conn, $_POST['name']);
						$street = mysqli_real_escape_string($conn, $_POST['street']);
						$city = mysqli_real_escape_string($conn, $_POST['city']);
						$province = mysqli_real_escape_string($conn, $_POST['province']);
						$country = mysqli_real_escape_string($conn, $_POST['country']);
						$zip = mysqli_real_escape_string($conn, $_POST['zip']);

						$sql = "INSERT INTO Accommodation(name, street, city, province, country, zip) VALUES('$name', '$street', '$city', '$province', '$country', '$zip')";
						$result = mysqli_query($conn, $sql);

						if ($result) {
							header("Location: accommodation.php");
						} else { 
							echo '<p style="color: red;">Accommodation can not be added.</p>';
						}  
					}
					?>
					<main class="box">
						<span class="border-line"></span>
						<form name="form" action="" method="POST">
							<h2>Accommodation Registration Form</h2>
							<input type="text" id="name" name="name" placeholder="Apartment/Block/House Number" required>
							<input type="text" id="street" name="street" placeholder="Enter Street Name" required>
							<input type="text" id="city" name="city" placeholder="Enter City" required>
							<input type="text" id="province" name="province" placeholder="Enter Province" required>
							<input type="text" id="country" name="country" placeholder="Enter Country" required>
							<input type="text" id="zip" name="zip" placeholder="Enter ZIP code" required>
							<button class="action-button" type="submit" id="btn" value="add" name = "submit">Add</button>
						</form>
					</main>
				</div>
			</div>
		</div>

		<div class="wrapper">

			<div class="main-content">
				<div class="container mt-7">
					<!-- Table -->

					<div class="col">
						<div class="card shadow">
							<div class="card-header border-0">
								<h3 class="mb-0">Registration Records</h3>
							</div>
							<div class="table-responsive">
								<table class="table align-items-center table-flush">
									<thead class="thead-light">
										<tr>
											<th scope="col">House Number</th>
											<th scope="col">Street</th>
											<th scope="col">City</th>
											<th scope="col">Province</th>
											<th scope="col">Country</th>
											<th scope="col">ZIP</th>
											<th scope="col"></th>
										</tr>
									</thead>
									<tbody>
										<?php
										include('../con/connection.php');

										$sql = "Select * from Accommodation";
										$result = mysqli_query($conn, $sql);
										while($row = $result->fetch_assoc()){
											echo '<tr><td>'.$row["name"].'</td>';
											echo '<td>'.$row["street"].'</td>';
											echo '<td>'.$row["city"].'</td>';
											echo '<td>'.$row["province"].'</td>';
											echo '<td>'.$row["country"].'</td>';
											echo '<td>'.$row["zip"].'</td>';
										// DELETE button
											echo '<td><button class="action-button" data-id="' . $row["accommodation_id"] . '">DELETE</button></td></tr>';
										}
										?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
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
<script>
    // Add an event listener to all buttons with class "action-button"
    document.querySelectorAll('.action-button').forEach(function(button) {
    	button.addEventListener('click', function() {
    		var id = this.getAttribute('data-id');

            // Adjust this logic based on the intended behavior of the button
            if (this.textContent === 'DELETE' && confirm("Are you sure you want to delete this accommodation?")) {
            	window.location.href = "/phpregister/accommodationDelete.php?id=" + id;
            } 
        });
    });
</script>
</body>
</html>
