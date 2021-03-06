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
    }
    audio{opacity: 0;width: 10px;}


    .wechat .right{float:right;width: 65%;position: relative;height: 50px;margin:15px 5px;}
    .wechat .left{float: left;width:55%;position: relative;height: 50px;margin:25px 5px 10px;}
    .wechat img{display: inline-block;height: auto;width: 30%;border-radius: 50%;vertical-align: middle;}

    .wechat .right .right_child{position: absolute;right: 0px ;top:0px;height: 50px;width: 90%}
    .wechat .left  .left_child{position: absolute;left: 0px;top:0px;height: 50px;}

    .text_message{position: fixed;bottom: 0px;left: 0px;height: 50px;border: 0px;width: 100%;}
    .voice_message{position: fixed;bottom: 0px;left: 0px;height: 50px;border: 0px;width: 100%;display: none;}
    button{height: 50px;border:0px;display: inline-block;width: 15%}
    input{height: 48px;border: 0px;display: inline-block;width: 70%;border-top: 1px solid #B1E6E6;}

    .wechat>div:last-of-type{margin-bottom: 110px!important;}


    .right_box{width:60%; height:50px; line-height:25px;background:#76F794;font-size:12px; position:relative; display: inline-block;font-size: 15px!important;border-radius: 8px;} 
    .left_box{width:60%; height:50px; line-height:25px;background:#EAE4D7;font-size:12px; position:relative; display: inline-block;border-radius: 8px;}
    .org_box_cor{ width:0; height:0; font-size:0;border-style:solid;overflow:hidden; position:absolute; }
    .corr{border-width:10px;border-color:transparent transparent transparent #76F794;right:-20px; bottom:15px;}
    .corl{border-width:10px;border-color:transparent #EAE4D7 transparent transparent;left:-20px; bottom:15px;}
    .change_position i{background-image: url("img/voice-ani@2x.gif");
        width: 30px;
        height: 30px;
        display: inline-block;
        margin-top: 10px;
    }
    .left_i{background-position: 0px 38px;}
    .right_i{background-position: 35px 38px;margin-left: 70%;}

    .right .time{position: absolute;top:-20px;left:-30px;color:#BCC0C3;}
    .left .time{position: absolute;top:-20px;right:-50px;color:#BCC0C3;}
</style>
<body>
    <div id="container">
        
    </div>
</body>
<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/babel">
    var WeChat = React.createClass({
        getInitialState:function(){
            return {lengths:0,data:[]}
        },
        getMsg:function(){
            var _self = this;
            $.ajax({
                type:"GET",
                url:"http://api.watch.h-hy.com:8080/v1/device/201601300000005/chatRecord?username=13590213451&ticket=13590213451",
                /*url:"http://api.watch.h-hy.com:8080/v1/device/"+IMEI+"/chatRecord?username="+username+"&ticket="+ticket,*/
                dataType:"json",
                success:function(data){
                    if(data.errcode==0){
                        _self.setState({lengths:data.length,data:data.data.reverse()});
                    }
                            
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
            var data = this.state.data;
            var _self=this;
            return data.map(function(data,index){
                if(data['direction']===2){
                    if(data['type']!=='voice'){
                        return (<div className="right box"  key={index}>
                                    <div className="time">{data['created_at']}</div>
                                    <div className="right_child" alt="头像">
                                        <div className="right_box"><span className="org_box_cor corr"></span>{data['stringText']}</div><img src="img/2.jpg" style={{marginLeft:"10px"}}/>
                                    </div>
                                </div>)

                    }else{
                        return (<div className="right box"  key={index}>
                                    <div className="time">{data['created_at']}</div>
                                    <div className="right_child" alt="头像">
                                        <div className="right_box change_position"><span className="org_box_cor corr"></span><i className="right_i"></i></div><img src="img/2.jpg" style={{marginLeft:"10px"}}/>
                                    </div>
                                    <audio controls="controls" id={index}>
                                        <source src={data['voiceUrl']} type="audio/mpeg" />
                                    </audio>
                                </div>)
                    }
                }else{
                    return  (<div className="left box" key={index}>
                                    <div className="time">{data['created_at']}</div>
                                    <div className="left_child" alt="头像">
                                        <img src="img/2.jpg" style={{marginRight:"10px"}}/><div className="left_box change_position"><span className="org_box_cor corl"></span><i className="left_i"></i></div>
                                    </div>
                                    <audio controls="controls" id={index}>
                                        <source src={data['voiceUrl']} type="audio/mpeg" />
                                    </audio>
                            </div>)
                }
            });
        },
        render:function(){
            var _self=this;
           return(
                <div className="wechat">
                    {
                       _self.handleMsg()
                    }
                    <footer style={{border:'0px'}}>
                        <div className="text_message">
                            <form>
                                <button onClick={_self.textToggleChange} type="button" style={{backgroundColor:'#C0E07C'}}><i className="iconfont">&#xe606;</i></button>
                                <input placeholder="限定发送15个字以内"/>
                                <button type="button" id="sendtxtbtn" style={{color:'#fff',backgroundColor:'green'}}>发送</button>
                            </form>
                        </div>
                        <div className="voice_message">
                            <form>
                                <button onClick={_self.voiceToggleChange} type="button" style={{color:'#5052A2',backgroundColor:'#C0E07C'}}>切换</button>
                                <button style={{width:"70%"}} type="button" id="voicebtn">点击录音</button>
                                <button type="button" id="sendvoicebtn" style={{color:'#fff',backgroundColor:'green'}}>发送</button>
                            </form>
                        </div>
                    </footer>
                </div>
           ) 
        }
    });
    ReactDOM.render(<WeChat/>,document.getElementById("container"));
</script>
<script>
  $(document).ready(function(){
    wx.config({
        /*debug: true,*/
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
        "uploadVoice",
        "downloadVoice"
          ]
    });
    
    wx.ready(function () {
        var localId;
        var serverId;
        var localvoice = [];
        $("#sendtxtbtn").on("click",function(){
            if($(".text_message input").val()){
                if($(".text_message input").val().length<=15){
                    $("footer").before("<div class='right box'><div class='right_child' alt='头像'><div class='right_box'><span class='org_box_cor corr'></span>"+$(".text_message input").val()+"</div><img src='img/2.jpg' style='margin-left:10px;'/></div></div>");
                    //这里到时添加ajax传serverId给后台
                    $.ajax({
                            type:"POST",
                            /*url:"http://api.watch.h-hy.com:8080/v1/device/"+IMEI+"/text",*/
                            url:"http://api.watch.h-hy.com:8080/v1/device/201601300000005/text",
                            dataType:"json",
                            data:{
                                content:$(".text_message input").val(),
                                /*username:username,*/
                                username:13590213451,
                                /*ticket:ticket*/
                                ticket:13590213451
                            },
                            success:function(data){
                                if(data.errcode!=0){
                                    $(".text_message input").val(data.errmsg); 
                                }   
                            },
                            error:function(xhr,status,err){
                                console.log(err);
                                console.log(status);
                            }
                            
                        })
                    //
                    $(".text_message input").val('');
                }else{
                    alert("字数超过限制！");
                    $(".text_message input").val('');
                }
            }else{
                alert("发送的信息不能为空！");
            }
        });
        $("#voicebtn").on("touchstart",function(){
            wx.startRecord();
        });
        $("#sendvoicebtn").on("click",function(){
            wx.stopRecord({
                success: function (res) {
                    var index = $('.wechat>div:last').index()+1;
                    localvoice[index] = res.localId;
                    localId = res.localId;
                    wx.uploadVoice({
                        localId: localId,
                        isShowProgressTips: 1,
                        success: function (res) {
                            serverId = res.serverId;
                           
                        //这里到时添加ajax传serverId给后台
                          $.ajax({
                            type:"POST",
                            /*url:"http://api.watch.h-hy.com:8080/v1/device/"+IMEI+"/voice",*/
                            url:"http://api.watch.h-hy.com:8080/v1/device/201601300000005/voice",
                            dataType:"json",
                            data:{
                                wechatMediaId:serverId,
                                /*username:username,*/
                                username:13590213451,
                                /*ticket:ticket*/
                                ticket:13590213451
                            },
                            success:function(data){
                                if(data.errcode==0){
                                     $("footer").before("<div class='right box'><div class='right_child' alt='头像'><div class='right_box change_position'><span class='org_box_cor corr'></span><i class='right_i'></i></div><img src='img/2.jpg' style='margin-left:10px;'/></div><audio controls='controls' id="+index+"><source type='audio/mpeg' src='nohaslocalvoice'/></audio></div>");
                                }   
                            },
                            error:function(xhr,status,err){
                                console.log(err);
                                console.log(status);
                            }
                            
                        })

                        //
                        },
                        fail:function(){
                            alert("上传失败！");
                        }
                    });
                },
                fail:function(){
                    alert("录音时间太段！");
                }
            });
        });
        $(".wechat").on('click','.left_box',function(){
            var _self = this
            $(this).children(".left_i").css({backgroundPosition:"0px 0px"});
            var timeout = setTimeout(function(){
                $(_self).children(".left_i").css({backgroundPosition:"0px 38px"});
            },6000)
        });
        $(".wechat").on('click','.right_box',function(){
            var _self = this
            $(this).children(".right_i").css({backgroundPosition:"35px 0px"});
            var timeout = setTimeout(function(){
                $(_self).children(".right_i").css({backgroundPosition:"35px 38px"});
            },6000)
        });
        $(".wechat").on('click','.box',function(){
            var index = $(this).index();
            alert(index);
            var mychoosevoide=document.getElementById(index);
            if($("#"+index+" source").attr("src")==="nohaslocalvoice"){
                wx.playVoice({
                                localId: localvoice[index] 
                            });
            }else{
                if(mychoosevoide.paused){
                    mychoosevoide.play();
                }else{
                    mychoosevoide.pause();
                }
            }
        });
    });
  });
</script>
</html>