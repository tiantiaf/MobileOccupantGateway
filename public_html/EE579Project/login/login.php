<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Admin Console Sign In</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Le styles -->
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/bootstrap-responsive.css" rel="stylesheet">
		<link href="../css/styles.css" rel="stylesheet">

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="../assets/js/html5shiv.js"></script>
		<![endif]-->
	</head>

	<body>
		<header class="well well-large">
			<h1 align="center">Survey Management Console</h1>
		</header>

		<div class="container">
			<!--<form class="form-signin" method="post" id="loginform" action="#">-->
			<div class="form-signin" id="loginModal">
				<div class="modal-header">
					<h3>Survey Login</h3>
				</div>
				<div class="modal-body">
					<div class="well">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#login" data-toggle="tab">Login</a>
							</li>
						</ul>
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane active in" id="login">
								<form class="form-horizontal" action='controller.php' method="POST">
									<fieldset>
										<div class="control-group">
											<!-- Username -->
											<label class="control-label" for="username">Username</label>
											<div class="controls">
												<input type="text" id="username" name="username" placeholder="" class="input-xlarge" required=""/>
												<span id="unameMsg" class="errmsg"></span>
											</div>
										</div>
										<div class="control-group">
											<!-- Password-->
											<label class="control-label" for="password">Password</label>
											<div class="controls">
												<input type="password" id="password" name="password" placeholder="" class="input-xlarge" required=""/>
												<span id="passMsg" class="errmsg"></span>
											</div>
										</div>
										<div class="control-group">
											<!-- Button -->
											<div class="controls">
												<button class="btn btn-success" type="submit">
													Login
												</button>
											</div>
										</div>
									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /container -->

			<!-- Le javascript
			================================================== -->
			<!-- Placed at the end of the document so the pages load faster -->
			<script src="../js/jquery.js"></script>
			<script src="../js/bootstrap.js"></script>
	</body>
</html>
