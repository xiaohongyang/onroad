<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <title>共享通勤_主页</title>
    <link rel="stylesheet" href="/css/public.css">
    <link rel="stylesheet" href="/css/register.css">
    <script src="/js/jquery-1.7.2.js" type="text/javascript"></script>
</head>
<body>
<div id="bg">
    <div id="head">
        <a href="/index.html"><span class="left"></span></a>
        <div class="center">填写资料</div>
        <span class="right">确定</span>
    </div>
    <div id="content">
        <div class="phone_no">
            <span class="sign">手机号码：</span>
            <input type="text" placehold     er="请输入手机号" class="tt">
        </div>
        <div class="sex">
            <span class="sign">性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：</span>
            <input type="radio" name="sexy" value="man" checked="checked">男
            <input type="radio" name="sexy" value="lady">女
        </div>

        <div class="xiaban_time">
            <span class="sign">上班时间：</span>
            <input type="time" name="user_date" value="09:30:00" class="tt tt1"/>
            <span class="warning">请填打卡时间</span>
        </div>
        <div class="shangban_time ex">
            <div class="fenge"></div>
            <span class="sign">下班时间：</span>
            <input type="time" name="user_date" value="17:30:00" class="tt tt2"/>
            <span class="warning">请填打卡时间</span>
        </div>

        <div class="xiaban_time">
            <span class="sign">家庭住址：</span>
            <input type="text" placeholder="蒋村商住区" class="tt">
            <span class="bt_mp">地图</span>
        </div>
        <div class="shangban_time ex">
            <div class="fenge"></div>
            <span class="sign">公司住址：</span>
            <input type="text" placeholder="西湖文化广场" class="tt">
            <span class="bt_mp">地图</span>
        </div>


        <div class="jslx">
            <span class="sign">角色类型：</span>
            <input type="radio" name="jslx" value="ck" checked="checked" class="ck">乘客
            <input type="radio" name="jslx" value="sj" class="sj">司机
        </div>
        <div class="intime">
            <span class="sign">&nbsp;准&nbsp;时&nbsp;性：</span>
            <input type="radio" name="intime" value="good" checked="checked">准时
            <input type="radio" name="intime" value="normal">一般
            <input type="radio" name="intime" value="bad">不准时
        </div>
        <div id="up_idcard">
            <span class="head">请上传证件</span>
            <span class="close"></span>
            <div class="content">
                <p>
                    <span class="left">身份证正面：</span>
                    <input type="file" value="身份">

                </p>
                <p>
                    <span class="left">身份证反面：</span>
                    <input type="file">

                </p>
                <p>
                    <span class="left">&nbsp;&nbsp;&nbsp;&nbsp;驾驶证：&nbsp;&nbsp;&nbsp;</span>
                    <input type="file">

                </p>

                <span class="ok">确定</span>
            </div>
        </div>
    </div>


    <ul id="bottom">
        <li class="border_rt"><a href="/">找陪驾</a></li>
        <li class="border_rt"><a href="/index.html">通勤主页</a></li>
        <li class="border_rt"><a href="/rent_car.html">租车</a></li>
        <li><a href="/route.html">&nbsp;所有线路</a></li>
    </ul>



</div>
</body>

<script>
    var winWidth=$(window).width()>640?640:$(window).width();
    $("html").css("fontSize",(winWidth/640)*40+"px");

    var scr_height=window.innerHeight;
    $("body").css("height",scr_height);


    /*点击叉叉关闭窗口，但是没有上传成功，radiu停在乘客*/
    $("span.close").click(function(){
        $("#up_idcard").css('display','none');
        $('.ck').attr("checked", true);
    });


    /*确定跳出窗口*/
    $("#head .right").click(function(){
        $("#up_idcard").css('display','block')
    });


    /*点击确定，上传成功则关闭窗口，radiu停在司机*/
    $(".ok").click(function(){
        $("#up_idcard").css('display','none')
        $('.sj').attr("checked", true);
    });


    /*点击司机，跳出上传窗口*/
    $(function() {
        $('.sj').change(function() {
            $('#up_idcard').css('display','block');
        });
    })


    /*提示填写时间*/

    /*  $(".tt1").blur(function()
     {
     if ($(".tt1").val() == "")
     {
     $(".tt1").siblings('.warning').css('display','inline');
     }
     else
     {
     $(".tt1").siblings('.warning').css('display','none');
     }

     });
     $(".tt2").blur(function()
     {
     if ($(".tt2").val() == "")
     {
     $(".tt2").siblings('.warning').css('display','inline');
     }
     else
     {
     $(".tt2").siblings('.warning').css('display','none');
     }

     });

     });
     */
</script>

</html>