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
					<li class="item "><a href="/phpregister/userList.php">User List</a></li>
				</ul>
				<ul class="left">
					<li class="item "><a href="/phpregister/accommodation.php">Add Accommodation</a></li>
				</ul>
				<ul class="right">
					<li class="item "><a href="../phplogin/logout.php">Logout</a></li>
				</ul>
			</section>
		</nav>
	</header>

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
										<th scope="col"></th>
										<th scope="col">Name</th>
										<th scope="col">Status</th>
										<th scope="col">Date of Birth</th>
										<th scope="col">Email</th>
										<th scope="col">Contact</th>
										<th scope="col">Name of Kin</th>
										<th scope="col">Relationship with Kin</th>
										<th scope="col">Any Illness</th>
										<th scope="col">Last Address</th>
										<th scope="col">Recommended Source</th>
										<th scope="col">Source Address</th>
										<th scope="col">Accommodation</th>
										<th scope="col"></th>
										<th scope="col"></th>
										<th scope="col"></th>
										<th scope="col"></th>
									</tr>
								</thead>
								<tbody>
									<?php
									include('../con/connection.php');

									$sql = "Select * from Registration";
									$result = mysqli_query($conn, $sql);
									while($row = $result->fetch_assoc()){
										echo '<tr><th scope="row"><div class="media align-items-center"><a href="#" class="avatar rounded-circle mr-3"><img alt="Image placeholder" src="../dashboard/images/'.$row["passport"].'.jpg"></a></div></th>';
										echo '<td>'.$row["name"].'</td>';
										$status_color = "bg-warning";
										if($row["status"] == 'APPROVED'){
											$status_color = "bg-success";
										} elseif ($row["status"] == 'WITHDRAWN') {
											$status_color = "bg-info";
										} elseif ($row["status"] == 'REJECTED') {
											$status_color = "bg-danger";
										}
										echo '<td><span class="badge badge-dot mr-4"><i class="'.$status_color.'"></i>' . $row["status"] . '</span></td>';
										echo '<td>'.$row["dob"].'</td>';
										echo '<td>'.$row["email"].'</td>';
										echo '<td>'.$row["phone"].'</td>';
										echo '<td>'.$row["kin_name"].'</td>';
										echo '<td>'.$row["kin_relationship"].'</td>';
										echo '<td>'.$row["illness"].'</td>';
										echo '<td>'.$row["last_address"].'</td>';
										echo '<td>'.$row["source"].'</td>';
										echo '<td>'.$row["source_address"].'</td>';
										echo '<td>'.$row["accommodation"].'</td>';
										// DELETE button
										echo '<td><button class="action-button" data-id="' . $row["reg_id"] . '">DELETE</button></td>';
        								// APPROVE button
        								if($row["status"] == 'PENDING'){
        									echo '<td><button style="background:green;" class="action-button" data-id="' . $row["reg_id"] . '">APPROVE</button></td>';
        									echo '<td><button style="background:red;" class="action-button" data-id="' . $row["reg_id"] . '">REJECT</button></td></tr>';
        								} elseif($row["status"] == 'APPROVED'){
        									echo '<td><button style="background:red;" class="action-button" data-id="' . $row["reg_id"] . '">REJECT</button></td></tr>';
        								} elseif($row["status"] == 'REJECTED') {
        									echo '<td><button style="background:green;" class="action-button" data-id="' . $row["reg_id"] . '">APPROVE</button></td>';
        								}
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
            if (this.textContent === 'VISIT') {
            	window.location.href = "/phpregister/registration.php?id=" + id;
            } else if (this.textContent === 'DELETE' && confirm("Are you sure you want to delete this application?")) {
            	window.location.href = "/phpregister/delete.php?id=" + id;
            } else if (this.textContent === 'APPROVE' && confirm("Are you sure you want to approve this application?")) {
            	window.location.href = "/phpregister/approve.php?id=" + id;
            } else if (this.textContent === 'REJECT' && confirm("Are you sure you want to reject this application?")) {
            	window.location.href = "/phpregister/reject.php?id=" + id;
            }
        });
    });
</script>
</body>
</html>
