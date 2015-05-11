<?php
include '../db/dbhelper.php';
require('SAM/php_sam.php');

$survey_id = $_REQUEST['q_push_survey'];
$target =  'dayday/' + $_REQUEST['Device_ID'];

$survey_details = getSurveyDetails($survey_id);
if ($survey_details['code'] > 0) {
	$survey_questions = getQuestionsForSurvey($survey_id);
	$survey_name = $survey_details['data']['survey_name'];
	echo "<h1>$survey_name</h1>" . "<br>";
	foreach ($survey_questions['data'] as $question) {
		$question_id = $question['question_id'];
		$options = getOptionsForQuestion($question_id, $survey_id);
		//print_r($options['data'][0]['option_type']);
		echo "<br>";
		echo $question['question_text'] . "  ->  Options of type: " . $question['question_type'] . "<br>";
		if ($options['code'] > 0) {
			echo '<ul>';
			foreach ($options['data'] as $option) {
				echo "<li>" . $option['option_type'] . " -> " . $option['option_text'] . "</li>";
			}
			echo "</ul>";
		}
	}
} else {
	echo 'Survey Not Found';
}

//create a new connection object
$conn = new SAMConnection();

//start initialise the connection
$conn->connect(SAM_MQTT, array("SAM_HOST" => '127.0.0.1', "SAM_PORT" => 1883));      
//create a new MQTT message with the output of the shell command as the body
$msgCpu = new SAMMessage($_REQUEST['message']);

//send the message on the topic cpu
$conn->send('topic://'.$_REQUEST['target'], $msgCpu);
         
$conn->disconnect();         

echo 'MQTT Message to ' . $_REQUEST['target'] . ' sent: ' . $_REQUEST['message']; 

$options = array();

?>
