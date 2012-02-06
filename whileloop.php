<?php
/*	use another file to call the wifiCheck, so I can update the main script anytime	*/
	
while(1){
	echo `php wifiCheck.php`;
	echo "\nNow sleep for 30sec...";
	sleep(30);
}


?>