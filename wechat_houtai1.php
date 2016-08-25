<?php
header("Content-Type:application/json;charset=utf-8");
$staff = array(
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"1","stringText"=>"语音调试","voiceUrl"=>"0"),
		array("flag"=>"1","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"1","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"1","stringText"=>"只有flag为一才有文本信息","voiceUrl"=>"0"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"1","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"1","voiceUrl"=>"img/1.mp3"),
		array("flag"=>"0","voiceUrl"=>"img/1.mp3")
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