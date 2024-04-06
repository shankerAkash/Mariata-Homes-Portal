<?php
include('../con/connection.php');
if (isset($_GET['id'])) {
	$id = $_GET['id'];

	$sql = "DELETE FROM Accommodation WHERE accommodation_id='$id'";
	$result = mysqli_query($conn, $sql);

	if ($result) {
        // Deletion successful
		header("Location: accommodation.php");
	} else {
        // Handle error
		echo '<p id="errorMessage" style="color: red;">Sorry, Accommodation could not be added.</p>';
		echo '<script>
		setTimeout(function() {
			document.getElementById("errorMessage").style.display = "none";
			window.location.href = "dashboard.php";
			}, 2000); // 2000 milliseconds = 2 seconds
			</script>';
		}

	}
	?>