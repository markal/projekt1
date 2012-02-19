<?php
    //markalDEV
    function check_required_fields($required_array) {
        $field_errors = array();		
		foreach ($required_array as $fieldname) {
			if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname]))  {
				$field_errors[] = $fieldname;
			}
		}
		return $fields_errors;
    }
    
	function check_field_length($field_length_array) {
		$field_errors = array();
		foreach ($field_length_array as $fieldname => $maxlength) {
			if (strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength) {
				$field_errors = $fieldname;
			}
		}
		return $field_errors;
	}
    
	function display_errors($error_array) {
		echo "<p class=\"message\">";
		echo "Please review the following fields: <br />";
		foreach ($errors as $error) {
			echo " - " . $error . "<br />";
		}
		echo "</p>";
	}
    
?>