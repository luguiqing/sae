<?php
header("Content-Type:text/plain;charset=utf-8");
echo "你成功了"
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
  <title></title>
</head>
<body>
  <a href="#">深圳大学</a>
  <button id="btn">点击点开</button> 
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
      wx.openLocation({
        latitude: 60.39, // 纬度，浮点数，范围为90 ~ -90
        longitude: 113.10, // 经度，浮点数，范围为180 ~ -180。
        name: '天文', // 位置名
        address: '我也不清楚', // 地址详情说明
        scale: 20, // 地图缩放级别,整形值,范围从1~28。默认为最大
        infoUrl: "http://www.jikexueyuan.com"
      })
    }
  });
</script>
</html>