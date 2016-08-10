<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wxaa27c81689998e5b", "616ebfe0b8ef324b56dbc8b36c0e383c");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <script src="js/react-0.14.7/build/react.js"></script>
    <script src="js/react-0.14.7/build/react-dom.js"></script>
    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/browser.min.js"></script>
    <title>微聊</title>
</head>
<style>
    *{margin: 0px;padding: 0px}
    @font-face {font-family: 'iconfont';
      src: url('iconfont_1/iconfont.eot'); /* IE9*/
      src: url('iconfont_1/iconfont.eot?#iefix') format('embedded-opentype'), 
      url('iconfont_1/iconfont.woff') format('woff'), 
      url('iconfont_1/iconfont.ttf') format('truetype'),
      url('iconfont_1/iconfont.svg#iconfont') format('svg'); 
    }
    .iconfont{
      font-family:"iconfont" !important;
      font-size:16px;font-style:normal;
      -webkit-font-smoothing: antialiased;
      -webkit-text-stroke-width: 0.2px;
      -moz-osx-font-smoothing: grayscale;
    }
    audio{opacity: 0.2;width: 10px;}

    .wechat .right{float:right;width: 50%;position: relative;height: 40px;margin:5px;background-color: gray}
    .wechat .left{float: left;width: 50%;position: relative;height: 40px;margin: 5px;background-color: gray}
    .wechat img{display: inline-block;width: auto;height: 40px;}

    .wechat .right .right_child{position: absolute;right: 0px ;top:0px;height: 20px;}
    .wechat .left  .left_child{position: absolute;left: 0px;top:0px;height: 20px;}

    .text_message{position: fixed;bottom: 0px;left: 0px;height: 50px;border: 0px;width: 100%;}
    .voice_message{position: fixed;bottom: 0px;left: 0px;height: 50px;border: 0px;width: 100%;display: none;}
    button{height: 50px;border:0px;display: inline-block;width: 15%}
    input{height: 50px;border: 0px;display: inline-block;width: 70%;}
</style>
<body>
    <div id="container">
        
    </div>
</body>
<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/babel">
    var WeChat = React.createClass({
        getInitialState:function(){
            return {voiceArr:[],flags:[]}
        },
        getMsg:function(){
            var _self = this;
            $.ajax({
                type:"GET",
                url:"wechat_houtai.php",
                dataType:"json",
                success:function(data){
                    var voiceUrl =[];
                    var flag=[];
                   /* _self.setState({voiceArr:data});*/
                    for(var i=0;i<data.length;i++){
                        voiceUrl[i]=data[i].voiceUrl;
                        flag[i]=data[i].flag;
                    }
                    _self.setState({voiceArr:voiceUrl,flags:flag});          
                },
                error:function(xhr,status,err){
                    console.log(err);
                    console.log(status);
                }
                
            })
        },
        componentDidMount:function(){
            /*this.interval = setInterval(this.getMsg,5000);*/
            this.getMsg();
        },
        componentWillUnmount:function(){
            clearInterval(this.getMsg);
        },
        voiceboxtouch:function(e){
            /*alert($('.right').css("height"));
            this.refs.uu.getDOMNode().play();*/
            /*var myVideo=document.getElementById("1");
            myVideo.play();*/
            $(".wechat>div").on('click',function(){
                var index = $(this).index();
                var mychoosevoide=document.getElementById(index);
                if(mychoosevoide.paused){
                    mychoosevoide.play();
                }else{
                    mychoosevoide.pause();
                }
            });
                   
        },
        textToggleChange:function(){
            $(".text_message").css({display:'none'});
            $(".voice_message").css({display:'block'});
        },
        voiceToggleChange:function(){
            $(".voice_message").css({display:'none'});
            $(".text_message").css({display:'block'});
        },
        handleSubmit:function(){
            alert("发送成功");
        },
        render:function(){
            var voiceArr = this.state.voiceArr;
            var flags = this.state.flags;
            var _self=this;
           return(
                <div className="wechat">
                    {

                       voiceArr.map(function(voice,index){
                            return  flags[index]==='1'?(<div className="right"  ref={"voice"+index} onTouchStart={_self.voiceboxtouch}>
                                                            <div className="right_child" alt="头像">
                                                                <i className="iconfont" style={{color:"red"}}>&#xe65d;</i><img src="img/1.jpg" style={{marginLeft:"10px;"}}/>
                                                            </div>
                                                            <audio controls="controls" ref={index} id={index}>
                                                                <source src={voice} type="audio/mpeg" />
                                                            </audio></div>):(<div className="left" ref={"voice"+index} onTouchStart={_self.voiceboxtouch}>
                                                                                <div className="left_child" alt="头像">
                                                                                    <img src="img/1.jpg" style={{marginRight:"10px;"}}/><i className="iconfont" style={{color:"green"}}>&#xe63d;</i>
                                                                                </div>
                                                                                <audio controls="controls" ref={index} id={index}>
                                                                                    <source src={voice} type="audio/mpeg" />
                                                                                </audio></div>)

                           })

                    }
                    <div className="text_message">
                        <form onSubmit={this.handleSubmit}>
                            <button onClick={_self.textToggleChange} type="button"><i className="iconfont" style={{color:"yellow"}}>&#xe65d;</i></button>
                            <input onChange={this.onChange}/>
                            <button type="button">发送文字</button>
                        </form>
                    </div>
                    <div className="voice_message">
                        <form onSubmit={this.handleSubmit}>
                            <button onClick={_self.voiceToggleChange} type="button">切换</button>
                            <input onChange={this.onChange}/>
                            <button type="button">发送语音</button>
                        </form>
                    </div>
                </div>
           ) 
        }
    });
   /* React.initializeTouchEvents(true);*///初始化接触事件
    ReactDOM.render(<WeChat/>,document.getElementById("container"));
</script>
<script>
  $(document).ready(function(){
    wx.config({
      debug: true,
      appId: '<?php echo $signPackage["appId"];?>',
      timestamp: <?php echo $signPackage["timestamp"];?>,
      nonceStr: '<?php echo $signPackage["nonceStr"];?>',
      signature: '<?php echo $signPackage["signature"];?>',
      jsApiList: [
        // 所有要调用的 API 都要加到这个列表中
        "onMenuShareTimeline",
        "openLocation",
        "getLocation",
        "chooseImage",
        "previewImage",
        "uploadImage",
        "startRecord",
        "stopRecord",
        "onVoiceRecordEnd",
        "playVoice",
        "pauseVoice",
        "stopVoice",
      ]
    });
    
    wx.ready(function () {
        $(".wechat>div").on('click',function(){
            var index = $(this).index();
            var mychoosevoide=document.getElementById(index);
            if(mychoosevoide.paused){
                mychoosevoide.play();
            }else{
                mychoosevoide.pause();
            }
        });
        $("img").click(function(){
            alert('dd');
        })

    });
  });
</script>
</html>