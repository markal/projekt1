<?php include_once 'includes/connection.php';	?>
<?php require_once 'includes/functions.php';	?>
<?php
		
	$errors = array();
	//Form Validation
	$required_fields = array('subject_id','menu_name','position','visible');
	foreach ($required_fields as $fieldname) {
		if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
			$errors[] = $fieldname;
		}
	}
	
	$field_with_lenghts = array('menu_name' => 30);
	foreach ($field_with_lenghts as $fieldname => $maxlenght) {
		if (strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlenght) {
			$errors = $fieldname;
		}
	}
	
	if (!empty($errors)) {
		redirect_to("new_page.php");
	}
	
?>
<?php	
	$subject_id =  mysql_prep($_POST['subject_id']);
	$menu_name = mysql_prep($_POST['menu_name']); 
	$position = mysql_prep($_POST['position']);
	$visible =  mysql_prep($_POST['visible']);
	$content =  mysql_prep($_POST['content']);
	
	$query = "INSERT INTO pages (subject_id, menu_name, position, visible, content) 
							VALUES ({$subject_id}, '{$menu_name}', {$position}, {$visible}, '{$content}')";
	
	if (mysql_query($query, $connection)) {
		//Success!
		redirect_to("content.php");
	} else {
		//Display error message.
		echo "<p>Page creation failed.</p>";
		echo "<p>" . mysql_error()  . "</p>";
	}
?>

<?php mysql_close($connection);	?>