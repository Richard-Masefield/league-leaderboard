<!DOCTYPE html>
<html lang="en">
 	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">

		<title>League Leaderboard</title>

		<!-- Bootstrap core CSS -->
		<link href="/assets/css/bootstrap.min.css" rel="stylesheet">

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="/assets/css/cover.css" rel="stylesheet">

		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]
		<script src="/assets/js/ie-emulation-modes-warning.js"></script>-->

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
 	</head>
	<body>
	<div class="site-wrapper">
	  <div class="site-wrapper-inner">
		<div class="cover-container">
		  <div class="inner cover">
			<h1 class="cover-heading">League Leaderboard</h1>
			<hr>
			<table class="table table-inverse table-responsive text-left">
			  <thead>
				<tr>
					<th>Position</th>
					<th>Name</th>
					<th>Played</th>
					<th>Won</th>
					<th>Drawn</th>
					<th>Lost</th>
					<th>Points</th>
				</tr>
			  </thead>
			  <tbody>
			  <?php 
			  		$position = 1;
			   	foreach( $leaderboard as $team ){
			  ?>
				<tr>
					<th scope="row"><?php echo $position; ?></th>
					<td><?php echo $team->name; ?></td>
					<td><?php echo isset($team->matches_played) ? $team->matches_played : 0 ; ?></td>
					<td><?php echo isset($team->matches_won) ? $team->matches_won : 0 ; ?></td>
					<td><?php echo isset($team->matches_drawn) ? $team->matches_drawn : 0 ; ?></td>
					<td><?php echo $team->matches_lost; ?></td>
					<td><?php echo $team->total_points; ?></td>
				</tr>
			  <?php
			  		$position++; 
			    }
			  ?>
			  </tbody>
			</table>			
		  </div>
		  <div class="mastfoot">
			<div class="inner">
			  <p>League Results Table, by <a href="mailto:ramasefield@gmail.com">@ricmas</a>.</p>
			</div>
		  </div>
		</div>
	  </div>
	</div>

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster >
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="/assets/js/vendor/jquery.min.js"><\/script>')</script>
	<script src="/assets/js/bootstrap.min.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug 
	<script src="/assets/js/ie10-viewport-bug-workaround.js"></script>-->
  </body>
</html>
