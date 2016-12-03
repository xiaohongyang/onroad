<?php
    use \yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<title>共享通勤_主页</title>
    <script src="/js/jquery-1.7.2.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/css/public.css">
    <link rel="stylesheet" href="/css/rent_car.css">

</head>
<body>
    <div id="bg">
        <div id="head">
           <a href="<?=Yii::$app->request->referrer?>"><span class="left"></span></a>
            <div class="center">租车</div>
            <span class="right_img"></span>
            <ul class="down_list"> 
                <a href=""><li>我的信息</li></a>
                <a href=""><li>剩余次数</li></a>
                <a href=""><li>退出</li></a>
                <li class="close_list">收起</li>
            </ul>
        </div>
        <ul id="cp_list">

            <li>
                <img src="/imges/car_rt.png" alt="">
                <a href="<?=Url::to(['/site/rent-car-info'])?>"><span>车型参数</span></a>
                <a href="<?=Url::to(['/site/rent-car-type'])?>"><span>租车方式</span></a>
            </li>
             <li>
                <img src="/imges/car_rt.png" alt="">
                <a href="<?=Url::to(['/site/rent-car-info'])?>"><span>车型参数</span></a>
                <a href="<?=Url::to(['/site/rent-car-type'])?>"><span>租车方式</span></a>
            </li>
        </ul>
        <?=Yii::$app->view->render('../layouts/bottom.php');?>
    </div>
</body>

	<script>
	   var winWidth=$(window).width()>640?640:$(window).width();
        $("html").css("fontSize",(winWidth/640)*40+"px");

        var scr_height=window.innerHeight;
        $("body").css("height",scr_height);
        


        $("#bg #head .right_img").click(function(){
            $("#bg #head .down_list").css('display','block')
        })

        $("#bg #head .down_list .close_list").click(function(){
            $("#bg #head .down_list").css('display','none')
        })


    </script>

</html>


