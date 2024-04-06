<?php
include('../con/connection.php');
if (isset($_GET['id'])) {
	$id = $_GET['id'];

	$sql = "UPDATE User SET user_type='ADMIN' WHERE user_id='$id'";
	$result = mysqli_query($conn, $sql);

	if ($result) {
        // Deletion successful
		header("Location: userList.php");
	} else {
        // Handle error
		echo '<p id="errorMessage" style="color: red;">Sorry, User cannot be made Admin.</p>';
		echo '<script>
		setTimeout(function() {
			document.getElementById("errorMessage").style.display = "none";
			window.location.href = "dashboard.php";
			}, 2000); // 2000 milliseconds = 2 seconds
			</script>';
		}

	}
	?>