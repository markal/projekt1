<?php include_once 'includes/connection.php';	?>
<?php require_once 'includes/functions.php';	?>
<?php 	require_once 'includes/form_functions.php';	?>
<?php 	
	if (intval($_GET['subj']) == 0) {
		redirect_to("content.php");
	}

	if (isset($_POST['submit'])) {
		$errors = array();
		
		$required_fields = array('menu_name','position','visible');
		check_required_fields($required_fields);
		
		$field_with_lengths = array('menu_name' => 30);
		check_field_length($field_with_lengths);
		
		if (empty($errors)) {
			//Perform update!
			$id = mysql_prep($_GET['subj']);
			$menu_name = mysql_prep($_POST['menu_name']);
			$position = mysql_prep($_POST['position']);
			$visible = mysql_prep($_POST['visible']);
			
			$edit_query = "UPDATE subjects SET 
				     	menu_name = '{$menu_name}',
					     position = {$position},
					     visible = {$visible} 
				     WHERE id = {$id}";
			
			$result = mysql_query($edit_query, $connection);
			if (mysql_affected_rows() == 1) {
				//Success
				$message = "The subject was successfully updated.";
			} else {
				//Failed
				$message = "Subject update failed.";
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
		<h2>Edit Subject: <?php echo $sel_subject['menu_name']; ?></h2>
		<?php 	if (!empty($message)) { echo "<p class=\"message\">" . $message . "</p>"; } ?>
		<?php 	
				//output list of the fields with errors
				if (!empty($errors)) {
					display_errors($errors);
				}
		
		?>
		
		<form action="edit_subject.php?subj=<?php echo urlencode($sel_subject['id']); ?>" method="post">
			<p>Subject name:<br />
				<input type="text" name="menu_name" value="<?php echo $sel_subject['menu_name']; ?>" id="menu_name" /></p>
			<p>Position:<br />
				<select name="position">
				<?php 	
					$subject_set = get_all_subjects();
					$subject_count = mysql_num_rows($subject_set);
					//$subject_count+1 for new entry
					for ($count=1; $count <= $subject_count+1; $count++) { 
						echo "<option value=\"{$count}\"";
						if ($sel_subject['position'] == $count) {
							echo " selected";
						}
						echo ">{$count}</option>";
					}
				
				?>
				
				</select>
			</p>
			<p>Visible:<br />
					<input type="radio" name="visible" value="0" <?php 	if ($sel_subject['visible'] ==0) {
						echo "checked";	}	?>/> No&nbsp;
					
					<input type="radio" name="visible" value="1" <?php 	if ($sel_subject['visible'] ==1) {
						echo "checked";	}	?>/> Yes
								
			</p>
			<input type="submit" name="submit" value="Edit Subject" /><br /><br />
			<a href="delete_subject.php?subj=<?php 	echo urlencode($sel_subject['id']); ?>" onclick="return confirm('Are you sure?')" >Delete Subject</a>
		</form>
		<br />
		<a href="content.php">Cancel</a>
		<hr /><br />
		Pages for this subject:<br />
		<?php 	
				$subject_pages = get_pages_for_subject($sel_subject['id']);
				while ($page = mysql_fetch_array($subject_pages)) {
					echo "<a href=\"content.php?page={$page['id']}\">{$page['menu_name']}</a><br />";
				}
		?>
		<br />
		+ <a href="new_page.php?subj=<?php 	echo urlencode($sel_subject['id']);	?>">Add new Page to this Subject</a>
	</div>
<?php 	include 'includes/footer.php';	?>

