<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<title>共享通勤_主页</title>
    <script src="/js/jquery-1.7.2.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/css/public.css">
    <link rel="stylesheet" href="/css/route_info.css">
</head>
<body>
    <div id="bg">
        <div id="head">
           <a href="index.html"><span class="left"></span></a>
            <div class="center">线路昵称</div>
            <span class="right">修改</span>
        </div>
        <ul class="cont">
            <li>
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;司机：</span><span>陈司机</span>
            </li>
            <li>
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;车型：</span><span>康迪K11</span>
            </li>
            <li>
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;车牌：</span><span>浙A3DD43</span>
            </li>
             <li>
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;座位：</span><span>4个</span>
            </li>
             <li>
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;时间：</span><span>9:00</span>—<span>17:30</span>
            </li>
             <li>
                <span>上班时间：</span><span>9:00</span>
            </li>
             <li>
                <span>下班时间：</span><span>17:30</span>
            </li>
             <li>
                <span>线路起点：</span><span>蒋村商住区</span>
            </li>
             <li>
                <span>线路终点：</span><span>西湖文化广场</span>
            </li>
             <li>
                <span>运行状况：</span><span>出发</span>
            </li>
             <li>
                <span>剩余座位：</span><span>1</span>
            </li>
            <li>
                <span>司机手机号：</span><span>15068426523</span>
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

    </script>

</html>


