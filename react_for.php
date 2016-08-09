<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">  
	<title>循环遍历</title>
	<script src="js/react-0.14.7/build/react.js"></script>
	<script src="js/react-0.14.7/build/react-dom.js"></script>
	<script src="js/jquery-1.12.4.min.js"></script>
	<script src="js/browser.min.js"></script> 
</head>
<body>
	
</body>
<script type="text/babel">
	var For = React.createClass({
		getInitialState:function(){
			return {arr:[1,2,3,4,5,6]}
		},
		render:function(){
			var arrs = this.state.arr;
			return(
				<div>
					<ul>
					{
						arrs.map(function(arr){
							return <li>{arr}</li>
						})
					}</ul>
				</div>
			)
		}

	});
	ReactDOM.render(<For/>,document.body);
</script>
</html>