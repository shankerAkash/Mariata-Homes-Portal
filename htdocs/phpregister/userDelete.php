<?php
include('../con/connection.php');
if (isset($_GET['id'])) {
	$id = $_GET['id'];

	$sql = "SELECT * FROM User WHERE user_id='$id'";
	$result = mysqli_query($conn, $sql);
	while($row = $result->fetch_assoc()){
		$email = $row["user_email"];
		$sql1 = "SELECT * FROM Registration WHERE email='$email'";
		$result1 = mysqli_query($conn, $sql1);
		if (mysqli_num_rows($result1) > 0) {
			while($row1 = $result1->fetch_assoc()){
				$reg_id = $row1["reg_id"];
				$sql2 = "DELETE FROM Registration WHERE reg_id='$reg_id'";
				$result2 = mysqli_query($conn, $sql2);

				if ($result2) {
					$sql3 = "DELETE FROM User WHERE user_id='$id'";
					$result3 = mysqli_query($conn, $sql3);

					if ($result3) {
						header("Location: userList.php");
					} else {
						echo '<p id="errorMessage" style="color: red;">Sorry, User  could not be deleted.</p>';
						echo '<script>
						setTimeout(function() {
							document.getElementById("errorMessage").style.display = "none";
							window.location.href = "dashboard.php";
							}, 2000); // 2000 milliseconds = 2 seconds
							</script>';
						}
					} else {
						echo '<p id="errorMessage" style="color: red;">Sorry, User  could not be deleted because of Registrations</p>';
						echo '<script>
						setTimeout(function() {
							document.getElementById("errorMessage").style.display = "none";
							window.location.href = "dashboard.php";
							}, 2000); // 2000 milliseconds = 2 seconds
							</script>';
						}
					}
				} else {
					$sql3 = "DELETE FROM User WHERE user_id='$id'";
					$result3 = mysqli_query($conn, $sql3);

					if ($result3) {
						header("Location: userList.php");
					} else {
						echo '<p id="errorMessage" style="color: red;">Sorry, User  could not be deleted.</p>';
						echo '<script>
						setTimeout(function() {
							document.getElementById("errorMessage").style.display = "none";
							window.location.href = "dashboard.php";
							}, 2000); // 2000 milliseconds = 2 seconds
							</script>';
						}
					}

				}

			}
			?>