<?php


	function openDB() {
		include ('database.php');
		if ($fp = fsockopen($host, $port, $errno, $errstr, 5000)) {
			fclose($fp);
		
			if ($conn = mysql_connect($host, $user, $pwd)) {
				return $conn;
			} else {
				echo 'MYSQL CONN ERROR: ' . mysql_error();
				return false;
			}
		
		} else {
			echo 'CONNECTION ERROR: ' . $errno . ': ' . $errstr . '<br/>';
			return false;
		}

		
	}
	
	function getAllData($tablename){
		include ('database.php');
		$conn = openDB();
		
		if (!$conn) {
			echo 'open db fail';
		} else {
			mysql_select_db($db, $conn);
			$query = "SELECT * FROM $tablename";
			$result = mysql_query($query);
			
			$returnData = array();
			
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				array_push($returnData, $row);
			}
			
			closeDB($conn);
			return $returnData;
		}
		
	}
	
	
	class Response {
		public $survey_id;
		public $userid;
		public $question_id;
		public $rel_question_id;
		public $question_type;
		public $response;
	}
	
	
	
function recordResponseNew($responseJson) {
	$survey_id = $responseJson -> survey_id;
	$user_id = $responseJson -> user_id;
	//echo $user_id;

	//Array of Questions
	$responseArray = $responseJson -> result;
	$responseObjArray = array();

	foreach ($responseArray as $response) {
		$responseObj = new Response;
		$responseObj -> survey_id = $survey_id;
		$responseObj -> userid = $user_id;
		$responseObj -> question_id = $response -> question_id;
		$responseObj -> question_type = $response -> question_type;
		$responseObj -> rel_question_id = $response -> related_question_id;
		$responseObj -> response = $response -> response;
		array_push($responseObjArray, $responseObj);
	}

	$result = insertResponse($survey_id, $user_id, $responseObjArray);
	return $result;
}
	
/* Record Response */
function insertResponse($surveyId, $userId, $responseArray) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
		$sql = "INSERT INTO survey_response (response_id, question_id, rel_question_id, question_type, response, survey_id, user_id, timestamp) VALUES ";
		
		for ($i = 0; $i < count($responseArray); $i++) {
			$question_id = $responseArray[$i] -> question_id;
			$rel_question_id = $responseArray[$i] -> rel_question_id;
			$userid = $responseArray[$i] -> userid;
			$qType = $responseArray[$i] -> question_type;
			$survey_id = $responseArray[$i] -> survey_id;
			$response = $responseArray[$i] -> response;
			if ($i < (count($responseArray) - 1)) {
				$sql .= "(DEFAULT, $question_id, $rel_question_id, '$qType', '$response', $survey_id, '$userid', NOW()), ";
			} else {
				$sql .= "(DEFAULT, $question_id, $rel_question_id, '$qType', '$response', $survey_id, '$userid', NOW()) ";
			}
		}

		//echo $sql;
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'error' => mysql_error());
		} else {
			$status = array('code' => mysql_affected_rows(), 'data' => 'OK');
		}

		closeDB($conn);
		return $status;
	}
}
	
	function getTables(){
		include ('database.php');
		$conn = openDB();
		if (!$conn) {
			echo 'open db fail';
		} else {
			mysql_select_db($db, $conn);
			$query = "SHOW TABLES";
			$result = mysql_query($query);
			$returnData = array();
			while ($row = mysql_fetch_array($result)) {
				array_push($returnData, $row[0]);
			}
			closeDB($conn);
			
			$status = array('count' => count($returnData), 'data' => $returnData);
			return $status;
		}
	}
	
	
	function exportToCSV($tableName) {
		include ('database.php');
		$conn = openDB();
		if (!$conn) {
			echo 'open db fail';
		} else {
			mysql_select_db($db, $conn);
			$query = "SELECT * FROM $tableName";
			$result = mysql_query($query);
	
			//$filename = $tableName . "_" . microtime();
			$csvString = "";
	
			//$fp = fopen($filename, "w");
	
			$res = mysql_query("SELECT * FROM $tableName");
	
			// fetch a row and write the column names out to the file
			$row = mysql_fetch_assoc($res);
			$line = "";
			$comma = "";
			foreach ($row as $name => $value) {
				$line .= $comma . '"' . str_replace('"', '""', $name) . '"';
				$comma = ",";
			}
			$line .= "\n";
			$csvString .= $line;
			//fputs($fp, $line);
	
			// remove the result pointer back to the start
			mysql_data_seek($res, 0);
	
			// and loop through the actual data
			while ($row = mysql_fetch_assoc($res)) {
				$line = "";
				$comma = "";
				foreach ($row as $value) {
					$line .= $comma . '"' . str_replace('"', '""', $value) . '"';
					$comma = ",";
				}
				$line .= "\n";
	
				//String CSV file: Can be used for direct downloading the file instead of saving it on the server
				$csvString .= $line;
				//fputs($fp, $line);
			}
	
			//fclose($fp);
	
			closeDB($conn);
			return $csvString;
		}
	}
	
	
	
