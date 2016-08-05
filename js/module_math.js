require.config({
	paths:{
		"trydirpath":"../css/module_trydirpath"
	}
})
define(['trydirpath'],function(trydirpath){
	var add=function(x,y){
		return x+y;
	}
	var ride = function(x,y){
		return x*y;
	}
	function use_trydirpath(x,y,z){
		trydirpath.different(x,y,z);
	}
	return{
		add:add,
		ride:ride,
		use_trydirpath:use_trydirpath
	}
})