<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <title>共享通勤_主页</title>
    <script src="jquery-1.7.2.js" type="text/javascript"></script>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/public.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<div id="bg">
    <div id="head">
        <img src="imges/logo_head.png" alt="" class="logo">
        <span class="txt">老司机</span>
        <span class="right_img"></span>
        <ul class="down_list">
            <a href="">
                <li>我的信息</li>
            </a>
            <a href="">
                <li>剩余次数</li>
            </a>
            <a href="">
                <li>退出</li>
            </a>
            <li class="close_list">收起</li>
        </ul>
    </div>
    <div id="fenge"></div>
    <div id="my_route">
        <p class="line1">我的通勤路线</p>
        <p class="line2">暂未有合适路线匹配</p>
        <a href=""><input type="button" value="马上匹配路线"></a>
    </div>
    <div id="myCarousel" class="carousel slide">
        <!-- 轮播（Carousel）指标 -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
        </ol>
        <!-- 轮播（Carousel）项目 -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="imges/car.png" alt="First slide">
            </div>
            <div class="item">
                <img src="imges/car2.png" alt="Second slide">
            </div>
        </div>
        <!-- 轮播（Carousel）导航
        <a class="carousel-control left" href="#myCarousel"
           data-slide="prev"></a>
        <a class="carousel-control right" href="#myCarousel"
           data-slide="next"></a>-->
    </div>
    <ul id="bottom">
        <li class="border_rt"><a href="">找陪驾</a></li>
        <li class="border_rt"><a href="index.html">通勤主页</a></li>
        <li class="border_rt"><a href="rent_car.html">租车</a></li>
        <li><a href="route.html">&nbsp;所有线路</a></li>
    </ul>
</div>
</body>

<script>
    var winWidth = $(window).width() > 640 ? 640 : $(window).width();
    $("html").css("fontSize", (winWidth / 640) * 40 + "px");

    var scr_height = window.innerHeight;
    $("body").css("height", scr_height);
    $('.carousel').carousel({
        interval: 2000
    })

    $("#bg #head .right_img").click(function () {
        $("#bg #head .down_list").css('display', 'block')
    })

    $("#bg #head .down_list .close_list").click(function () {
        $("#bg #head .down_list").css('display', 'none')
    })


</script>

</html>