<?php
header("Content-Type:application/json;charset=utf-8");
$staff = array(
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"1","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"1","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
	);
if($_SERVER["REQUEST_METHOD"]=="GET"){
	search();
}else if($_SERVER["REQUEST_METHOD"]=="POST"){
	create();
}
function search(){
	global $staff;
	if(empty($staff)){
		$result='{"address":"没有数据！"}';
	}
	else {
			$result='{"voiceArr":"'.$staff.'"}';
	}
 	echo $result;
}
function create(){
	echo "....";
}
?>