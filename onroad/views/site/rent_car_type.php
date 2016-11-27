<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<title>共享通勤_主页</title>
    <script src="/js/jquery-1.7.2.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/css/public.css">
    <link rel="stylesheet" href="/css/rent_car_type.css">
</head>
<body>
    <div id="bg">
        <div id="head">
           <a href="rent_car.html"><span class="left"></span></a>
            <div class="center">租车方式</div>
            <span class="right_img"></span>
            <ul class="down_list"> 
                <a href=""><li>我的信息</li></a>
                <a href=""><li>剩余次数</li></a>
                <a href=""><li>退出</li></a>
                <li class="close_list">收起</li>
            </ul>
        </div>
        <table>
            <tr>
                <td></td>
                <td>合租</td>
                <td>独租</td>
            </tr>
            <tr>
                <td>租金</td>
                <td>399元/月/人</td>
                <td>799元/月/人</td>
            </tr>
            <tr>
                <td>押金</td>
                <td>1500元/人</td>
                <td>3000元</td>
            </tr>
            <tr>
                <td rowspan="2">证件</td>
                <td>乘客身份证</td>
                <td rowspan="2">驾驶证、身份证</td>
            </tr>
            <tr>
                <td>司机：驾驶证、身份证</td>
            </tr>
            <tr>
                <td>支付方式</td>
                <td>月付</td>
                <td>一次支付</td>
            </tr>
            <tr>
                <td>取车方式</td>
                <td colspan="2">送车上门、站点取车</td>
               
            </tr>
            <tr>
                <td colspan="3">租车咨询：18814826822/0571-86693534</td>
            </tr>
        </table>
         

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


