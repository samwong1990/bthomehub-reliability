<?php
/*	Test if wifi is working by fetching a tiny html ("it works!")	*/
	
$db = new PDO('sqlite:'.dirname(__FILE__) . '/wifi.db') or die("Can't open sqlitedb");
$insertion = $db->prepare("INSERT INTO log (working) VALUES (?)");
try{
	$get = file_get_contents("http://ichackathon.com/itworks.html");
	var_dump($get);
	if(trim($get) == 'itworks'){
		echo "it works!";
		$insertion->execute(array(1));
	}else{
		echo "Wooah, failed";
		$insertion->execute(array(0));
	}
}catch(Exception $e){
	// Just in case...
	echo "Wooah, failed";
	$insertion->execute(array(0));
}



?>