function insertIntoContinousData($userid, $light, $temp, $gps) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
		$hashUserId = hashString($userid);

		$timestamp = time();
		$sql = "INSERT INTO continous_data " . "(timestamp,userid, light, temparature, gps) " . "VALUES($timestamp,'$hashUserId',$light, $temp, '$gps')";
		//echo "$sql";

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		} else {
			$status = array('code' => mysql_affected_rows($conn), 'message' => 'success');
		}

		closeDB($conn);
		return $status;
	}
}

function insertIntoProximityData($userid, $timestamp, $x, $y, $z, $light, $proximity, $wifi, $wifistrength, $traffic, $battery, $memorysize) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
		//$hashUserId = hashString($userid);

		//$timestamp = time();
		$sql = "INSERT INTO proximity_data " . "(user_name, time, x, y, z, light, proximity, wifi, wifistrength, traffic, battery, memorysize) " . "VALUES('$userid', '$timestamp', $x, $y, $z, $light, $proximity, '$wifi', $wifistrength, $traffic, $battery, $memorysize)";
		//echo "$sql";

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		} else {
			$status = array('code' => mysql_affected_rows($conn), 'message' => 'success');
		}

		closeDB($conn);
		return $status;
	}
}


function insertIntoContexualData($userid, $light, $temp) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
		$hashUserId = hashString($userid);
		$timestamp = time();
		$sql = "INSERT INTO contextual_data " . "(timestamp,userid, light, temparature) " . "VALUES($timestamp,'$userid',$light,$temp)";
		//echo "$sql";

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		} else {
			$status = array('code' => mysql_affected_rows($conn), 'message' => 'success');
		}

		closeDB($conn);
		return $status;
	}
}


function insertUserInfo($username, $password, $firstname, $lastname, $age, $gender, $email) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
		$userId = hashString($email);

		$fullname = $firstname . " " . $lastname;
		$sql = "INSERT INTO user_info " . "(userid, username, password, age, gender, email, status, fullname) " . "VALUES('$userId','$username', '$password', $age, '$gender', '$email','A', '$fullname')";

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		} else {
			$status = array('code' => mysql_affected_rows($conn), 'message' => 'success');
		}

		closeDB($conn);
		return $status;
	}

}

function insertSurveyPushSet($name, $emailId, $frequency, $light, $temperature) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {

		$sql = "DELETE FROM survey_push_set WHERE email_id = '$emailId'";
		
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);
		
		$sql = "INSERT INTO survey_push_set " . "(survey_id, email_id, survey_freq, ligth_thre, temp_thre) " . "VALUES('$name','$emailId','$frequency',$light,'$temperature')";
		
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		}

		closeDB($conn);
		return $status;
	}
}

function validateSignUpKey($key) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
		mysql_select_db($db);

		$sql = "SELECT email FROM signupkeys WHERE status = 1 AND userid = '$key'";
		$retval = mysql_query($sql, $conn);

		$row = mysql_fetch_assoc($retval);
		if ($row) {
			$email = $row['email'];
			mysql_free_result($row);

			$sql = "UPDATE signupkeys SET status = 0 AND userid = '$key'";

			$retval = mysql_query($sql, $conn);

			if (mysql_affected_rows($conn) <= 0) {
				$status = array('code' => -1, 'message' => mysql_error());
			} else {
				$valid = TRUE;
				$status = array('code' => $valid, 'message' => 'valid', 'email' => $email);
			}
		}
		closeDB($conn);
		return $status;
	}

}


/* Sending Signup Email */
function getSignupKey($emailId) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
		$hashTimestamp = hashString($emailId);

		$sql = "INSERT INTO signupkeys " . "(id,email,userid,status) " . "VALUES('', '$emailId','$hashTimestamp',1)";
		//echo "$sql";

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		} else {
			$status = array('code' => mysql_affected_rows($conn), 'message' => $hashTimestamp);
		}
		
		
		closeDB($conn);
		return $status;
	}
}

/* Sending Signup Email */
function updateUserId($emailId) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
		$user_id = hashString($emailId);

		$sql = "UPDATE group_user SET user_id = '$user_id' WHERE email_id = '$emailId'";
		//echo "$sql";

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		} else {
			$status = array('code' => mysql_affected_rows($conn), 'message' => $user_id);
		}
		
		
		closeDB($conn);
		return $status;
	}
}

