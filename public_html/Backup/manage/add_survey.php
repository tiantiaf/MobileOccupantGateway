<?php

include ('../db/dbhelper.php');

$name = $_POST['survey_name'];
$title = $_POST['survey_title'];
$location = $_POST['survey_geo'];
$category = $_POST['survey_category'];
$desc = $_POST['survey_descr'];
$segments = $_POST['segments'];

$segmentsParams = getSegmentArray($segments);


$result = insertNewSurvey($name, $title, $location, $category, $desc, $segmentsParams);

if ($result['code'] > 0) {
	header('Location: manage.php?status=1&msg=' . $result['message']);
} else {
	header('Location: manage.php?status=0&msg=' . $result['message']);
}

function getSegmentArray($segments){
	$segments = split('#', $segments);
	
	$segmentsParams = array();
	
	foreach ($segments as $segment) {
		if (!empty($segment)) {
			$segment = split('=', $segment);
			if (!empty($segment[1])) {
				$segmentTitle = split(';', $segment[1]);
				$finalArray = array($segmentTitle[0] => $segmentTitle[1]);
				if (!empty($finalArray)) {
					array_push($segmentsParams, $finalArray);
				}
			}
		}
	}
	
	return $segmentsParams;
}

?>





