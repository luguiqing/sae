<?php
header("Content-Type:application/json;charset=utf-8");
$staff = array(
		array("id"=>"44","power"=>"100%","connect"=>false,"address"=>"广东省深圳市南山区白石路深圳大学a广东省深圳市南山区白石路深圳大学a"),
		array("id"=>"55","power"=>"90%","connect"=>false,"address"=>"广东省深圳市南山区白石路深圳大学深圳大学b广东省深圳市南山区白石路深圳大学深圳大学b"),
		array("id"=>"66","power"=>"10%","connect"=>true,"address"=>"广东省深圳市南山区白石路深圳大学深圳大学c广东省深圳市南山区白石路深圳大学深圳大学c")
	);
if($_SERVER["REQUEST_METHOD"]=="GET"){
	search();
}else if($_SERVER["REQUEST_METHOD"]=="POST"){
	create();
}
function search(){
	if(empty($_GET["id"])){
		echo '{"address":"参数错误！"}';
		return;
	}
	global $staff;
	$id=$_GET["id"];
	$result='{"address":"没有找到！"}';
	foreach ($staff as $value) {
		if($value["id"]==$id){
			$result='{"power":"'.$value["power"].'","connect":"'.$value["connect"].'","address":"'.$value["address"].'"}';
			break;
		}
	}
 	echo $result;
}
function create(){
	echo "ss：".$_POST["id"]."保存成功";
}
?>