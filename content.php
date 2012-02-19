<?php include_once 'includes/connection.php';	?>
<?php require_once 'includes/functions.php';	?>
<?php find_selected_page(); 	?>
<?php include 'includes/header.php'; ?>
	<nav>
		<?php 	echo navigation($sel_subject, $sel_page);	?>
		<br />
		<a href="new_subject.php">+ Add new subject</a><br />
		
	</nav>
	
	<div>
		<?php if (!is_null($sel_subject)) { ?>
			<h2><?php 	echo $sel_subject["menu_name"];	?></h2>
		<?php }	elseif (!is_null($sel_page)) {	?>
			<h2><?php 	echo $sel_page['menu_name'];	?></h2>
			<p class="page_content"><?php	echo $sel_page['content'];	?></p>
			<br />
			<a href="edit_page.php?page=<?php 	echo urlencode($sel_page['id']);	?>">Edit page: <?php 	echo $sel_page['menu_name'];	?></a>
			
		<?php 	} else {	?>
			<h2>Select a subject or a page.</h2>
		<?php 	}	?>
		
		
	</div>
<?php 	include 'includes/footer.php';	?>