/* Sending Signup Email */
function getPushKey($emailId) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
	        
                $sql = "DELETE FROM push_survey WHERE email_id = '$emailId'";
		
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);
                
		$sql = "INSERT INTO push_survey " . "(email_id,survey_id) " . "VALUES('$emailId',0)";
		//echo "$sql";

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		} else {
			$status = array('code' => mysql_affected_rows($conn), 'message' => $emailId);
		}
		
		
		closeDB($conn);
		return $status;
	}
}

function getSurveyListForUser($userid) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {

		$sql = "SELECT A.survey_id, A.geodata " . "FROM survey_master A, survey_user B " . "WHERE A.survey_id = B.survey_id AND B.userid = '$userid'";
		//echo "$sql";

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		$resultArray = array();
		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		} else {
			while ($row = mysql_fetch_assoc($retval)) {
				array_push($resultArray, $row);
			}
			$status = array('code' => mysql_affected_rows($conn), 'data' => $resultArray);
		}

		closeDB($conn);
		return $status;
	}
}


function insertNewSurvey($name, $title, $location, $category, $desc, $segmentParams) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {

		$sql = "INSERT INTO survey_master " . "(survey_id, survey_name, survey_title, description, category_id, geodata) " . "VALUES(DEFAULT, '$name','$title','$desc',$category,'$location')";
		//echo "$sql";

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		} else {
			$survey_id = mysql_insert_id();
			$status = insertSegments($survey_id, $segmentParams);
			if ($status['code'] > 0) {
				$status = array('code' => mysql_affected_rows($conn), 'message' => 'New Survey Created');
			} else {
				$status = array('code' => -1, 'message' => $status['message']);
			}

			assignSurveyUsers($survey_id);
		}

		closeDB($conn);
		return $status;
	}
}


function insertNewPushSurvey($user_id, $name) {
	include ('database.php');
	$status = array();
	$conn = openDB();
	
	if (!$conn) {
		echo 'open db fail';
	} else {

		$sql = "UPDATE push_survey SET survey_id = '$name' WHERE email_id = '$user_id'";
		//"UPDATE signupkeys SET status = 0 AND userid = '$key'"
		echo $sql;
		
		//echo "$sql";
		//UPDATE `push_survey` SET `user_id`='day' WHERE `survey_name`= 'usc'

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		} else {
			
		}

		closeDB($conn);
		return $status;
	}
}

function resetPushSurvey($email) {
	include ('database.php');
	$status = array();
	$conn = openDB();
	
	if (!$conn) {
		echo 'open db fail';
	} else {

	$sql = "UPDATE push_survey SET survey_id = 0 WHERE email_id = '$email'";
	//"UPDATE signupkeys SET status = 0 AND userid = '$key'"
	
	//echo "$sql";
	//UPDATE `push_survey` SET `user_id`='day' WHERE `survey_name`= 'usc'

	mysql_select_db($db);
	$retval = mysql_query($sql, $conn);

	if (!$retval) {
		$status = array('code' => -1, 'message' => mysql_error());
	} else {
		
	}

	closeDB($conn);
	return $status;
}
}

//print_r(assignSurveyUsers(2));
function getAllUsers($conn){
	include ('database.php');
	$status = array();

	if (!$conn) {
		echo 'open db fail';
	} else {
		$sql = "SELECT DISTINCT userid FROM signupkeys WHERE status = 1";
		//echo "$sql";
		$result = array();
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);
		if ($retval) {
			while($row = mysql_fetch_assoc($retval)){
				array_push($result, $row['userid']);
			}
			$status = array('code' => count($result), 'data' => $result, 'message' => 'success');
		} else {
			$status = array('code' => -1, 'message' => mysql_error());
		}

		return $status;
	}
}



function assignSurveyUsers($survey_id) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
		$sql = "INSERT INTO survey_user (survey_id, userid) VALUES ";
		
		$userArray = getAllUsers($conn);
		$userArray = $userArray['data'];
		
		for ($i = 0; $i < count($userArray); $i++) {
			if ($i < (count($userArray) - 1)) {
				$sql .= "($survey_id, '$userArray[$i]'), ";
			} else {
				$sql .= "($survey_id, '$userArray[$i]') ";
			}
		}
		
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		} else {
			$status = array('code' => mysql_affected_rows($conn), 'message' => 'Users Associated');
		}

		closeDB($conn);
		return $status;
	}

}

