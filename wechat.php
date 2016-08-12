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
      font-size:40px;font-style:normal;
      -webkit-font-smoothing: antialiased;
      -webkit-text-stroke-width: 0.2px;
      -moz-osx-font-smoothing: grayscale;
    }
    audio{opacity: 0;width: 10px;}


    .wechat .right{float:right;width: 65%;position: relative;height: 50px;margin:5px;}
    .wechat .left{float: left;width:55%;position: relative;height: 50px;margin: 5px;}
    .wechat img{display: inline-block;width: auto;height: 50px;width: 50px;border-radius: 50%}

    .wechat .right .right_child{position: absolute;right: 0px ;top:0px;height: 50px;}
    .wechat .left  .left_child{position: absolute;left: 0px;top:0px;height: 50px;}

    .text_message{position: fixed;bottom: 0px;left: 0px;height: 50px;border: 0px;width: 100%;}
    .voice_message{position: fixed;bottom: 0px;left: 0px;height: 50px;border: 0px;width: 100%;display: none;}
    button{height: 50px;border:0px;display: inline-block;width: 15%}
    input{height: 50px;border: 0px;display: inline-block;width: 70%;}

    .wechat>div:last-of-type{margin-bottom: 55px!important;}
</style>
<body>
    <div id="container">
        
    </div>
</body>
<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/babel">
    var WeChat = React.createClass({
        getInitialState:function(){
            return {voiceArr:[],flags:[],texts:[],lengths:0}
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
                    var text=[];
                    for(var i=0;i<data.length;i++){
                        if(data[i].flag==="1"){
                            if(data[i].voiceUrl==="0"){
                                text[i]=data[i].stringText;
                            }
                        }
                        voiceUrl[i]=data[i].voiceUrl;
                        flag[i]=data[i].flag;
                    }
                    _self.setState({voiceArr:voiceUrl,flags:flag,texts:text,lengths:data.length});
                    /*$('#'+(_self.state.lengths-1)).parent().css({marginBottom:'55px'});*/
                    console.log(_self.state.texts);        
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
            /*clearInterval(this.getMsg);*/
        },
        textToggleChange:function(){
            $(".text_message").css({display:'none'});
            $(".voice_message").css({display:'block'});
        },
        voiceToggleChange:function(){
            $(".voice_message").css({display:'none'});
            $(".text_message").css({display:'block'});
        },
        handleMsg:function(){
            var voiceArr = this.state.voiceArr;
            var flags = this.state.flags;
            var _self=this;
            return voiceArr.map(function(voice,index){
                if(flags[index]==='1'){
                    if(voice==='0'){
                        return (<div className="right"  key={index}>
                                    <div className="right_child" alt="头像" id={index}>
                                        <span style={{width:'120px',height:'40px',display:'inline-block',textAlign:"right"}}>{_self.state.texts[index]}</span><img src="img/1.jpg" style={{marginLeft:"10px",marginBottom:"-12px"}}/>
                                    </div>
                                </div>)

                    }else{
                        return (<div className="right"  key={index}>
                                    <div className="right_child" alt="头像">
                                        <i className="iconfont" style={{color:"blue"}}>&#xe65d;</i><img src="img/1.jpg" style={{marginLeft:"10px",marginBottom:"-10px"}}/>
                                    </div>
                                    <audio controls="controls" ref={index} id={index}>
                                        <source src={voice} type="audio/mpeg" />
                                    </audio>
                                </div>)
                    }
                }else{
                    return  (<div className="left" key={index}>
                                    <div className="left_child" alt="头像">
                                        <img src="img/1.jpg" style={{marginRight:"10px",marginBottom:"-10px"}}/><i className="iconfont" style={{color:"gray"}}>&#xe63d;</i>
                                    </div>
                                    <audio controls="controls" ref={index} id={index}>
                                        <source src={voice} type="audio/mpeg" />
                                    </audio>
                            </div>)
                }
            });
        },
        render:function(){
            var voiceArr = this.state.voiceArr;
            var flags = this.state.flags;
            var _self=this;
           return(
                <div className="wechat">
                    {
                       _self.handleMsg()
                    }
                    <footer style={{border:'0px'}}>
                        <div className="text_message">
                            <form>
                                <button onClick={_self.textToggleChange} type="button">文本</button>
                                <input onChange={this.onChange}/>
                                <button type="button" id="sendtxtbtn">发送</button>
                            </form>
                        </div>
                        <div className="voice_message">
                            <form>
                                <button onClick={_self.voiceToggleChange} type="button">切换</button>
                                <button style={{width:"70%"}} type="button" id="voicebtn">录音</button>
                                <button type="button" id="sendvoicebtn">发送</button>
                            </form>
                        </div>
                    </footer>
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
        var localId;
        $("img").click(function(){
            alert('dd');
        });
        $(".wechat div:last").css("margin-bottom","55px");
        $(".wechat>div").on('click',function(){
                var index = $(this).index();
                alert("eee");
                var mychoosevoide=document.getElementById(index);
                if(mychoosevoide.paused){
                    mychoosevoide.play();
                }else{
                    mychoosevoide.pause();
                }
            });
        $("#sendtxtbtn").on("click",function(){
            if($(".text_message input").val()){
                alert($(".text_message input").val());
                $("footer").before("<div class='right'><div class='right_child' alt='头像'><span style='width:120px;height:40px;display:inline-block;text-align:right'>"+$(".text_message input").val()+"</span><img src='img/1.jpg' style='margin-left:10px;margin-bottom:-12px'/></div></div>");
                $(".text_message input").val('');
            }else{
                alert("发送的信息不能为空！");
            }
        });
        $("#voicebtn").on("touchstart",function(){
            wx.startRecord();
        });
        $("#voicebtn").on("touchend",function(){
            wx.stopRecord({
                success: function (res) {
                    localId = res.localId;
                }
            });
        });
        $("#sendvoicebtn").on("click",function(){
            localId: localId
        });
    });
  });
</script>
</html>