<!DOCTYPE HTML>

<html>
	<head>
		<meta charset="utf-8">
		<title>Survey Management Console</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<!-- Le styles -->
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/bootstrap-responsive.css" rel="stylesheet">
		<link href="../css/styles.css" rel="stylesheet">
		
	</head>
	
	<body>
		<header class="well well-large">
			<h1 align="center">Survey - Statistics</h1>
		</header>
	</body>
	
	<nav>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<a class="brand" href="#">Survey</a>
				
				<ul class="nav">
						
						<li>
							<a href="manage.php">Manage</a>
						</li>
						<li class="active">
							<a href="statistics.php">Statistics</a>
						</li>
						<li>
							<a href="add_module.php">Add Module</a>
						</li>
					</ul>
				
			</div>
		</div>	
	</nav>
	
	<div id="content" class="container">
			
		<div id="loadgraphs" align="center">
			<img src="http://jpgraph.net/images/howto/combgraphex1.png" />
		</div>
	</div>
	
	<footer class="navbar navbar-fixed-bottom">
		<div class="container">
			<p class="well well-small">
				EE579Final Project By: Tiantian Feng, Zhongxiang Ye &amp; Xuejiao Wang
			</p>
		</div>
	</footer>

	<!-- Placed at the end of the document so the pages load faster -->
	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			//$("#loadgraphs").load("graphs.php");
		});
	</script>
	
</html>