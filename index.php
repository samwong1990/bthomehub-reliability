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
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-20974018-2']);
	  _gaq.push(['_setDomainName', 'samwong.hk']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
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
				$results = $db->query("SELECT * FROM log ORDER BY start DESC LIMIT 1")->fetchAll(PDO::FETCH_ASSOC);
				echo date("F j, Y, g:i a", intval($results[0]['start']));
				?>
			</h3>
			<p>It lasted for 
				<?php $mins = round(intval($results[0]['duration'])/60.0);
			if($mins < 60){
				$mins = max(array(1, $mins));
				echo "$mins mins";
			}else{
				$hours = round($mins/60);
				echo "$hours hours";
			}
			?> 
		</p>
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
	$results = $db->query("SELECT * FROM log ORDER BY duration DESC LIMIT 1")->fetchAll(PDO::FETCH_ASSOC);
	$mins = round(intval($results[0]['duration'])/60.0);
	if($mins < 60){
		$mins = max(array(1, $mins));
		echo "$mins mins";
	}else{
		$hours = round($mins/60);
		echo "$hours hours";
	}

	?>	
</h3>
<p>Happened at <?php echo date("F j, Y, g:i a", intval($results[0]['start']));?></p>
</div>
</div>
<!-- Main hero unit for a primary marketing message or call to action -->
<div class="hero-unit">
	<h1 style="line-height:2em;">Downtime log</h1>
	<p>I used to reboot my BTHomeHub2 once every few days, now I do it few times <strike>a day</strike> per hour.</p>
	<p>You want me to change the channel, so I did. To make sure I'm doing it right, I did a <a href="#wifisurvey">wifi survey</a> right next to the router. Now I'm sure the router is <ol><li>Not next to the microwave</li><li>The wifi space is not crowded</li><li>No one is ±1 channel with me.</li></ol></p>
	<p>It didn't do much, as you can see below. What else can I do to help you help me?</p>
	<br><br>
	<p>Account no: GB 0875 9921</p>
	<p>Update 9-Feb : Awesome, BTHomehub3 is coming in 3 days to replace my crappy BTHomeHub2 =D.
	<p>Update 11-Feb : No I can't stick with wired connection either. The wired network dies with the wireless network.</p>
	<p>Update 12-Feb : WTH, BT just silently cancelled my BTHomehub3 order. I was so <i>lucky</i> to have complained about the horrible connection today, else I won't know anything about this until tuesday. So now we manage to have 44 pounds outstanding balance when we have direct debit activated. I have to call the billing department at 9am tomorrow. That's so awesome! Let the customer do all the work to sort out your non-sense! FML</p>
	<p>Update 14-Feb : Okay, so BT decided we need to pay earlier than normal in order to fix its faulty equipment. Fine, so we pay our monthly fee earlier because it is faulty. Sounds logical. Now I had the fee paid, guess what they'd say..... we can have the bthomehub3 in another 3 days! WTF! After a lot of struggle, finally found a kind manager who can ship it with next day delivery. Yey!</p>
	<p>Update 15-Feb : Woke up to see a BTHomeHub<b>2.0</b> on the table. FML. Made another contact, they said something in the lines of "Since we have shipped you a working replacement, we can't send you another homehub3 blah blah blah". Ha! Fuck you! I was smart enough to ask multiple people to confirm I will be having a homehub3 during my previous conversations. After saying I have all the chat records, I talked to the supervisor again. Initial Outcome: Make a guess, bthomehub3 in another 3 days! Push-pull-push-pull, they said it will arrive on Friday morning. OK, let's see about that. At least I made sure I can use the new homehub2 for now. To be continued...</p>
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
				<h5>Note: The router can't fix itself.</h5>
				<h5>New hub connected at ~1830 15 Feb</h5>
			</div>
			<table class="table table-striped table-bordered">
				<thead>
					<th>Started at</th><th>Ended at</th><th>Duration</th>
				</thead>
				<tbody>
					<?php
				$results = $db->query("SELECT * FROM log ORDER BY start DESC")->fetchAll(PDO::FETCH_ASSOC);
				foreach($results as $result){
					?>
					<tr>
						<td><?php echo date("F j, Y, g:i a", intval($result['start']));?></td>
						<td><?php echo date("F j, Y, g:i a", intval($result['end']));?></td>
						<td><?php $mins = max(
											array(
												1,
												round(intval($result['duration'])/60.0)
												)
											);
											if($mins < 60){
												echo "$mins mins";
											}else{
												$hours = round($mins/60.0);
												echo "$hours hours";
											}
											
											?>
							</td>
						</tr>
						<?php
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</section>

<section id="wifisurvey">
	<div class="page-header">
		<h1>Wifi survey <small>Right next to the router</small></h1>
	</div>
	<div class="row">
		<div class="span12">
			<img src="img/atRouter.jpg">
		</div>
	</div>
</section>
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
