<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<title>共享通勤_主页</title>
    <script src="/js/jquery-1.7.2.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/css/public.css">
    <link rel="stylesheet" href="/css/route.css">
</head>
<body>
    <div id="bg">
        <div id="head">
           <a href="index.html"><span class="left"></span></a>
            <div class="center">开通路线</div>
        </div>
        
        <ul id="route_list">
            <li>
                    <div id="my_route">
                        <p class="line1">线路昵称1</p>
                        <p class="line2 exp"><span>时间：</span><span>9：00</span>—<span>18:00</span></p>
                        <p class="line3 exp"><span>起点：</span><span>蒋村商住区&lt;----&gt;</span><span>终点:</span><span>西湖文化广场</span></p>
                        <p class="line4 exp">
                            <span class="rest">剩余数量：1</span>
                            <span class="info"><a href="route_info.html">查看</a></span>
                            <span class="share">分享</span>
                        </p>
                    </div>
            </li>
            <li>
                 <div id="my_route">
                        <p class="line1">线路昵称1</p>
                        <p class="line2 exp"><span>时间：</span><span>9：00</span>—<span>18:00</span></p>
                        <p class="line3 exp"><span>起点：</span><span>蒋村商住区&lt;----&gt;</span><span>终点:</span><span>西湖文化广场</span></p>
                        <p class="line4 exp">
                            <span class="rest">剩余数量：1</span>
                            <span class="info"><a href="route_info.html">查看</a></span>
                            <span class="share">分享</span>
                        </p>
                    </div>
            </li>
            <li>
                  <div id="my_route">
                        <p class="line1">线路昵称1</p>
                        <p class="line2 exp"><span>时间：</span><span>9：00</span>—<span>18:00</span></p>
                        <p class="line3 exp"><span>起点：</span><span>蒋村商住区&lt;----&gt;</span><span>终点:</span><span>西湖文化广场</span></p>
                        <p class="line4 exp">
                            <span class="rest">剩余数量：1</span>
                            <span class="info"><a href="route_info.html">查看</a></span>
                            <span class="share">分享</span>
                        </p>
                    </div>
            </li>
            <li>
                 <div id="my_route">
                        <p class="line1">线路昵称1</p>
                        <p class="line2 exp"><span>时间：</span><span>9：00</span>—<span>18:00</span></p>
                        <p class="line3 exp"><span>起点：</span><span>蒋村商住区&lt;----&gt;</span><span>终点:</span><span>西湖文化广场</span></p>
                        <p class="line4 exp">
                            <span class="rest">剩余数量：1</span>
                            <span class="info"><a href="route_info.html">查看</a></span>
                            <span class="share">分享</span>
                        </p>
                    </div>
            </li>
        </ul>



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
    </script>

</html>