function insertSegments($survey_id, $segmentParams) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
		$sql = "INSERT INTO survey_segments (segment_id, survey_id, segment_title, segment_desc) VALUES ";
		$keyArray = array();
		$valueArray = array();
		foreach ($segmentParams as $param) {
			array_push($keyArray, key($param));
			array_push($valueArray, $param[key($param)]);
		}

		for ($i = 0; $i < count($keyArray); $i++) {
			if ($i < (count($keyArray) - 1)) {
				$sql .= "(DEFAULT, $survey_id,'$keyArray[$i]', '$valueArray[$i]'), ";
			} else {
				$sql .= "(DEFAULT, $survey_id,'$keyArray[$i]', '$valueArray[$i]') ";
			}
		}
	
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		} else {
			$status = array('code' => mysql_affected_rows($conn), 'message' => 'New Survey Created');
		}

		closeDB($conn);
		return $status;
	}
}

function getSegments($survey_id) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
		$sql = "SELECT segment_id, segment_title FROM survey_segments WHERE survey_id = $survey_id";
		//echo "$sql";
		$result = array();
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);
		if ($retval) {
			while ($row = mysql_fetch_assoc($retval)) {
				array_push($result, $row);
			}
			$status = array('code' => count($result), 'data' => $result, 'message' => 'success');
		} else {
			$status = array('code' => -1, 'message' => mysql_error());
		}

		closeDB($conn);
		return $status;
	}
}

/* Get SPecific Survey Details */
function getSurveyDetails($survey_id) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
		$sql = "SELECT * FROM survey_master WHERE survey_id = $survey_id AND status = 'ACTIVE'";
		//echo "$sql";
		$result = array();
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);
		if ($retval) {
			$row = mysql_fetch_assoc($retval);
			$status = array('code' => count($row), 'data' => $row, 'message' => 'success');
		} else {
			$status = array('code' => -1, 'message' => mysql_error());
		}

		closeDB($conn);
		return $status;
	}
}



/* Retrieve All Active Surveys */
function retrieveActiveSurveys() {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {

		$sql = "SELECT * FROM survey_master WHERE status = 'ACTIVE'";
		//echo "$sql";
		$result = array();
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);
		if ($retval) {
			while ($row = mysql_fetch_assoc($retval)) {
				array_push($result, $row);
			}
			$status = array('code' => count($result), 'data' => $result, 'message' => 'success');
		} else {
			$status = array('code' => -1, 'message' => mysql_error());
		}

		closeDB($conn);
		return $status;
	}
}

/* Retrieve All Active Surveys */
function retrieveUsers() {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {

		$sql = "SELECT email FROM signupkeys WHERE status = '1'";
		//echo "$sql";
		$result = array();
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);
		if ($retval) {
			while ($row = mysql_fetch_assoc($retval)) {
				array_push($result, $row);
			}
			$status = array('code' => count($result), 'data' => $result, 'message' => 'success');
		} else {
			$status = array('code' => -1, 'message' => mysql_error());
		}

		closeDB($conn);
		return $status;
	}
}

/* Retrieve All Active Surveys */
function retrieveLightData($userid) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {

		$sql = "SELECT light FROM contextual_data WHERE userid = '$userid'";
		//echo "$sql";
		$result = array();
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);
		if ($retval) {
			while ($row = mysql_fetch_assoc($retval)) {
				array_push($result, $row);
			}
			$status = array('code' => count($result), 'data' => $result, 'message' => 'success');
		} else {
			$status = array('code' => -1, 'message' => mysql_error());
		}

		closeDB($conn);
		return $status;
	}
}


/* Get Questions for Specific Survey */
function getQuestionsForSurvey($survey_id) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
		$sql = "SELECT * FROM survey_questions WHERE survey_id = $survey_id";
		//echo "$sql";
		$result = array();
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);
		if ($retval) {
			while ($row = mysql_fetch_assoc($retval)) {
				array_push($result, $row);
			}
			$status = array('code' => count($result), 'data' => $result, 'message' => 'success');
		} else {
			$status = array('code' => -1, 'message' => mysql_error());
		}

		closeDB($conn);
		return $status;
	}
}

/* Get Questions for Specific Survey */
function getRelQuestionsForSurvey($survey_id) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
		$sql = "SELECT * FROM survey_rel_questions WHERE survey_id = $survey_id";
		//echo "$sql";
		$result = array();
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);
		if ($retval) {
			while ($row = mysql_fetch_assoc($retval)) {
				array_push($result, $row);
			}
			$status = array('code' => count($result), 'data' => $result, 'message' => 'success');
		} else {
			$status = array('code' => -1, 'message' => mysql_error());
		}

		closeDB($conn);
		return $status;
	}
}

