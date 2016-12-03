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
    <link rel="stylesheet" href="/css/route.css">
</head>
<body>
    <div id="bg">
        <div id="head">
           <a href="<?=Yii::$app->request->referrer?>"><span class="left"></span></a>
            <div class="center">开通路线</div>
        </div>
        
        <ul id="route_list">
            <?php
            print_r($teamList);
                if(is_array($teamList) && count($teamList)){
                    foreach ($teamList as $teamModel) {
            ?>
                    <li>
                        <div id="my_route">
                            <p class="line1">
                                <?=$teamModel->driver->userInfo->home_address?>-<?=$teamModel->driver->userInfo->company_address?>
                            </p>
                            <p class="line2 exp"><span>时间：</span><span><?=strlen($teamModel->driver->userInfo->clock_time_hour) == 1 ? 0: ''?><?=$teamModel->driver->userInfo->clock_time_hour?>:<?=strlen($teamModel->driver->userInfo->clock_time_minutes) == 1 ? 0: ''?><?=$teamModel->driver->userInfo->clock_time_minutes?></span>—<span><?=strlen($teamModel->driver->userInfo->off_duty_hour) == 1 ? 0: ''?><?=$teamModel->driver->userInfo->off_duty_hour?>:<?=strlen($teamModel->driver->userInfo->off_duty_minutes) == 1 ? 0: ''?><?=$teamModel->driver->userInfo->off_duty_minutes?></span></p>
                            <p class="line3 exp"><span>起点：</span><span><?=$teamModel->driver->userInfo->home_address?>&lt;----&gt;</span><span>终点:</span><span><?=$teamModel->driver->userInfo->company_address?></span></p>
                            <p class="line4 exp">
                                <span class="rest">剩余数量：<?=4-$teamModel->family_number?></span>
                                <span class="info"><a href="<?=Url::to(['/site/route-info','id'=>$teamModel->team_id])?>">查看</a></span>
                                <span class="share">分享</span>
                            </p>
                        </div>
                    </li>
            <?php
                    }
                }
            ?>
        </ul>



         <?=Yii::$app->view->render('../layouts/bottom.php')?>
    </div>
</body>

	<script>
	   var winWidth=$(window).width()>640?640:$(window).width();
        $("html").css("fontSize",(winWidth/640)*40+"px");

        var scr_height=window.innerHeight;
        $("body").css("height",scr_height);
    </script>

</html>


