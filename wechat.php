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
  <script src="js/jquery-1.12.4.min.js"></script>
  <title></title>
</head>
<body>
  <button id="btn1" style="width:50px;">录音</button> 
  <button id="btn2" style="width:50px;">停止</button>
  <button id="btn3" style="width:50px;">播放本地音频</button>
  <button id="btn4" style="width:50px;">播放</button>
</body>
<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
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
      var mylocalId;
       $("#btn1").on("click",function(){
            wx.startRecord();
            alert("开始");
          });
       $("#btn2").on("click",function(){
            wx.stopRecord({
                success: function (res) {
                  mylocalId = res.localId;
                  $("source").attr({
                    "src":"img/1.mp3"
                  });
                 }
            });

       });
       $("#btn4").on("click",function(){
            wx.playVoice({
              localId: mylocalId
            });
          });
       $("#btn3").on("click",function(){
            wx.playVoice({
              localId: "https://luguiqing.applinzi.com/img/1.mp3"
            });
          });
    });
  });
</script>
</html>
