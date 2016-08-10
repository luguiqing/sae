<?php
header("Content-Type:application/json;charset=utf-8");
$staff = array(
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"1","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"1","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"1","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"1","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3")
	);
$staf = json_encode($staff);
if($_SERVER["REQUEST_METHOD"]=="GET"){
	search();
}else if($_SERVER["REQUEST_METHOD"]=="POST"){
	create();
}
function search(){
	global $staf;
	if(empty($staf)){
		$result='{"address":"没有数据！"}';
	}
	else {
			$result=$staf;
	}
 	echo $result;
}
function create(){
	echo "....";
}
?>