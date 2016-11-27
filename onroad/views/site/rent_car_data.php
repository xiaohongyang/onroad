<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<title>共享通勤_主页</title>
    <script src="/js/jquery-1.7.2.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/css/public.css">
    <link rel="stylesheet" href="/css/rent_car_data.css">
</head>
<body>
    <div id="bg">
        <div id="head">
           <a href="rent_car.html"><span class="left"></span></a>
            <div class="center">车型参数配置</div>
            <span class="right_img"></span>
            <ul class="down_list"> 
                <a href=""><li>我的信息</li></a>
                <a href=""><li>剩余次数</li></a>
                <a href=""><li>退出</li></a>
                <li class="close_list">收起</li>
            </ul>
        </div>
        <ul class="cont">
            <li class="hd">康迪K10参数配置</li>
            <li>
                <span class="left">品牌：</span><span class="right">康迪全球鹰电动汽车</span>
            </li>
            <li>
                <span class="left">级别：</span><span class="right">微型车</span>
            </li>
            <li>
                <span class="left">发动机：</span><span class="right">35kW(电动机)</span>
            </li>
             <li>
                <span class="left">动力类型：</span><span class="right">纯电动</span>
            </li>
             <li>
                <span class="left">续航里程(km)：</span><span class="right">100公里</span>
            </li>
             <li>
                <span class="left">充电时间：</span><span class="right">慢充6-8小时</span>
            </li>
             <li>
                <span class="left">最高车速：</span><span class="right">80</span>
            </li>
             <li>
                <span class="left">车门数：</span><span class="right">3</span>
            </li>
             <li>
                <span class="left">座位数：</span><span class="right">2</span>
            </li>
             <li>
                <span class="left">挡位个数：</span><span class="right">1</span>
            </li>
             <li>
                <span class="left">变速箱：</span><span class="right">1挡固定齿轮比</span>
            </li>
            <li>
                <span class="left">长*宽*高(mm)：</span><span class="right">2900×1545×1590</span>
            </li>
             <li>
                <span class="left">车身结构：</span><span class="right">3门 2座 两厢轿车</span>
            </li>
        </ul>
         

         <div id="up_idcard">
                <span class="head">修改线路信息</span>
                <span class="close"></span>
                <div class="content">
                    <p class="rout_name">
                       <span>线路昵称：</span>
                       <input type="text" placeholder="输入线路昵称">
               
                    </p>
                    <p class="shangban_time">
                      <span>上班时间：</span>
                      <input type="time" name="user_date" value="09:00:00"/>
            
                    </p>
                    <p class="xiaban_time">
                       <span>下班时间：</span>
                       <input type="time" name="user_date" value="17:30:00"/>
                    </p>
                </div>
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
	   var winWidth=$(window).width()>640?640:$(window).width();
        $("html").css("fontSize",(winWidth/640)*40+"px");

        var scr_height=window.innerHeight;
        $("body").css("height",scr_height);

        $("span.close").click(function(){
                 $("#up_idcard").css('display','none')
        });

        $("#head .right").click(function(){
                 $("#up_idcard").css('display','block')
        });


         $("#bg #head .right_img").click(function(){
            $("#bg #head .down_list").css('display','block')
        })

        $("#bg #head .down_list .close_list").click(function(){
            $("#bg #head .down_list").css('display','none')
        })

    </script>

</html>