function getOptionsForQuestion($question_id, $survey_id) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
		$sql = "SELECT * FROM survey_questions_options WHERE question_id = $question_id AND survey_id = $survey_id";
		//echo "$sql";
		$result = array();
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);
		if ($retval) {
			while ($row = mysql_fetch_assoc($retval)) {
				array_push($result, $row);
			}
			$status = array('code' => count($result), 'data' => $result, 'message' => 'success');
		} else {
			$status = array('code' => -1, 'message' => mysql_error());
		}

		closeDB($conn);
		return $status;
	}

}


function getOptionsForRelQuestion($rel_question_id, $survey_id) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
		$sql = "SELECT * FROM survey_rel_questions_options WHERE rel_question_id = $rel_question_id AND survey_id = $survey_id";
		//echo "$sql";
		$result = array();
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);
		if ($retval) {
			while ($row = mysql_fetch_assoc($retval)) {
				array_push($result, $row);
			}
			$status = array('code' => count($result), 'data' => $result, 'message' => 'success');
		} else {
			$status = array('code' => -1, 'message' => mysql_error());
		}

		closeDB($conn);
		return $status;
	}

}



/* Add Question */
function insertNewQuestion($survey_id, $text, $type, $options, $rText, $rType, $rOptions, $segment, $threshold) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {

		$sql = "INSERT INTO survey_questions " . "(question_id, survey_id, question_text, question_type, segment_id) " . "VALUES(DEFAULT, $survey_id,'$text', '$type', $segment)";

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => 'ERROR 1: ' . mysql_error());
		} else {
			if (mysql_insert_id() > 0) {
				$questionId = mysql_insert_id();
				$status = array('code' => mysql_affected_rows($conn), 'message' => 'QUESTION ADDED | ');
				if ($options != null) {
					$optionsInserted = insertOptionsQuestion($survey_id, $questionId, $type, $options);
					if ($optionsInserted['code'] > 0) {
						$status['message'] .= "OPTIONS ADDED | ";
					} else {
						$status = array('code' => -1, 'message' => 'ERROR 3: ' . $optionsInserted['msg']);
					}
				}

				if ($rText != null) {
					//Insert Related Question
                                        if ($threshold == null) {
						$threshold = 1;
					}
					$relQuestionId = insertRelatedQuestion($survey_id, $questionId, $rText, $rType, $threshold);
					if ($relQuestionId > 0) {
						//Insert Related Question Options
						$status['message'] .= "RELATED QUESTION ADDED | ";
					} else {
						$status = array('code' => -1, 'message' => 'ERROR 2: ' . mysql_error());
					}
                                        if ($rOptions!= null) {
					        $insertRelOptions = insertRelOptionsQuestion($survey_id, $relQuestionId, $rType, $rOptions);
					        if ($insertRelOptions > 0) {
						         $status['message'] .= "RELATED QUESTION OPTIONS ADDED";
					        } else {
						         $status = array('code' => -1, 'message' => 'ERROR 2: ' . mysql_error());
					        }
                                        }
				}

			} else {
				$status = array('code' => -1, 'message' => 'ERROR 4: ' . mysql_error());
			}
		}

		closeDB($conn);
		return $status;
	}
}

function insertOptionsQuestion($survey_id, $questionId, $type, $options) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
		$insertRows = -1;
	} else {
		$insertRows = array();
		$sql = "INSERT INTO survey_questions_options " . "(option_question_id, question_id, survey_id, option_type, option_text) VALUES ";

		for ($i = 0; $i < count($options); $i++) {
			if ($i < (count($options) - 1)) {
				$sql .= "(DEFAULT, $questionId, $survey_id,'$type', '$options[$i]'), ";
			} else {
				$sql .= "(DEFAULT, $questionId, $survey_id,'$type', '$options[$i]') ";
			}
		}

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$insertRows = array('code' => -1, 'msg' => mysql_error());
		} else {
			$insertRows = array('code' => mysql_affected_rows($conn), 'msg' => 'success');
		}

		closeDB($conn);
		//echo "INSERTROWS: ". $insertRows;
		return $insertRows;
	}
}


function insertRelatedQuestion($survey_id, $question_id, $text, $type, $threshold) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
		$insertRows = -1;
	} else {

		$insertRows = -1;
		$sql = "INSERT INTO survey_rel_questions " . "(rel_question_id, question_id, survey_id, question_type, question_text, threshold) VALUES " . "(DEFAULT, $question_id, $survey_id, '$type', '$text', '$threshold')";

		echo "<br>" . $sql . "<br>";
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$insertRows = -1;
			echo mysql_error();
		} else {
			$insertRows = mysql_insert_id();
		}

		closeDB($conn);
		//echo "INSERTROWS: ". $insertRows;
		return $insertRows;
	}
}

