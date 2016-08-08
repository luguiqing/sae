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
  <title>展示图片</title>
</head>
<body>
  <button id="btn">点击点开</button>
  <img src=""/> 
</body>
<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
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
      "uploadImage"
    ]
  });
  wx.ready(function () {
    // 在这里调用 API
    document.getElementById("btn").onclick=function(){
      wx.chooseImage({
      count: 2, // 默认9
      sizeType: ['original', 'compressed'], //可以指定是原图还是压缩图，默认二者都有
      sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
      success: function (res) {
        var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
        $("img").attr({
          "src":localIds[0]
        })
        }

      });

    }
  });
</script>
</html>
