<?php
date_default_timezone_set('Europe/London');
$db = new PDO('sqlite:'.dirname(__FILE__) . '/wifi.db') or die("Can't open sqlitedb");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>BTHomeHub2 wifi Downtime</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Le styles -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<style>
	body {
		padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
	}
	</style>
	<link href="css/bootstrap-responsive.css" rel="stylesheet">

	<!-- Le fav and touch icons -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
</head>

<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="#">BTHomeHub2 wifi Downtime</a>
			<div class="nav-collapse">
				<ul class="nav">
					<li class=""><a href="https://github.com/samwong1990/bthomehub-reliability">Source Code</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
</div>

<div class="container">
	<!-- Example row of columns -->
	<div class="row" style="text-align:center;">
		<div class="span4">
			<h1>Latest Outage</h1>
			<h3>
			<?php
				$results = $db->query("SELECT * FROM log LIMIT 1")->fetchAll(PDO::FETCH_ASSOC);
				echo date("F j, Y, g:i a", intval($results[0]['start']));
			?>
			</h3>
			<p>It lasted for <?php echo round(intval($results[0]['duration'])/60.0);?> mins</p>
		</div>
		<div class="span4">
			<h1>Resets performed</h1>
			<h3>
			<?php
				$results = $db->query("SELECT count(start) AS resets FROM log")->fetchAll(PDO::FETCH_ASSOC);
				echo $results[0]['resets'];
			?>
			</h3>
		</div>
		<div class="span4">
			<h1>Longest outage</h1>
			<h3>
			<?php
				$results = $db->query("SELECT * FROM log ORDER BY duration LIMIT 1")->fetchAll(PDO::FETCH_ASSOC);
				echo $results[0]['duration'];
			?> mins	
			</h3>
			<p>Happened at <?php echo date("F j, Y, g:i a", intval($results[0]['start']));?></p>
		</div>
	</div>
	<!-- Main hero unit for a primary marketing message or call to action -->
	<div class="hero-unit">
		<h1 style="line-height:2em;">Downtime log</h1>
		<p>I used to reboot my BTHomeHub2 once every few days, now I do it few times a day.</p>
		<p>You want me to change the channel, so I did. To make sure I'm doing it right, I did a wifi survey right next to the router. Now I'm sure the router is <ol><li>Not next to the microwave</li><li>The wifi space is not crowded</li><li>No one is ±1 channel with me.</li></ol></p>
		<p>It didn't do much, as you can see below. What else can I do to help you help me?</p>
	</div>

	<section id="typography">
	  <div class="page-header">
	    <h1>List of all outages <small>Since 7 Feb 2012, 02:00.</small></h1>
	  </div>
	  <div class="row">
		<div class="span12">
			<div class="span12" style="text-align:center">
				<h5>In a way, the shorter the duration, the more we are affected.</h5>
				<h5>As someone rushed to reboot the router</h5>
			</div>
			<table class="table table-striped table-bordered">
				<thead>
					<th>Started at</th><th>Ended at</th><th>Duration (mins)</th>
				</thead>
				<tbody>
					<?php
						$results = $db->query("SELECT * FROM log")->fetchAll(PDO::FETCH_ASSOC);
						foreach($results as $result){
							?>
								<tr>
									<td><?php echo date("F j, Y, g:i a", intval($result['start']));?></td>
									<td><?php echo date("F j, Y, g:i a", intval($result['end']));?></td>
									<td><?php echo max(
										array(
											1,
											round(intval($result['duration'])/60.0)
											)
										);?>
									</td>
								</tr>
							<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<hr>

	<footer>
		<p>&copy; Sam Wong 2012</p>
	</footer>

</div> <!-- /container -->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap-transition.js"></script>
<script src="js/bootstrap-alert.js"></script>
<script src="js/bootstrap-modal.js"></script>
<script src="js/bootstrap-dropdown.js"></script>
<script src="js/bootstrap-scrollspy.js"></script>
<script src="js/bootstrap-tab.js"></script>
<script src="js/bootstrap-tooltip.js"></script>
<script src="js/bootstrap-popover.js"></script>
<script src="js/bootstrap-button.js"></script>
<script src="js/bootstrap-collapse.js"></script>
<script src="js/bootstrap-carousel.js"></script>
<script src="js/bootstrap-typeahead.js"></script>

</body>
</html>