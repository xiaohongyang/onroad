<?php
    use \yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<title>共享通勤_主页</title>
    <!--<script src="/js/jquery-1.7.2.js" type="text/javascript"></script>-->

    <script src="/js/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/css/public.css">
    <link rel="stylesheet" href="/css/route_info.css">
</head>
<body>
    <div id="bg">
        <div id="head">
           <a href="<?=Yii::$app->request->referrer?>"><span class="left"></span></a>
            <div class="center">线路昵称</div>
            <span class="right">修改</span>
        </div>
        <ul class="cont">
            <li>
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;司机：</span><span><?=$teamModel->driver->mobile?></span>
            </li>
            <li>
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;车型：</span><span><?=$teamModel->car_type ?:'康迪K11'?></span>
            </li>
            <li>
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;车牌：</span><span><?=$teamModel->car_number ?:'浙A3DD43'?></span>
            </li>
             <li>
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;座位：</span><span>4个</span>
            </li>
             <li>
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;时间：</span><span><?=strlen($teamModel->driver->userInfo->clock_time_hour) == 1 ? 0: ''?><?=$teamModel->driver->userInfo->clock_time_hour?>:<?=strlen($teamModel->driver->userInfo->clock_time_minutes) == 1 ? 0: ''?><?=$teamModel->driver->userInfo->clock_time_minutes?></span>
                 —
                 <span><?=strlen($teamModel->driver->userInfo->off_duty_hour) == 1 ? 0: ''?><?=$teamModel->driver->userInfo->off_duty_hour?>:<?=strlen($teamModel->driver->userInfo->off_duty_minutes) == 1 ? 0: ''?><?=$teamModel->driver->userInfo->off_duty_minutes?></span>
            </li>
             <li>
                <span>上班时间：</span><span><?=strlen($teamModel->driver->userInfo->clock_time_hour) == 1 ? 0: ''?><?=$teamModel->driver->userInfo->clock_time_hour?>:<?=strlen($teamModel->driver->userInfo->clock_time_minutes) == 1 ? 0: ''?><?=$teamModel->driver->userInfo->clock_time_minutes?></span>
            </li>
             <li>
                <span>下班时间：</span><span><?=strlen($teamModel->driver->userInfo->off_duty_hour) == 1 ? 0: ''?><?=$teamModel->driver->userInfo->off_duty_hour?>:<?=strlen($teamModel->driver->userInfo->off_duty_minutes) == 1 ? 0: ''?><?=$teamModel->driver->userInfo->off_duty_minutes?></span>
            </li>
             <li>
                <span>线路起点：</span><span><?=$teamModel->driver->userInfo->home_address?></span>
            </li>
             <li>
                <span>线路终点：</span><span><?=$teamModel->driver->userInfo->company_address?></span>
            </li>
             <li>
                <span>运行状况：</span><span>出发</span>
            </li>
             <li>
                <span>剩余座位：</span><span><?=4-$teamModel->family_number?></span>
            </li>
            <li>
                <span>司机手机号：</span><span><?=$teamModel->driver->mobile?></span>
            </li>
        </ul>
         

         <div id="up_idcard">
                <span class="head">修改线路信息</span>
                <span class="close"></span>
                <div class="content">
                    <?php
                        $routeName = $teamModel->route_name ? $teamModel->route_name : $teamModel->driver->userInfo->home_address . '-' .$teamModel->driver->userInfo->company_address;
                        $clockTimeHour = !is_null($teamModel->clock_time_hour) ? $teamModel->clock_time_hour : $teamModel->driver->userInfo->clock_time_hour;
                        $clockTimeHour = strlen($clockTimeHour)==1 ? '0'.$clockTimeHour : $clockTimeHour;
                        $clockTimeMinutes = !is_null($teamModel->clock_time_minutes) ? $teamModel->clock_time_minutes : $teamModel->driver->userInfo->clock_time_minutes;
                        $clockTimeMinutes = strlen($clockTimeMinutes)==1 ? '0'.$clockTimeMinutes : $clockTimeMinutes;

                        $offDutyHour = !is_null($teamModel->off_duty_hour) ? $teamModel->off_duty_hour : $teamModel->driver->userInfo->off_duty_hour;
                        $offDutyHour = strlen($offDutyHour)==1 ? '0'.$offDutyHour : $offDutyHour;
                        $offDutyMinutes = !is_null($teamModel->off_duty_minutes) ? $teamModel->off_duty_minutes : $teamModel->driver->userInfo->off_duty_minutes;
                        $offDutyMinutes = strlen($offDutyMinutes)==1 ? '0'.$offDutyMinutes : $offDutyMinutes;
                    ?>
                    <p class="rout_name">
                       <span>线路昵称：</span>
                       <input type="text" placeholder="输入线路昵称" id="routeName" value="<?=$routeName?>">
               
                    </p>

                    <p class="shangban_time">
                      <span>上班时间：</span>
                      <input type="time" name="user_date" id="clockTime" value="<?=$clockTimeHour?>:<?=$clockTimeMinutes?>"/>
            
                    </p>
                    <p class="xiaban_time">
                       <span>下班时间：</span>
                       <input type="time" name="user_date" id="offDuty" value="<?=$offDutyHour?>:<?=$offDutyMinutes?>"/>
                    </p>

                    <p class="xiaban_time">
                        <input type="button"   value="提交" class="btn btn-primary btn-submit" >
                    </p>
                </div>
            </div>




        <?=Yii::$app->view->render('../layouts/bottom.php')?>

        </ul>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modalLabel">提示</h4>
                </div>
                <div class="modal-body" style="color: #000;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
</body>

	<script type="text/javascript">
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






       $(function(){
           $('.btn-submit').click(function(){

               $("span.close").trigger('click');

               var url = '<?=\yii\helpers\Url::to('/route/edit')?>';
               var routeName = $('#routeName').val();
               var clockTime = $('#clockTime').val();
               var offDuty = $('#offDuty').val();
               var clockTimeArray = clockTime.split(':');
               var clockTimeHour = clockTimeArray[0];
               var clockTimeMinutes = clockTimeArray[1];

               var offDutyArray = offDuty.split(':');
               var offDutyHour = offDutyArray[0];
               var offDutyMinutes = offDutyArray[1];
               var teamId = '<?=Yii::$app->request->get('id')?>';

               var data = {
                   _csrf : '<?=Yii::$app->request->getCsrfToken()?>',
                   teamId : teamId,
                   routeName : routeName,
                   clockTimeHour : clockTimeHour,
                   clockTimeMinutes : clockTimeMinutes,
                   offDutyHour : offDutyHour,
                   offDutyMinutes : offDutyMinutes,
               };
               $.ajax({
                   url : url,
                   data : data,
                   dataType : 'json',
                   type : 'post',
                   success : function (json) {
                       console.log(json)
                       if(json.status == '<?=STATUS_NOT_LOGIN?>'){
                           window.location.href = '<?=Url::to(['/site/login'])?>';
                           return;
                       }
                       var message = json.message;

                       $('#modal').modal('show')
                       $('.modal-body').html(message);
                   }
               })


           })
       })
    </script>

</html>


