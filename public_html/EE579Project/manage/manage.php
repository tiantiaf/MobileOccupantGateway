<!DOCTYPE HTML>

<html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Survey Management Console</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="Tiantian Feng">

		<!-- Le styles -->
		<link href="../css/bootstrap.css" rel="stylesheet"/>
		<link href="../css/bootstrap-responsive.css" rel="stylesheet"/>
		<link href="../css/bootstrap-select.min.css" rel="stylesheet"/>
		<link href="../css/styles.css" rel="stylesheet"/>

	</head>
	<body>
		<nav>
			<div class="navbar navbar-fixed-top">
				<div class="navbar-inner">
					<a class="brand" href="#">Survey</a>
					<ul class="nav">
						<li>
							<a href="recruite.php">Recruit</a>
						</li>
						
						<li class="active">
							<a href="manage.php">Manage Survey</a>
						</li>
						
						<li>
							<a href="data.php">Data</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container-fluid well" id="content">
			<div class="row-fluid">
				<!-- Content Area Starts -->
				<div class="span12">
					<div class="row well">
						<!-- TABBED INTERFACE -->
						<div class="tabbable">
							<!-- Only required for left/right tabs -->
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#survey-new" data-toggle="tab">New Survey</a>
								</li>
       
                                                                <li>
									<a href="#survey-questions" data-toggle="tab" id="survey-questions-tab">Add Questions</a>
								</li>

                                                                <li>
									<a href="#survey-push-set" data-toggle="tab" id="survey-push-set-tab">Push Set</a>
								</li>
								
								<li>
									<a href="#survey-push" data-toggle="tab" id="survey-push-tab">Push Surveys</a>
								</li>
								
								<li>
									<a href="#survey-manage" data-toggle="tab" id="survey-manage-tab">Manage Surveys</a>
								</li>

                                                                <li>
									<a href="#survey-default" data-toggle="tab" id="survey-default-tab">Set Default Surveys</a>
								</li>

                                                                

							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="survey-new">
									<form class="well span12" method="post" action="add_survey.php">
										<div class="row">
											<div class="span4">
												<label>Survey Name</label>
												<input type="text" class="span12" placeholder="Survey Name" required="" name="survey_name">
												<label>Survey Title</label>
												<input type="text" class="span12" placeholder="Survey Title" required="" name="survey_title">
												<div class="input-append" id="geo_coord">
													<label>Targeted Location</label>
													<input type="text" class="span12" placeholder="Enter Geo-Coordinates" name="survey_geo" id="survey_geo">
													<span class="add-on"><a class="icon-map-marker" href="#locModal" role="button" data-toggle="modal"></a></span>
												</div>
												<label>Target Audience</label>
												<select id="subject" datasize="3" class="selectpicker span12" name="survey_category" required="required">
													<?php
													//Generating Categories Dynamically
													include ('../db/dbhelper.php');
													$categories = getAllData("survey_group");
													if ($categories) {
														foreach ($categories as $category) {
															echo '<option value="' . $category['group_name'] . '">' . $category['group_name'] . '</option>';
															//echo '<p id="' . $category['category_id'] . '">' . $category['category_text'] . '</p>';
														}
													} else {
														echo "<option>ERROR</option>";
													}
													?>
												</select>
												<center>
													<a href="#customModal" role="button" class="btn btn-primary" data-toggle="modal" id="addSegment">Add Segments</a>
												</center>
												<input type="hidden" name="segments" id="segments" value="" />
												<!--</div>-->
											</div>
											<div class="span8">
												<label>Survey Description</label>
												<textarea name="survey_descr" id="survey_descr" class="input-xlarge span12" rows="10"></textarea>
											</div>
											<button type="submit" class="btn btn-primary pull-right">
												Create
											</button>
										</div>
									</form>
								</div>

								<div class="tab-pane" id="survey-manage">
									<div class="well">
										<ul class="thumbnails" id="survey_list">
											<!-- Load Data from manage.js -->
											<div align="center" class="progress progress-striped active" id="loadingBar">
												<div class="bar" style="width: 40%;"></div>
											</div>
										</ul>
									</div>
								</div>
								
								<div class="tab-pane" id="survey-push">
									<form class="span12 well" method="post" action="add_push_survey.php">
										<div class="row">
											<div class="span4 well">
												<h4 align="center" class="text-center text-info">Push Survey</h4>
												
												<label>Group Type</label>
												<select id="q_push_id" class="selectpicker span12" name="q_push_id" datasize="5" required="required">
												<!-- Load Data from manage.js -->
												</select>
												
												<label>User Email</label>

                                                                                                <select id="q_push_survey_user" class="selectpicker span12" name="q_push_survey_user" datasize="20" required="required">
												<!-- Load Data from manage.js -->
												</select>

                                                                                                <label>Survey Type</label>
												<select id="q_push_survey" class="selectpicker span12" name="q_push_survey" datasize="5" required="required">
												<!-- Load Data from manage.js -->
												</select>
												
												
												
											</div>

                                                                                        <div class="span4 well">
												<h4 align="center" class="text-center text-info">Push Survey Type</h4>
	
												<select id="q_push_type" class="selectpicker span12" name="q_push_type" required="required">
													<optgroup label="Type">
														<option value="1">Ring</option>
														<option value="2">Vibrate</option>
														<option value="3">Screen On</option>
														
													</optgroup>
												</select>

                                                                                                <select id="q_push_duration" class="selectpicker span12" name="q_push_duration" required="required">
													<optgroup label="Duration">
														<option value="1">1s</option>
														<option value="2">5s</option>
														<option value="3">15s</option>
														<option value="4">30s</option>
														
													</optgroup>
												</select>

                                                                                                <center>
													<button type="submit" class="btn btn-primary pull-right">Push</button>
												</center>
												
												<input type="hidden" name="segments" id="segments" value="" />
												
											</div>
                                                                
										</div>
									</form>
								</div>

                                                                <div class="tab-pane" id="survey-push-set">
									<form class="well span12" method="post" action="add_survey_push_set.php">
										<div class="row">
											<div class="span4">
												<label>Temperature Threshold</label>
												<input type="text" class="span12" placeholder="Temperature" required="" name="temp_threshold">
												
												<label>Light Threshold</label>
												<input type="text" class="span12" placeholder="Light" required="" name="light_threshold">
												
												<label>Survey Frequency</label>
												<select id="q_survey_frequency" class="selectpicker span12" name="q_survey_frequency" required="required">
													<option value="na">--Frequency--</option>
													<optgroup label="Type">
														<option value="1">30 Minutes</option>
														<option value="2">1 Hour</option>
														<option value="3">1 Hour 30 Minutes</option>
														<option value="4">2 Hour</option>
														<option value="5">3 Hour</option>
													</optgroup>
												</select>
												
												<label>Push Survey Type</label>
												<select id="q_push_set_survey" class="selectpicker span12" name="q_push_set_survey" datasize="5" required="required">
													<!-- Load Data from manage.js -->
												</select>
												
												
												<input type="hidden" name="segments" id="segments" value="" />
												<center>
													<button type="submit" class="btn btn-primary pull-right span3">       Set       </button>
												</center>
												<!--</div>-->
											</div>
											
											<div class="span8">
												
												<label>Group Type</label>
												<select id="q_push_set_id" class="selectpicker span6" name="q_push_set_id" datasize="5" required="required">
													<!-- Load Data from manage.js -->
												</select>
												
											</div>
											
										</div>
									</form>
								</div>

                                                                <div class="tab-pane" id="survey-default">
									<form class="well span12" method="post" action="set_default_survey.php">
										<div class="row">
											<div class="span4">
												<h4 align="center" class="text-center text-info">Set Default Survey</h4>
												
												<label>Group Type</label>
												<select id="default_group_id" class="selectpicker span12" name="default_group_id" datasize="5" required="required">
												<!-- Load Data from manage.js -->
												</select>
												
												<label>User Email</label>

                                                                                                <select id="default_user_email" class="selectpicker span12" name="default_user_email" datasize="20" required="required">
												<!-- Load Data from manage.js -->
												</select>

                                                                                                <label>Survey Type</label>
												<select id="default_survey_id" class="selectpicker span12" name="default_survey_id" datasize="5" required="required">
												<!-- Load Data from manage.js -->
												</select>

												<input type="hidden" name="segments" id="segments" value="" />
												<center>
													<button type="submit" class="btn btn-primary pull-right span3">       Set       </button>
												</center>
												<!--</div>-->
											</div>
											
										</div>
									</form>
								</div>
								
                                                                <div class="tab-pane" id="survey-delete">
									<form class="span12 well" method="post" action="delete_survey.php">
										<div class="row">
											<div class="span4 well">
												<h4 align="center" class="text-center text-info">Delete Surveys</h4>
												<label>Survey Name</label>
												<select id="q_delete_survey" class="selectpicker span12" name="q_delete_survey" datasize="5" required="required">
													<!-- Load Data from manage.js -->
												</select>
												
												<center>
													<button type="submit" class="btn btn-primary pull-right">Delete</button>
													
												</center>
												
												<input type="hidden" name="segments" id="segments" value="" />
												
											</div>
										</div>
									</form>
								</div>

								<div class="tab-pane" id="survey-questions">
									<form class="span12 well" method="post" action="add_question.php">
										<div class="row">
											<div class="span4 well">
												<h4 align="center" class="text-center text-info">Main Question</h4>
												<label>Survey</label>
												<select id="q_survey" class="selectpicker span12" name="q_survey" datasize="5" required="required">
													<!-- Load Data from manage.js -->
												</select>

												<label>Question Type</label>
												<select id="q_type" class="selectpicker span12" name="q_type" required="required">
													<option value="na">--Type--</option>
													<optgroup label="Type">
														<option value="s">Single Checkbox</option>
                                                                                                                <option value="m">Multiple Checkbox</option>
														<option value="l">Likert</option>
                                                                                                                <option value="l5">Likert5</option>
                                                                                                                <option value="b5">Button5</option>
														<option value="t">Text</option>
													</optgroup>
												</select>

												<label>Segments</label>
												<select id="q_segment" class="selectpicker span12" name="q_segment" required="required">
													<!-- Load from JS -->
												</select>

                                                                                                <label>Threshold</label>

												<input name="qr_threshold" id="qr_threshold" class="span12" type="number" placeholder="Branching Option"/>
											       
												<label>Main Question</label>
												<input name="q_text" id="q_text" class="span12" type="text" placeholder="Question Text"/>

												<div id="q_options" align="right" class="span12">
													<!-- Load Options from manage.js -->
													<input name="opt1" id="opt1" type="text" placeholder="Option 1" class="span12"/>
													<input name="opt2" id="opt2" placeholder="Option 2" type="text" class="span12"/>
													<input name="opt3" id="opt3" placeholder="Option 3" type="text" class="span12"/>
													<input name="opt4" id="opt4" placeholder="Option 4" type="text" class="span12"/>
                                                                                                        <input name="opt5" id="opt5" placeholder="Option 5" type="text" class="span12"/>
												</div>
											</div>
											<div class="span8 well">
												<h4 align="center" class="text-center text-info">Branching Question</h4>
												<div class="span12">
													<div class="span6">
														<input name="qr_text" id="qr_text" class="span12" type="text" placeholder="Question Text"/>
													</div>
                                                                                                        
													<div class="span3">
														<select id="qr_type" class="selectpicker span12" name="qr_type">
															<option value="na">--Type--</option>
															<optgroup label="Type">
																<option value="rs">Single Checkbox</option>
                                                                                                                                <option value="rm">Multiple Checkbox</option>
																<option value="rl">Likert</option>
																<option value="rt">Text</option>
															</optgroup>
														</select>
													</div>
												</div>
       
                                                                                               

												<div id="qr_options" align="right" class="span6">
													<!-- Load Options from manage.js -->
													<input name="r_opt1" id="r_opt1" type="text" placeholder="Option 1" class="span12"/>
													<input name="r_opt2" id="r_opt2" placeholder="Option 2" type="text" class="span12"/>
													<input name="r_opt3" id="r_opt3" placeholder="Option 3" type="text" class="span12"/>
													<input name="r_opt4" id="r_opt4" placeholder="Option 4" type="text" class="span12"/>
												</div>
											</div>
											<center>
												<button type="submit" class="btn btn-primary">
													Add Question
												</button>
                                                                                                <h6 align="center" class="text-center text-info" ><br></h6>

                                                                                                <h5 align="center" class="text-center text-info" >
                                                                                                        <font color="red">
                                                                                                             Note: Main Quetion must be filled in, including setting a Threshold
                                                                                                        </font>
                                                                                                </h5>
												
											</center>
										</div>
									</form>
								</div>

								<div class="tab-pane" id="survey-stats">
									<div class="well">
										<div class="row">
											<div class="span12" style="padding: 20px;">
                                                                                                <label><h4 class="text-info">Email ID</h4></label>
												<select id="q_contextual_user" class="selectpicker span4" name="q_contextual_user" datasize="5" required="required">
													<!-- Load Data from manage.js -->
												</select>
												<ul class="thumbnails" id="">
													<li class="span4">
														<div class="thumbnail">
															<img src="../img/blue-temperature-icon.png" alt="ALT NAME" height="200" width="320">
															<div class="caption">
																<h3>Temparature Stats</h3>
																<img />
																<p align="center">
																	<a class="btn btn-primary btn-block" href="#customModal" role="button" data-toggle="modal" id="tempStat">Open</a>
																</p>
															</div>
														</div>
													</li>

													<li class="span4">
														<div class="thumbnail">
															<img src="../img/light-icon.png" alt="ALT NAME" height="200" width="320">
															<div class="caption">
																<h3>Luminosity Stats</h3>
																<p align="center">
																	<a class="btn btn-primary btn-block" href="#customModal" role="button" data-toggle="modal" id="lightStat">Open</a>
																</p>
															</div>
														</div>
													</li>
													<li class="span4">
														<div class="thumbnail">
															<img src="../img/add.png" alt="ALT NAME"  height="200" width="320">
															<div class="caption">
																<h3>Survey Feedback</h3>
																<p align="center">
																	<a class="btn btn-primary btn-block" href="#customModal" role="button" data-toggle="modal" id="feedbackStat">Open</a>
																</p>
															</div>
														</div>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>

								<div class="tab-pane" id="export-import" style="min-height: 400px;">
									<div class="span12">
										<a href="exportTocsv.php?tablename=survey_master" target="_blank"><img src="http://placehold.it/200x200/0044CC/ffffff&text=Survey+Details" class="img-circle"></a>
										<a href="exportTocsv.php?tablename=survey_segments" target="_blank"><img src="http://placehold.it/200x200/0044CC/ffffff&text=Survey+Segments" class="img-circle"></a>
										<a href="exportTocsv.php?tablename=survey_questions" target="_blank"><img src="http://placehold.it/200x200/0044CC/ffffff&text=Survey Questions" class="img-circle"></a>
										<a href="exportTocsv.php?tablename=survey_questions_options" target="_blank"><img src="http://placehold.it/200x200/0044CC/ffffff&text=Question+Options" class="img-circle"></a><br>
										<a href="exportTocsv.php?tablename=survey_rel_questions" target="_blank"><img src="http://placehold.it/200x200/0044CC/ffffff&text=Rel+Questions" class="img-circle"></a>
										<a href="exportTocsv.php?tablename=survey_rel_questions_options" target="_blank"><img src="http://placehold.it/200x200/0044CC/ffffff&text=Rel+Options" class="img-circle"></a>
										<a href="exportTocsv.php?tablename=survey_response" target="_blank"><img src="http://placehold.it/200x200/0044CC/ffffff&text=Survey+Response" class="img-circle"></a>
										<a href="exportTocsv.php?tablename=survey_user" target="_blank"><img src="http://placehold.it/200x200/0044CC/ffffff&text=User+Info" class="img-circle"></a>
									</div>
								</div>
                                                                  
                                                                <div class="tab-pane" id="export-contextual" style="min-height: 400px;">
									<div class="span12">
										<a href="exportTocsv.php?tablename=contextual_data" target="_blank"><img src="http://placehold.it/200x200/0044CC/ffffff&text=Contexual+Data" class="img-circle"></a>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		

		<!-- Modal -->
		<div id="locModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					¡Á
				</button>
				<h3 id="myModalLabel">Get Co-Ordinates</h3>
			</div>
			<div class="modal-body">
				<div class="brand">
					<h4 align="center">Enter Building Address</h4>
				</div>
				<div id="modal-content">
					<div align="left">
						<input type="text" class="span3"  placeholder="Street" required="" id="bldgStreet">
						<input type="text" class="span1" placeholder="Number" required="" id="bldgNo">
					</div>
					<input type="text" class="span4" placeholder="City" required="" id="bldgCity">
					<input type="text" class="span4" placeholder="State" required="" id="bldgState">
					<input type="text" class="span4" placeholder="Zipcode" required="" id="bldgZip">
				</div>
				<div id="locImage">

				</div>
			</div>
			<div class="modal-footer">
				<div align="center">
					<button class="btn btn-primary" id="geoBtn">
						Get Co-ordinates
					</button>
					<button class="btn" onclick="resetGeoModal();">
						Clear
					</button>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div id="customModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="customModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					x
				</button>
				<h3 id="customModalLabel"><!-- Custom Modal Header --></h3>
			</div>
			<div class="modal-body">
				<div id="customModalContent">
					<!-- Load Custom Content-->
				</div>
			</div>
			<div class="modal-footer">
				<div align="center" id="customFooterButtons">
					<button class="btn" data-dismiss="modal">
						Close
					</button>
				</div>
			</div>
		</div>

		<!-- Placed at the end of the document so the pages load faster -->
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
		<script src="../js/bootstrap-select.min.js"></script>
		<script src="../js/jquery.dataTables.min.js"></script>
		<script src="../js/highcharts/highcharts.js"></script>
		<script src="../js/highcharts/exporting.js"></script>
		<script src="../js/manage.js"></script>
    	<script type="text/javascript" src="jquery.label_over.js"></script>
		<!--<script src="http://www.datatables.net/download/build/jquery.dataTables.min.js"></script>-->

		<script type="text/javascript">
			$(document).ready(function() {
				/*$('#datasheet').dataTable({
				 "bPaginate" : false,
				 "bScrollCollapse" : true,
				 "bFilter" : false,
				 "sDom" : "<'row'<'span8'l><'span8'f>r>t<'row'<'span8'i><'span8'p>>"
				 });*/
				$('#q_options, #qr_options').hide();
				$('#q_type').change(function() {
					if ($(this).val() == 'l' || $(this).val() == 'l5' || $(this).val() == 't' || $(this).val() == 'na') {
						$('#q_options').hide();
					} else {
						$('#q_options').show();
					}
				});

				$('#qr_type').change(function() {
					if ($(this).val() == 'rl' || $(this).val() == 'rt' || $(this).val() == 'na') {
						$('#qr_options').hide();
					} else {
						$('#qr_options').show();
					}
				});

                                $('#survey-stats-tab').click(function() {
					getContexualUser();
				});

				$('#survey-manage-tab').click(function() {
					loadSurveys();
				});

				$('#survey-push-tab').click(function() {
					getGroupAsOptions();
					//getPushSurveyAsOptions();
				});

                                $('#survey-default-tab').click(function() {
					getSetDefaultGroupAsOptions();
				});

                                $('#survey-push-set-tab').click(function() {
					//getSetPushSurveyAsOptions();
					getSetPushGroupAsOptions();
				});

                                $('#survey-delete-tab').click(function() {
					getDeleteSurveyAsOptions();
				});
				
				$('#survey-questions-tab').click(function() {
					getSurveyAsOptions();
				});

				$(document).on('change', '#q_survey', function() {
					var survey_id = $('#q_survey').val();
					getSegmentsAsOptions(survey_id);
				});
				
				$(document).on('change', '#default_group_id', function() {
					var group_id = $('#default_group_id').val();
					getSetDefaultSurveyAsOptions(group_id);
                                        getSetDefaultSurveyUserAsOptions(group_id);
				});

                                $(document).on('change', '#q_push_id', function() {
					var group_id = $('#q_push_id').val();
					getPushSurveyAsOptions(group_id);
                                        getPushSurveyUserAsOptions(group_id);
				});

                                $(document).on('change', '#q_push_set_id', function() {
					var group_id = $('#q_push_set_id').val();
					getSetPushSurveyAsOptions(group_id);
				});

				$('#feedbackStat').click(function() {
					$('#customModalLabel').html("Survey Statistics");
					loadSurveysForStat();
				});

				$(document).on('change', '#customModalContent #f_survey', function() {
					//alert($(this).val());
					if ($(this).val() == '-1') {
						$('#q_choose').html('');
						getAllFeedbackStat();
					} else {
						$('#feedback-stat').html('');
						$('#q_choose').html('<label>Question</label>' + '<select id="f_q_survey" class="selectpicker" datasize="5">' + '<option value="-1">Choose Question</option><option value="1">How was the luminosity of the room?</option>' + '<option value="2">How was the temperature of the room?</option></select>');
					}
				});
				
				
				
				$('#push_survey').click(function() {
					
					var Device_ID = 'dayday/' + $('#Device_ID').val();         		
          			var q_push_survey = $('#q_push_survey').val();
          			
			        alert(2);
			          $.ajax({
						      url: 'send_mqtt.php',
						      type: 'POST',
						      data: {'q_push_survey': q_push_survey, 'Device_ID': Device_ID},
						      dataType: 'text',
						      timeout: 2000,
						      error: function(){				      
			              		$('.loading').slideToggle('fast');
				            	alert('Failed to communicate to the Client. Try again!')                                     
						      },
						      
			          	}); 
					
				});
				
				$(document).on('change', '#customModalContent #criteria #q_choose', function() {
					specificSurveyStat();
				});

				$(document).on('click', '#customFooterButtons #add_segments', function() {
					addSegments();
				});

				$('#tempStat').click(function() {
					$('#customModalLabel').html("Temparature Statistics");
					getWeatherStats();
				});

				$('#addSegment').click(function() {
					$('#customModalLabel').html("Add Segments To Survey");
					generateSegments();
				});

				$('#lightStat').click(function() {
					$('#customModalLabel').html("Luminous Statistics");
					//getWindSpeed();
					var q_contextual_user = $('#q_contextual_user').val();
					getLuminosity(q_contextual_user);
				});



				$('#geoBtn').click(function() {
					var bldgNo = $('#bldgNo').val();
					var bldgStreet = $('#bldgStreet').val();
					var bldgCity = $('#bldgCity').val();
					var bldgState = $('#bldgState').val();
					var bldgZip = $('#bldgZip').val();

					getCoordinates(bldgNo, bldgStreet, bldgCity, bldgState, bldgZip);
				});

				$('.selectpicker').selectpicker();

			});
		</script>

		<script type="text/javascript"><?php
		if (isset($_GET["status"]) && ($_GET["status"] >= 0 || $_GET["status"] < 0)) {
			echo 'statusMessage(\'' . $_GET["msg"] . '\');';
		}
		?>
	function statusMessage(message) {
		alert(message);
	}
		</script>

	</body>
</html>