<?php
	include ('/db/dbhelper.php');
	$categories = getAllData("survey_category");
	if ($categories) {
		foreach ($categories as $category) {
			echo '<option value="' . $category['category_id'] . '">' . $category['category_text'] . '</option>';
			//echo '<p id="' . $category['category_id'] . '">' . $category['category_text'] . '</p>';
			echo $category['category_id'];
		echo $category['category_text'];
		}
		echo "true";
		echo $category['category_id'];
		echo $category['category_text'];
	} else {
		//echo "<option>ERROR</option>";
		echo "false";
	}
?>