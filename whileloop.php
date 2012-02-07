<?php
/*	use another file to call the wifiCheck, so I can update the main script anytime	*/
date_default_timezone_set('UTC');
	
while(1){
	echo date("c") . "\n";
	file_put_contents("/Users/samwong/Sites/bthomehub-reliability/LatestStatus", `/usr/bin/php /Users/samwong/Sites/bthomehub-reliability/wifiCheck.php`);
	echo "\nNow sleep for 60sec...";
	sleep(60);
}


?>