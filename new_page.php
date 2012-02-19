<?php include_once 'includes/connection.php';	?>
<?php require_once 'includes/functions.php';	?>
<?php  find_selected_page(); 	?>
<?php include 'includes/header.php'; ?>
	<nav>
		<?php 	echo navigation($sel_subject, $sel_page);	?>
		
	</nav>
	
	<div>
		<h2>Add New Page</h2>
		<form action="create_page.php" method="post">
			<input type="hidden" name="subject_id" id="subject_id" value="<?php echo $sel_subject['id']; ?>" />
			<?php 	$new_page = true;	?>
			<?php 	include 'page_form.php';	?>
			
			<input type="submit" value="Add Page for Subject:<?php 	echo $sel_subject['menu_name'];	?>" />			
		</form>
		<br />
		<a href="content.php">Cancel</a>		
	</div>
<?php 	include 'includes/footer.php';	?>

