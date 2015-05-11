<!DOCTYPE HTML>

<html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Survey Management Console</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="Saketkumar Srivastav">

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
					<a class="brand" href="#">Data</a>
					<ul class="nav">
						<li>
							<a href="recruite.php">Recruit</a>
						</li>
						<li>
							<a href="manage.php">Manage Survey</a>
						</li>
						<li class="active">
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
									<a href="#survey-stats" data-toggle="tab" id="survey-stats-tab">Statistics</a>
								</li>
								
								<li>
									<a href="#machine-learning" data-toggle="tab" id="machine-learning-tab">Machine Learning</a>
								</li> 
								
								<li>
									<a href="#export-import" data-toggle="tab" id="export-import-tab">Export</a>
								</li>
			

							</ul>
							
							<div class="tab-content">
								
								<div class="tab-pane active" id="survey-stats">
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
										<a href="exportTocsv.php?tablename=contextual_data" target="_blank"><img src="http://placehold.it/200x200/0044CC/ffffff&text=Contexual+Data" class="img-circle"></a>
									</div>
								</div>
                                                                  
                                <div class="tab-pane" id="machine-learning" style="min-height: 400px;">
									<div class="span12">
										
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
					X
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


				$('.selectpicker').selectpicker();

				/*$(document).on('click', '#export-import-tab', function() {
				 generateExportTableList();
				 });*/
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