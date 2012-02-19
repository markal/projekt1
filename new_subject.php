<?php include_once 'includes/connection.php';	?>
<?php require_once 'includes/functions.php';	?>
<?php  find_selected_page(); 	?>
<?php include 'includes/header.php'; ?>
	<nav>
		<?php 	echo navigation($sel_subject, $sel_page);	?>
		
	</nav>
	
	<div>
		<h2>Add Subject</h2>
		<form action="create_subject.php" method="post">
			<p>Subject name:<br />
				<input type="text" name="menu_name" value="" id="menu_name" /></p>
			<p>Position:<br />
				<select name="position">
				<?php 	
					$subject_set = get_all_subjects();
					$subject_count = mysql_num_rows($subject_set);
					//$subject_count+1 for new entry
					for ($count=1; $count <= $subject_count+1; $count++) { 
						echo "<option value=\"{$count}\">{$count}</option>";
					}
				
				?>
				
				</select>
			</p>
			<p>Visible:<br />
				<input type="radio" name="visible" value="0" /> No&nbsp;
				<input type="radio" name="visible" value="1" /> Yes
			</p>
			<input type="submit" value="Add Subject" />			
		</form>
		<br />
		<a href="content.php">Cancel</a>		
	</div>
<?php 	include 'includes/footer.php';	?>

