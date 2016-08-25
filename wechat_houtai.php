<?php
header("Content-Type:application/json;charset=utf-8");
$staff = array(
		array("direction"=>1,"voiceUrl"=>"img/1.mp3","type"=>"voice","created_at"=>"2016-01-01 00:20:00","status"=>"已读"),
		array("direction"=>1,"voiceUrl"=>"img/1.mp3","type"=>"voice","created_at"=>"2016-01-01 00:00:00"),
		array("direction"=>2,"stringText"=>"语音调试","voiceUrl"=>"img/1.mp3","type"=>"","created_at"=>"2016-01-01 00:00:00"),
		array("direction"=>1,"voiceUrl"=>"img/1.mp3","type"=>"voice","created_at"=>"2016-01-01 00:03:00"),
		array("direction"=>1,"voiceUrl"=>"img/1.mp3","type"=>"voice","created_at"=>"2016-01-01 00:00:00"),
		array("direction"=>2,"voiceUrl"=>"img/1.mp3","type"=>"voice","created_at"=>"2016-01-01 10:00:00"),
		array("direction"=>1,"voiceUrl"=>"img/1.mp3","type"=>"voice","created_at"=>"2016-01-01 00:00:00"),
		array("direction"=>1,"voiceUrl"=>"img/1.mp3","type"=>"voice","created_at"=>"2016-01-01 00:00:00","created_at"=>"2016-01-01 00:00:00"),
		array("direction"=>1,"voiceUrl"=>"img/1.mp3","type"=>"voice","created_at"=>"2016-01-01 00:00:00"),
		array("direction"=>2,"stringText"=>"只有direction为2才有文本","voiceUrl"=>"img/1.mp3","type"=>"","created_at"=>"2016-01-01 00:00:00"),
		array("direction"=>1,"voiceUrl"=>"img/1.mp3","type"=>"voice","created_at"=>"2016-01-01 00:00:00"),
		array("direction"=>1,"voiceUrl"=>"img/1.mp3","type"=>"voice","created_at"=>"2016-01-01 00:00:00"),
		array("direction"=>2,"voiceUrl"=>"img/1.mp3","type"=>"voice","created_at"=>"2016-01-03 00:00:00"),
		array("direction"=>1,"voiceUrl"=>"img/1.mp3","type"=>"voice","created_at"=>"2016-01-01 00:00:00"),
		array("direction"=>1,"voiceUrl"=>"img/1.mp3","type"=>"voice","created_at"=>"2016-01-01 00:00:00"),
		array("direction"=>1,"voiceUrl"=>"img/1.mp3","type"=>"voice","created_at"=>"2016-01-02 00:00:00")
	);
/*flag为1为手机自己的，如果为音频链接用voiceUrl,如果文字为stringText*/
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