//print_r(insertOptionsQuestion(1, 1, 'c', array('abc', 'def', 'ghi')));

function insertRelOptionsQuestion($survey_id, $questionId, $type, $options) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
		$insertRows = -1;
	} else {

		$insertRows = 0;
		$sql = "INSERT INTO survey_rel_questions_options " . "(option_question_id, rel_question_id, survey_id, option_type, option_text) VALUES ";

		for ($i = 0; $i < count($options); $i++) {
			if ($i < (count($options) - 1)) {
				$sql .= "(DEFAULT, $questionId, $survey_id,'$type', '$options[$i]'), ";
			} else {
				$sql .= "(DEFAULT, $questionId, $survey_id,'$type', '$options[$i]') ";
			}
		}

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$insertRows = -1;
		} else {
			$insertRows = mysql_affected_rows($conn);
		}

		closeDB($conn);
		//echo "INSERTROWS: ". $insertRows;
		return $insertRows;
	}

}

/* Api Used Methods */
function getUserData($emailId) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
		$userid = hashString($emailId);

		$sql = "SELECT * FROM user_info WHERE userid = '$userid'";

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		$row = mysql_fetch_assoc($retval);
		if (!$retval) {
			$status = array('code' => -1, 'error' => mysql_error());
		} else {
			$status = array('code' => mysql_affected_rows($conn), 'data' => $row);
		}

		closeDB($conn);
		return $status;
	}
}

/* Api Used Methods */
function getPushNotification($email) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
		
		$sql = "SELECT survey_id FROM push_survey WHERE email_id = '$email'";

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		$row = mysql_fetch_assoc($retval);
		if (!$retval) {
			$status = array('code' => -1, 'error' => mysql_error());
		} else {
			$status = array('code' => mysql_affected_rows($conn), 'data' => $row);
		}

		closeDB($conn);
		return $status;
	}
}

function getPushSetting($email) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {
		$result = array();
		$sql = "SELECT * FROM survey_push_set WHERE email_id = '$email'";

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if ($retval) {
			while ($row = mysql_fetch_assoc($retval)) {
				array_push($result, $row);
			}
			$status = array('code' => count($result), 'data' => $result, 'message' => 'success');
		} else {
			$status = array('code' => -1, 'message' => mysql_error());
		}
		
		
		closeDB($conn);
		return $status;
	}
}

//print_r(getFullSurvey(1));

function getFullSurvey($survey_id) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	$resultArray = array();

	if (!$conn) {
		echo 'open db fail';
	} else {

		$sql = "SELECT * FROM survey_segments WHERE survey_id = $survey_id";

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		$myRow = array();
		if (!$retval) {
			$status = array('code' => -1, 'error' => mysql_error());
		} else {
			while ($row = mysql_fetch_assoc($retval)) {
				$questions = getSurveyQuestions($survey_id, $row['segment_id']);
				$myRow = array('segment' => $row, 'segment_questions' => $questions['data']);
				//$myRow = array('question' => $row, 'options' => $options['data']);
				array_push($resultArray, $myRow);
			}
			$status = array('code' => count($myRow), 'data' => $resultArray);
		}

		closeDB($conn);
		return $status;
	}

}

function getSurveyQuestions($survey_id, $segment_id) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	$resultArray = array();

	if (!$conn) {
		echo 'open db fail';
	} else {

		$sql = "SELECT * FROM survey_questions WHERE survey_id = $survey_id AND segment_id = $segment_id";

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		$myRow = array();
		if (!$retval) {
			$status = array('code' => -1, 'error' => mysql_error());
		} else {
			while ($row = mysql_fetch_assoc($retval)) {
				$options = getOptionsQuestion($survey_id, $row['question_id']);
				$relQuestion = getRelatedQuestion($survey_id, $row['question_id']);
				$myRow = array('question' => $row, 'options' => $options['data'], 'related' => array('relQuestion' => $relQuestion['data']));
				//$myRow = array('question' => $row, 'options' => $options['data']);
				array_push($resultArray, $myRow);
			}
			$status = array('code' => count($myRow), 'data' => $resultArray);
			//$status = array('data' => $resultArray);
		}

		closeDB($conn);
		return $status;
	}
}

function getSurveySegments($survey_id) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	$resultArray = array();

	if (!$conn) {
		echo 'open db fail';
	} else {

		$sql = "SELECT * FROM survey_segments WHERE survey_id = $survey_id";

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		$code = mysql_affected_rows($conn);
		$myRow = array();
		if (!$retval) {
			$status = array('code' => -1, 'error' => mysql_error());
		} else {
			while ($row = mysql_fetch_assoc($retval)) {
				array_push($resultArray, $row);
			}
			$status = array('code' => count($resultArray), 'data' => $resultArray);
			//$status = array('data' => $resultArray);
		}

		closeDB($conn);
		return $status;
	}
}

