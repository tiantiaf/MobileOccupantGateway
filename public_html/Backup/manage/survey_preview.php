<?php
include '../db/dbhelper.php';
$survey_id = $_GET['survey_id'];

$survey_details = getSurveyDetails($survey_id);
if ($survey_details['code'] > 0) {
	$survey_questions = getQuestionsForSurvey($survey_id);
	$survey_name = $survey_details['data']['survey_name'];
	echo "<h1>$survey_name</h1>";
	echo "<h1>Main Questions</h1>";
	foreach ($survey_questions['data'] as $question) {
		$question_id = $question['question_id'];
		$options = getOptionsForQuestion($question_id, $survey_id);
		//print_r($options['data'][0]['option_type']);
		echo "<br>";
		echo $question_id . ". ". $question['question_text'] . "  ->  Options of type: " . $question['question_type'] . "<br>";
		if ($options['code'] > 0) {
			echo '<ul>';
			foreach ($options['data'] as $option) {
				echo "<li>" . $option['option_type'] . " -> " . $option['option_text'] . "</li>";
			}
			echo "</ul>";
		}
		
	}
	
	echo "<h1>Branching Questions</h1>";
	
	$survey_rel_questions = getRelQuestionsForSurvey($survey_id);
	
	foreach ($survey_rel_questions['data'] as $rel_question) {
		if ($survey_rel_questions['code']  > 0) {
			echo '<br>';
			$rel_question_id = $rel_question['question_id'];
			$rel_options = getOptionsForRelQuestion($rel_question_id, $survey_id);
			echo $rel_question_id . ". ". $rel_question['question_text'] . "  ->  Options of type: " . $rel_question['question_type'] . "<br>";
		
			if ($rel_options['code'] > 0) {
			echo '<ul>';
			foreach ($rel_options['data'] as $rel_option) {
				echo "<li>" . $rel_option['option_type'] . " -> " . $rel_option['option_text'] . "</li>";
			}
			echo "</ul>";
		}
		}
		
	}
} else {
	echo 'Survey Not Found';
}
?>