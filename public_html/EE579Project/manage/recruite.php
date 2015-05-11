<!DOCTYPE HTML>

<html>
	<head>
		<meta charset="utf-8">
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
				<a class="brand" href="#">Recruit</a>
				
				<ul class="nav">
						<li class="active">
							<a href="recruite.php">Recruit</a>
						</li>
						
						<li>
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
									<a href="#user-group-new" data-toggle="tab" id="user-group-new-tab">Add Group</a>
								</li>

                                                                <li>
									<a href="#user-group-delete" data-toggle="tab" id="user-group-delete-tab">Delete Group</a>
								</li>
								
								<li>
									<a href="#user-new" data-toggle="tab" id="user-new-tab">Add User</a>
								</li>
								
								<li>
									<a href="#user-send" data-toggle="tab" id="user-send-tab">Email Recruitment</a>
								</li>
								
								
								
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="user-group-new">
									<form class="span12 well" method="post" action="add_group.php">
										<div class="row">
											<div class="span4 well">
												<h4 align="center" class="text-center text-info">Add Group</h4>
												
												<label>Group Name</label>
												<input type="text" class="span12" placeholder="group name" required="" name="group_id" id="group_id">
												
												<center>
													<button type="submit" class="btn btn-primary pull-right">Add Group</button>
												</center>
												
												<input type="hidden" name="segments" id="segments" value="" />
												
											</div>

                                                                                        
										</div>
									</form>
								</div>

                                                                <div class="tab-pane" id="user-group-delete">
									<form class="well span12" method="post" action="delete_group.php">
										<div class="row">
											<div class="span4">
												<label>Group Name</label>
												<select id="delete_group_type" class="selectpicker span12" name="delete_group_type" required="required">
												<!-- Load Data from recruite.js -->
												</select>
												<button type="submit" class="btn btn-primary pull-right">
													Delete Group
												</button>
												
												<input type="hidden" name="segments" id="segments" value="" />
												<!--</div>-->
											</div>
											
											
										</div>
									</form>
								</div>
								
							
							
								<div class="tab-pane" id="user-send">
									<form class="well span12" method="post" action="send_group_email.php">
										<div class="row">
											<div class="span4">
												<label>Group Type</label>
												<select id="send_group_type" class="selectpicker span12" name="send_group_type" datasize="5" required="required">
													<!-- Load Data from manage.js -->
												</select>
												<button type="submit" class="btn btn-primary pull-right">
													Send Request
												</button>
												
												<input type="hidden" name="segments" id="segments" value="" />
												<!--</div>-->
											</div>
											
											
										</div>
									</form>
								</div>
								
								<div class="tab-pane" id="user-new">
									<form class="span12 well" method="post" action="add_group_user.php">
										<div class="row">
											<div class="span4 well">
												<h4 align="center" class="text-center text-info">Manage User</h4>
												<label>Group Type</label>
												<select id="group_user" class="selectpicker span12" name="group_user" datasize="5" required="required">
													<!-- Load Data from manage.js -->
												</select>
												
												<label>Email</label>
												<textarea name="group_user_email" id="group_user_email" class="input-xlarge span12" rows="10"></textarea>
												
												<center>
													<button type="submit" class="btn btn-primary pull-right">Register</button>
													
												</center>
												
												<input type="hidden" name="segments" id="segments" value="" />
												
											</div>
										</div>
									</form>
								</div>
							
								
								
							</div>
						</div>
					</div>
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
	<script src="../js/recruite2.js"></script>
	<script type="text/javascript" src="jquery.label_over.js"></script>
	<!--<script src="http://www.datatables.net/download/build/jquery.dataTables.min.js"></script>-->

	<script type="text/javascript">
		$(document).ready(function() {
			
			$('#user-send-tab').click(function() {
				getSendGroupAsOptions();
			});
			
			$('#user-new-tab').click(function() {
				getGroupAsOptions();
			});

                        $('#user-group-delete-tab').click(function() {
				getDeleteGroupAsOptions();
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