<?php include_once 'includes/connection.php';	?>
<?php require_once 'includes/functions.php';	?>
<?php find_selected_page(); 	?>
<?php include 'includes/header.php'; ?>
	<nav>
		<?php 	echo public_navigation($sel_subject, $sel_page);	?>
				
	</nav>
	
	<div>
		<?php if ($sel_page) { ?>
			<h2><?php 	echo htmlentities($sel_page['menu_name']);	?></h2>
			<p class="page_content">
				<?php	echo strip_tags(nl2br($sel_page['content']), "<b><br><p><a>");	?></p>
		<?php 	} else {	?>
			<h2>Wellcome to widget copr.</h2>
		<?php 	}	?>
		
		
		
	</div>
<?php 	include 'includes/footer.php';	?>