function getOptionsQuestion($survey_id, $questionId) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	$resultArray = array();

	if (!$conn) {
		echo 'open db fail';
	} else {

		$sql = "SELECT * FROM survey_questions_options WHERE survey_id = $survey_id AND question_id = $questionId";

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'error' => mysql_error());
		} else {
			while ($row = mysql_fetch_assoc($retval)) {
				array_push($resultArray, $row);
			}
			$status = array('code' => count($resultArray), 'data' => $resultArray);
			//$status = array('data' => $resultArray);
		}

		closeDB($conn);
		return $status;
	}
}

function getRelatedQuestion($survey_id, $questionId) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	$resultArray = array();

	if (!$conn) {
		echo 'open db fail';
	} else {

		$sql = "SELECT * FROM survey_rel_questions WHERE survey_id = $survey_id AND question_id = $questionId";

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'error' => mysql_error());
		} else {
			$myRow = array();
			WHILE ($row = mysql_fetch_assoc($retval)) {
				$relOptions = getRelatedOptionsForQuestion($survey_id, $row['rel_question_id']);
				$myRow = array('question' => $row, 'options' => $relOptions);
				array_push($resultArray, $myRow);
			}
			$status = array('code' => count($resultArray), 'data' => $resultArray);
			//$status = array('data' => $resultArray);
		}

		closeDB($conn);
		return $status;
	}

}

function getRelatedOptionsForQuestion($survey_id, $questionId) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	$resultArray = array();

	if (!$conn) {
		echo 'open db fail';
	} else {

		$sql = "SELECT * FROM survey_rel_questions_options WHERE survey_id = $survey_id AND rel_question_id = $questionId";

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'error' => mysql_error());
		} else {
			WHILE ($row = mysql_fetch_assoc($retval)) {
				array_push($resultArray, $row);
			}
			$status = array('code' => count($resultArray), 'data' => $resultArray);
			//$status = array('data' => $resultArray);
		}

		closeDB($conn);
		return $status;
	}
}

/* Utility Methods */
function send_simple_message($userEmailId, $msgBody) {
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_USERPWD, 'api:key-3c50b00bh5dkuhi8tyb-7jndbca7ubh8');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v2/ee579finalappsaketkus.mailgun.org/messages');
	echo "$userEmailId,<br> $msgBody";
	curl_setopt($ch, CURLOPT_POSTFIELDS, array('from' => 'Admin <me@ee579finalappsaketkus.mailgun.org>', 'to' => urldecode($userEmailId), 'subject' => 'Welcome: USC Survey', 'html' => $msgBody));

	$result = curl_exec($ch);
	curl_close($ch);

	return $result;
}

//print_r(getLocation('1226 W Adams Blvd Los Angeles California'));
function getLocation($address) {
	$google_base_url = 'http://maps.googleapis.com/maps/api/geocode/json?sensor=true';
	$google_request_url = $google_base_url . '&address=' . urlencode($address);

	//Load JSON
	$geocode = getDataForUrl($google_request_url);
	$myJson = json_decode($geocode);

	$jsonResult = $myJson -> results[0];
	$status = $myJson -> status;

	$resultArray = array();
	if ($status == 'OK') {
		$lat = $jsonResult -> geometry -> location -> lat;
		$long = $jsonResult -> geometry -> location -> lng;
		$resultArray = array('status' => 'OK', 'lat' => $lat, 'lng' => $long);
	} else {
		$resultArray = array('status' => $myJson -> status);
	}

	return $resultArray;
}

/* gets the data from a URL */
function getDataForUrl($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}


function insertGroupName($group_name) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {

		$sql = "DELETE FROM survey_group WHERE group_name = '$group_name'";
		
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);
		
		$sql = "INSERT INTO survey_group " . "(group_name) " . "VALUES('$group_name')";
		
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		}

		closeDB($conn);
		return $status;
	}
}

function insertGroupUser($group_name, $email_id, $user_id) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {

		$sql = "DELETE FROM group_user WHERE email_id = '$email_id'";
		
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);
		
		$sql = "INSERT INTO group_user " . "(group_name, email_id, user_id) " . "VALUES('$group_name', '$email_id', '$user_id')";
		
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		}

		closeDB($conn);
		return $status;
	}
}

/* Retrieve All Groups */
function retrieveGroups() {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {

		$sql = "SELECT * FROM survey_group";
		//echo "$sql";
		$result = array();
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);
		if ($retval) {
			while ($row = mysql_fetch_assoc($retval)) {
				array_push($result, $row);
			}
			$status = array('code' => count($result), 'data' => $result, 'message' => 'success');
		} else {
			$status = array('code' => -1, 'message' => mysql_error());
		}

		closeDB($conn);
		return $status;
	}
}

