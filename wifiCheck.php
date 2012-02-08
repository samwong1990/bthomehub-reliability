<?php
/*	Test if wifi is working by fetching a tiny html ("it works!")	*/
	
date_default_timezone_set('UTC');
$db = new PDO('sqlite:/Users/samwong/Sites/bthomehub-reliability/wifi.db') or die("Can't open sqlitedb");



echo "Current time is " . date("c");
if(	isConnected()	){
	die("it works!\n");
}




// If it doesn't work... eg Exception, string mismatch, whatever reason... consider it as not working
file_put_contents("/Users/samwong/Sites/bthomehub-reliability/" . date("c"), "downed!");	//physical log!
$insertion = $db->prepare("INSERT INTO log (start, end, duration) VALUES (?,?,?)");
$start = time();
do{
	echo "Not connected, sleep for 60 sec. Current time is " . date("c") . "\n";
	sleep(60);
}while(	!isConnected()	);
//Finally! We are back on line
$end = time();
$insertion->execute(array($start, $end, $end-$start));
echo "downtime recorded\n";

//Update DDNS in case it was changed
file_put_contents(date("c"), file_get_contents("https://dynamicdns.park-your-domain.com/update?host=mywifi&domain=samwong.hk&password=827f0abf8f074447974cf247ff83b1f0")); 
die("All done\n");






function isConnected(){
	$get = file_get_contents("http://ichackathon.com/itworks.php");
	var_dump($get);
	if(trim($get) == 'itworks'){
		return true;
	}
	return false;
}
?>