<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JSSDK</title>
</head>
<body>
{{$res}}
<button id="pub">分享</button>

<script src="/js/jquery.min.js"></script>
<script src="http://res2.wx.qq.com/open/js/jweixin-1.4.0.js "></script>
<script>
    wx.config({
        //debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: "{{$jsconfig['appId']}}", // 必填，公众号的唯一标识
        timestamp: "{{$jsconfig['timestamp']}}", // 必填，生成签名的时间戳
        nonceStr: "{{$jsconfig['nonceStr']}}", // 必填，生成签名的随机串
        signature: "{{$jsconfig['signature']}}",// 必填，签名
        jsApiList: ['chooseImage','uploadImage','updateAppMessageShareData','downloadImage'] // 必填，需要使用的JS接口列表
    });
    wx.ready(function(){
        $("#pub").click(function(){
            var link = window.location.href;
            var protocol = window.location.protocol;
            var host = window.location.host;
            wx.updateAppMessageShareData({
                title: '分享', // 分享标题
                desc: '微信测试', // 分享描述
                link: link, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl:protocol+'//'+host+'/resources/images/icon.jpg', // 分享图标
                success: function (reg) {
                    // 设置成功

                    alert('分享成功');
                }
            })
        })


    });
</script>
</body>
</html>