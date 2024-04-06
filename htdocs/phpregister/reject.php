<?php
include('../con/connection.php');
if (isset($_GET['id'])) {
	$id = $_GET['id'];

	$sql = "UPDATE Registration SET status='REJECTED' WHERE reg_id='$id'";
	$result = mysqli_query($conn, $sql);

	if ($result) {
        // Deletion successful
		header("Location: dashboard.php");
	} else {
        // Handle error
		echo '<p id="errorMessage" style="color: red;">Sorry, Application could not be REJECTED.</p>';
		echo '<script>
		setTimeout(function() {
			document.getElementById("errorMessage").style.display = "none";
			window.location.href = "dashboard.php";
			}, 2000); // 2000 milliseconds = 2 seconds
			</script>';
		}

	}
	?>