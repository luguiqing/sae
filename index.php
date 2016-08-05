<!DOCTYPE html> 
<html>     
	<head>        
		<meta charset="UTF-8">        
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">         
		<title>WeUI</title>         
		<script src="js/react-0.14.7/build/react.js"></script>
		<script src="js/react-0.14.7/build/react-dom.js"></script>
		<script src="js/jquery-1.12.4.min.js"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script> 
	</head>
	<style>
		*{margin:0px 0px; padding: 0px 0px;font-family: "微软雅黑"}
		a{text-decoration: none;display: block;color: #fff;}
		a:hover{-webkit-tap-highlight-color:transparent;}
		ul li{list-style: none;}
		@font-face {font-family: 'iconfont';
	      src: url('iconfont/iconfont.eot'); /* IE9*/
	      src: url('iconfont/iconfont.eot?#iefix') format('embedded-opentype'), 
	      url('iconfont/iconfont.woff') format('woff'), 
	      url('iconfont/iconfont.ttf') format('truetype'),
	      url('iconfont/iconfont.svg#iconfont') format('svg'); 
	    }
	    .iconfont{
	      font-family:"iconfont" !important;
	      font-size:16px;font-style:normal;
	      -webkit-font-smoothing: antialiased;
	      -webkit-text-stroke-width: 0.2px;
	      -moz-osx-font-smoothing: grayscale;
	      color: #fff;
	    }
		.ajax_head{width: 100%;min-height: 120px;background-color: #49dfff;padding: 10px 0px;}
		.ajax_head .ajax_head_img{padding: 0px 15px;}
		.ajax_head .ajax_head_img img{width: 50px;border-radius: 50%;height:50px;float: left;margin-bottom: 5px;}
		.ajax_head .ajax_head_img  p{padding-left: 65px;color: #fff;font-size: 21px;}
		.ajax_head p span{color: #D8EC82;}
		.ajax_head .ajax_head_address{padding: 0px 15px;}
		.ajax_head .ajax_head_address p{font-size: 12px;color: #fff;}
		.ajax_head .ajax_head_img .head_p{font-size:12px;}

		.content_container{margin: 0px 10px 55px;height: 350px;}

		.content_container .left .iconfont,.content_container .right .iconfont{display: inline-block;margin-right: 8px;}

		.content_container .left{float: left;width: 55%}
		.content_container .left ul li{margin-top:10px;}
		.content_container .left ul li a{padding: 20px 0px 20px 20px;height: 20px;line-height: 20px; border-radius: 10px;}

		.content_container .right {float: right;width:45%;}
		.content_container .right ul li{margin:10px 0px 0px 10px;}
		.content_container .right ul li a{padding: 20px 0px 20px 20px;height: 20px;line-height: 20px; border-radius: 10px;}
		.content_container .right ul li .aright_1{background-color:#671ED6;text-align:center;padding: 45px 20px;height: 40px;}

		.content_container .all {clear: both;}
		.content_container .all  ul li{float: left;margin-top:10px;width: 32%}
		.content_container .all  ul li a{padding: 20px 0px 20px 10px;height: 20px;line-height: 20px; border-radius: 10px;}

		.footer{width: 100%;height:50px;position: fixed;bottom: 0px;left: 0px;}
		.footer ul li{display: inline-block;width: 50%;text-align: center;float: left;}
		.footer ul li a{color: #49dfff;display:block;font-size: 12px;padding-top: 10px;height: 40px;}
	</style>
	<body  ontouchstart style="background-color:#fff;">
		<div id="homepage"></div>
	</body>
	<script type="text/babel">
		var Homepage = React.createClass({
			getInitialState:function(){
				return {id:"",power:"",connect:false,address:"",errMsg:""}
			},
			componentDidMount:function(){
				var _self = this;
				$.ajax({
					type:"GET",
					url:"weui.php?id="+this.props.id,
					dataType:"json",
					success:function(data){
						_self.setState({id:_self.props.id,power:data.power,connect:data.connect,address:data.address})
						console.log(data);
						console.log(_self.state.address);
						
					},
					error:function(xhr,status,err){
						console.log(err);
						console.log(status);
					}
					
				})
			},
			render:function(){
				var time = new Date();
				var mymonth = time.getMonth()+1,mydate = time.getDate() ,myhour = time.getHours(),myminute = time.getMinutes();
				var time_str = mymonth +"月"+mydate+"日"+myhour+"时"+myminute+"分";
				return (
					<div className="container">
						<div className="ajax_head">
							<div className="ajax_head_img">
								<img src="img/1.jpg" alt="头像"/>
								<p>{this.state.id}</p>
								<p className="head_p">{this.state.connect?"通讯连接":"通讯中断"}<span> ( 电量 {this.state.power} )</span></p>
							</div>
							<div className="ajax_head_address" style={{clear:'both'}}>
								<p>{this.state.address}</p>
								<p>{time_str} <span> 综合定位</span></p>
							</div>
						</div>
						<div className="content_container">
							<div className="left">
								<ul>
									<li><a href="#" style={{backgroundColor:"#324CE6"}}><i className="iconfont">&#xe606;</i>微聊</a></li>
									<li><a href="#" style={{backgroundColor:"#1E39D6"}}><i className="iconfont">&#xe602;</i>健康</a></li>
									<li><a href="#" style={{backgroundColor:"#0C219A"}}><i className="iconfont">&#xe638;</i>足迹</a></li>
									<li><a href="#" style={{backgroundColor:"#09155A"}}><i className="iconfont">&#xe635;</i>安全区域</a></li>
								</ul>	
							</div>
							<div className="right">
								<ul>
									<li><a href="#" className="aright_1"><i className="iconfont">&#xe66d;</i><p>地图</p></a></li>
									<li><a href="#" style={{backgroundColor:"#E68D3D"}}><i className="iconfont">&#xe609;</i>设置</a></li>
									<li><a href="#" style={{backgroundColor:"#E84C6A"}}><i className="iconfont">&#xe63e;</i>爱心奖励</a></li>
								</ul>
							</div>
							<div className="all">
								<ul>
									<li style={{marginRight:"5px"}}><a href="#" style={{backgroundColor:"#34C36D"}}><i className="iconfont">&#xe603;</i>信息中心</a></li>
									<li style={{marginRight:"5px"}}><a href="#" style={{backgroundColor:"#15E267"}}><i className="iconfont">&#xe62c;</i>手表闹钟</a></li>
									<li><a href="#" style={{backgroundColor:"#CAD622"}}><i className="iconfont">&#xe624;</i>找手表</a></li>
								</ul>
							</div>
						</div>
						<div className="footer">
							<ul>
								<li><a href="#" style={{backgroundColor:"#34AAB7"}}><i className="iconfont">&#xe6ba;</i><p>关于我</p></a></li>
								<li><a href="#" style={{backgroundColor:"#54CC76"}}><i className="iconfont">&#xe666;</i><p>主页</p></a></li>
							</ul>
						</div>
					</div>
				)
			}
		});
		ReactDOM.render(<Homepage id="44"/>,document.getElementById('homepage'));
	</script>
</html>