/* Retrieve All Groups */
function retrieveUnregisteredEmail($group_name) {
	include ('database.php');
	$status = array();
	$conn = openDB();

	if (!$conn) {
		echo 'open db fail';
	} else {

		$sql = "SELECT email_id FROM group_user WHERE group_name = '$group_name' AND user_id = '0'";
		//echo "$sql";
		$result = array();
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);
		if ($retval) {
			while ($row = mysql_fetch_assoc($retval)) {
				array_push($result, $row);
			}
			$status = array('code' => count($result), 'data' => $result, 'message' => 'success');
		} else {
			$status = array('code' => -1, 'message' => mysql_error());
		}
		
		closeDB($conn);
		return $status;
	}
}

function deleteExistingSurvey($delete_survey_id) {
	include ('database.php');
	$status = array();
	$conn = openDB();
	
	if (!$conn) {
		echo 'open db fail';
	} else {
	
		$sql = "DELETE FROM survey_master WHERE survey_id = '$delete_survey_id'";
		//$sql = "DELETE FROM contextual_data";
		echo $sql;
		
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		} else {
			
		}

		closeDB($conn);
		return $status;
	}
}

function deleteSurveyUser($delete_survey_id) {
	include ('database.php');
	$status = array();
	$conn = openDB();
	
	if (!$conn) {
		echo 'open db fail';
	} else {
	
		$sql = "DELETE FROM survey_user WHERE survey_id = '$delete_survey_id'";
		//$sql = "DELETE FROM contextual_data";
		echo $sql;
		
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		} else {
			
		}

		closeDB($conn);
		return $status;
	}
}

function deleteSurveyRelQuestions($delete_survey_id) {
	include ('database.php');
	$status = array();
	$conn = openDB();
	
	if (!$conn) {
		echo 'open db fail';
	} else {
	
		$sql = "DELETE FROM survey_rel_questions WHERE survey_id = '$delete_survey_id'";
		//$sql = "DELETE FROM contextual_data";
		echo $sql;
		
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		} else {
			
		}

		closeDB($conn);
		return $status;
	}
}

function deleteSurveyRelOptions($delete_survey_id) {
	include ('database.php');
	$status = array();
	$conn = openDB();
	
	if (!$conn) {
		echo 'open db fail';
	} else {
	
		$sql = "DELETE FROM survey_rel_questions_opt WHERE survey_id = '$delete_survey_id'";
		//$sql = "DELETE FROM contextual_data";
		echo $sql;
		
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		} else {
			
		}

		closeDB($conn);
		return $status;
	}
}

function deleteSurveySegments($delete_survey_id) {
	include ('database.php');
	$status = array();
	$conn = openDB();
	
	if (!$conn) {
		echo 'open db fail';
	} else {
	
		$sql = "DELETE FROM survey_segments WHERE survey_id = '$delete_survey_id'";
		//$sql = "DELETE FROM contextual_data";
		echo $sql;
		
		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		} else {
			
		}

		closeDB($conn);
		return $status;
	}
}

function deleteExistingQuestions($name) {
	include ('database.php');
	$status = array();
	$conn = openDB();
	
	if (!$conn) {
		echo 'open db fail';
	} else {
	
		$sql = "DELETE FROM survey_questions WHERE survey_id = '$name'";
		//"UPDATE signupkeys SET status = 0 AND userid = '$key'"
		echo $sql;
		
		//echo "$sql";
		//UPDATE `push_survey` SET `user_id`='day' WHERE `survey_name`= 'usc'

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		} else {
			
		}

		closeDB($conn);
		return $status;
	}
}


function deleteExistingOptions($name) {
	include ('database.php');
	$status = array();
	$conn = openDB();
	
	if (!$conn) {
		echo 'open db fail';
	} else {
	
		$sql = "DELETE FROM survey_questions_options WHERE survey_id = '$name'";
		//"UPDATE signupkeys SET status = 0 AND userid = '$key'"
		echo $sql;
		
		//echo "$sql";
		//UPDATE `push_survey` SET `user_id`='day' WHERE `survey_name`= 'usc'

		mysql_select_db($db);
		$retval = mysql_query($sql, $conn);

		if (!$retval) {
			$status = array('code' => -1, 'message' => mysql_error());
		} else {
			
		}

		closeDB($conn);
		return $status;
	}
}

function hashString($string) {
	return hash('md5', $string);
}
	
function closeDB($conn) {
	mysql_close($conn);
}

	
	


?>