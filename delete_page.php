<?php include_once 'includes/connection.php';	?>
<?php require_once 'includes/functions.php';	?>
<?php 	
	if (intval($_GET['page']) == 0) {
		redirect_to("content.php");
	}
	
	$id = mysql_prep($_GET['page']);
	
	if ($page = get_page_by_id($id)) {
		
		$query = "DELETE FROM pages WHERE id = {$id} LIMIT 1";
		$result = mysql_query($query, $connection);
		if (mysql_affected_rows() == 1) {
			redirect_to("content.php");
		} else {
			//Deletion failed
			echo "<p>Page deletion failed!</p>";
			echo "<br />" . mysql_error() . "<br />";
			echo "<a href=\"content.php\">Return to main page</a>";
		}
	} else {
		//Subject did not exist in database
		redirect_to("content.php");
	}

?>
<?php 	include 'includes/footer.php';	?>