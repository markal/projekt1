<?php include_once 'includes/connection.php';	?>
<?php require_once 'includes/functions.php';	?>

<?php 	
	if (intval($_GET['page']) == 0) {
		redirect_to("content.php");
	}
	
	include_once 'includes/form_functions.php';
	
	if (isset($_POST['submit'])) {
		$errors = array();
		
		$required_fields = array('menu_name','position','visible'. 'content');
		check_required_fields($required_fields);
		
		$field_with_lengths = array('menu_name' => 30);
		check_field_length($field_with_lengths);
		
		if (empty($errors)) {
			//Perform update!
			$id = mysql_prep($_GET['page']);
			$menu_name = trim(mysql_prep($_POST['menu_name']));
			$position = mysql_prep($_POST['position']);
			$visible = mysql_prep($_POST['visible']);
			$content = mysql_prep($_POST['content']);
			
			$edit_query = "UPDATE pages SET 
				     	menu_name = '{$menu_name}',
					     position = {$position},
					     visible = {$visible},
					     content = '{$content}'  
				     WHERE id = {$id}";
			
			$result = mysql_query($edit_query, $connection);
			if (mysql_affected_rows() == 1) {
				//Success
				$message = "The page was successfully updated.";
			} else {
				//Failed
				$message = "Page update failed.";
				$message = "<br />" . mysql_error();
			}
			
		} else {
			//errors occurred
			$message = "There were " . count($errors) . " errors in the form.";
		}

	}	//end: if (is set($_POST['submit']))
?>
<?php  find_selected_page(); 	?>
<?php include 'includes/header.php'; ?>
	<nav>
		<?php 	echo navigation($sel_subject, $sel_page);	?>
		
	</nav>
	
	<div>
		<h2>Edit Page: <?php echo $sel_page['menu_name']; ?></h2>
		<?php 	if (!empty($message)) { echo "<p class=\"message\">" . $message . "</p>"; } ?>
		<?php 	
				//output list of the fields with errors
				if (!empty($errors)) {
					display_errors($errors);
				}
		
		?>
		
		<form action="edit_page.php?page=<?php echo urlencode($sel_page['id']); ?>" method="post">
			<?php 	include 'page_form.php';	?>
			
			<input type="submit" name="submit" value="Edit Page" /><br /><br />
			<a href="delete_page.php?page=<?php 	echo urlencode($sel_page['id']); ?>" 
				onclick="return confirm('Are you sure?')" >Delete Page</a>
		</form>
		<br />
		<a href="content.php">Cancel</a>
		<hr /><br />
		+ <a href="new_page.php?subj=<?php 	echo urlencode($sel_page['subject_id']);	?>">Add new Page to this Subject</a>
	</div>
<?php 	include 'includes/footer.php';	?>

