<?
	header('Location: login/login.php');
?>

<html>
	<head>
		<meta charset="utf-8">
		<title>EE579Final_Project</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Le styles -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">

	</head>
	<body>
		<header class="well well-large">
			<h1>EE579Final_Project</h1>
		</header>
		
		<div id="content" class="container">
			<ul>
				<li class="item">
					<a href="login/login.php" class="btn-block">Login</a>
					
					<form id="form1" name="form1" method="post" action="push/index.php">
						<tr>
	    					<td width="75"><input type="submit" name="submit" value="submit"></td>
	  					</tr>
					</form>
				</li>
			</ul>
		</div>
		
		
		
		<footer class="navbar navbar-fixed-bottom">
			<div class="container">
				<p class="well well-small">
					EE579Final Project By: Tiantian Feng, Zhongxiang Ye &amp; Xuejiao Wang
				</p>
			</div>
		</footer>

		<!-- Placed at the end of the document so the pages load faster -->
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
	</body>
</html>