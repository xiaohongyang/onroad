<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<title>共享通勤_主页</title>
    <script src="/js/jquery-1.7.2.js" type="text/javascript"></script>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/public.css">
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
    <div id="bg">
        <div id="head">
            <span class="left_img"></span>
            <span class="txt">老司机</span>
            <a href=""><span class="right_img"></span></a>
        </div>
        <div id="fenge"></div>
        <div id="my_route2">
            <p class="line1">我的通勤小组</p>
            <p class="line2 exp"><span>时间：</span><span>9：00</span>—<span>18:00</span></p>
            <p class="line3 exp"><span>起点：</span><span>蒋村商住区&lt;----&gt;</span><span>终点:</span><span>西湖文化广场</span></p>
            <ul>
                <li>等待</li>
                <a href="route_info.html"><li>查看</li></a>
                <li>分享</li>
                <li>撤销</li>
            </ul>
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
                       data-slide="prev">&lsaquo;</a>
                    <a class="carousel-control right" href="#myCarousel" 
                       data-slide="next">&rsaquo;</a>-->
        </div>


        <?=Yii::$app->view->render('../layouts/bottom.php');?>
    </div>
</body>

	<script>
	   var winWidth=$(window).width()>640?640:$(window).width();
        $("html").css("fontSize",(winWidth/640)*40+"px");

        var scr_height=window.innerHeight;
        $("body").css("height",scr_height);

          $('.carousel').carousel({
             interval: 3000
          })


    </script>

</html>


