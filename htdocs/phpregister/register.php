<?php
ini_set('session.gc_maxlifetime', 300);
session_set_cookie_params(300);
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
	$email = $_SESSION['email'];
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
					<li class="item "><a href="/phpregister/dashboard.php">Dashboard</a></li>
				</ul>
				<?php
				include('../con/connection.php');
				$sql = "Select * from User where user_email='$email'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
				if($row["user_type"] == 'ADMIN'){
					echo '<ul class="left"><li class="item "><a href="/phpregister/userList.php">User List</a></li></ul>';
					echo '<ul class="left"><li class="item "><a href="/phpregister/accommodation.php">Add Accommodation</a></li></ul>';
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
					$target_dir = "/Applications/XAMPP/xamppfiles/htdocs/dashboard/images/";
					$filename = $_FILES["fileToUpload"]["name"];
					$target_file = $target_dir . basename($filename);

					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

					if (isset($_POST['submit'])) {
						$name = mysqli_real_escape_string($conn, $_POST['name']);
						$dob = mysqli_real_escape_string($conn, $_POST['dob']);
						$phone = mysqli_real_escape_string($conn, $_POST['phone']);
						$kin = mysqli_real_escape_string($conn, $_POST['kin']);
						$relationship = mysqli_real_escape_string($conn, $_POST['relationship']);
						$illness = mysqli_real_escape_string($conn, $_POST['illness']);
						$address = mysqli_real_escape_string($conn, $_POST['address']);
						$source = mysqli_real_escape_string($conn, $_POST['source']);
						$source_address = mysqli_real_escape_string($conn, $_POST['source_address']);
						$accommodation = mysqli_real_escape_string($conn, $_POST['accommodation']);
						// Check if image file is a actual image or fake image
						$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
						if (file_exists($target_file)) {
							$extension = pathinfo($target_file, PATHINFO_EXTENSION);
							$filename = pathinfo($target_file, PATHINFO_FILENAME);
							$counter = 1;
							while (file_exists($target_dir . $filename . '_' . $counter . '.' . $extension)) {
								$counter++;
							}
							$filename = $filename . '_' . $counter;
							$target_file = $target_dir . $filename . '.' . $extension;
						}
						if ($imageFileType != "jpg" && $imageFileType != "jpeg") {
							echo '<p style="color: red;">Sorry, only JPG files are allowed.</p>';
							$uploadOk = 0;
						}
						if ($_FILES["fileToUpload"]["size"] > 500000) {
							echo '<p style="color: red;">Sorry, your file is too large.</p>';
							$uploadOk = 0;
						}
						if ($check !== false) {
							list($width, $height) = $check;
							if ($width != $height) {
								echo '<p style="color: red;">File dimensions should be 500 X 500 pixel.</p>';
								$uploadOk = 0;
							}
						}
						if (strtotime($dob) >= strtotime('today')) {
							echo '<p style="color: red;">Date of birth must be in the past.</p>';
							$uploadOk = 0;
						}
						if ($uploadOk == 1) {
							if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
								echo "The file ".htmlspecialchars(basename($_FILES["fileToUpload"]["name"]))." has been uploaded.";
								$sql = "INSERT INTO Registration(name, dob, email, phone, kin_name, kin_relationship, passport, illness, last_address, source, source_address, status, accommodation) VALUES('$name', '$dob', '$email', '$phone', '$kin', '$relationship', '$filename', '$illness', '$address', '$source', '$source_address', 'PENDING', '$accommodation')";
								$result = mysqli_query($conn, $sql);

								if ($result) {
									header("Location: dashboard.php");
								} else { 
									echo '<p style="color: red;">Registration Failed.</p>';
								}  
							} else {
								echo '<p style="color: red;">Sorry, there was an error uploading your file.</p>';
							}
						} 

					}
					?>
					<main class="box">
						<span class="border-line"></span>
						<form name="form" action="" method="POST" enctype="multipart/form-data">
							<h2 style="padding-bottom: 10px;">Registration Form</h2>
							<div>
								<label style="">Full Name</label>
								<input type="text" id="name" name="name" placeholder="John Patrick" required>
							</div>
							<div>
								<label style="">Date Of Birth</label>
								<input type="date" id="dob" name="dob" placeholder="Enter Date of Birth" required>
							</div>
							<div>
								<label style="">Phone Number</label>
								<input type="text" id="phone" name="phone" placeholder="+44 678678768" required>
							</div>
							<div>
								<label style="">Kin Name</label>
								<input type="text" id="kin" name="kin" placeholder="Shyam Lal" required>
							</div>
							<div>
								<label style="">Relationsip With Kin</label>
								<input type="text" id="relationship" name="relationship" placeholder="Brother" required>
							</div>
							<div>
								<label style="">Illness If Any</label>
								<input type="text" id="illness" name="illness" placeholder="Diabetes" required>
							</div>
							<div>
								<label style="">Last Address</label>
								<input type="text" id="address" name="address" placeholder="A 11/5, West Virginia" required>
							</div>
							<div>
								<label style="">Recommended Source</label>
								<input type="text" id="source" name="source" placeholder="Enter Source eg. police station, etc." required>
							</div>
							<div>
								<label style="">Source Address</label>
								<input type="text" id="source_address" name="source_address" placeholder="A 11/5, West Virginia" required>
							</div>
							<div>
								<label style="">Select Accommodation</label>
								<select id="accommodation" name="accommodation">
									<option value="">Select an Accommodation</option>
									<?php
									include('../con/connection.php');

									$sql = "Select * from Accommodation";
									$result = mysqli_query($conn, $sql);
									while($row = $result->fetch_assoc()){
										echo '<option value="'.$row["name"].' '.$row["street"].' '.$row["city"].' '.$row["province"].' '.$row["country"].' '.$row["zip"].'">'.$row["name"].' '.$row["street"].' '.$row["city"].' '.$row["province"].' '.$row["country"].' '.$row["zip"].'</option>';
									}
									?>
								</select>
							</div>
							<input type="file" name="fileToUpload" id="fileToUpload" required><br>
							<button class="action-button" type="submit" id="btn" value="Register" name = "submit">Register</button>
						</form>
					</main>
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
