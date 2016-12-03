<?php
    use \yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <title>共享通勤_主页</title>
    <!--<script src="/js/jquery-1.7.2.js" type="text/javascript"></script>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

    <!--bootstrap start-->
    <script src="/js/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!--bootstrap end-->

    <link rel="stylesheet" href="/css/public.css">
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
<div id="bg">
    <div id="head">
        <img src="imges/logo_head.png" alt="" class="logo">
        <span class="txt"><?=Yii::$app->user->isGuest ? '老司机' : Yii::$app->user->identity->mobile?></span>
        <span class="right_img"></span>
        <ul class="down_list">

            <?php
                if(Yii::$app->user->isGuest) {
            ?>
                    <a href="<?=Url::to('/site/login')?>">
                        <li>登录</li>
                    </a>

            <?php
                } else {
            ?>
                    <a href="">
                        <li>我的信息</li>
                    </a>
                    <a href="">
                        <li>剩余次数</li>
                    </a>
                    <a href="<?=Url::to('/site/logout')?>">
                        <li>退出</li>
                    </a>
            <?php
                }
            ?>

            <li class="close_list">收起</li>
        </ul>
    </div>
    <div id="fenge"></div>

    <?php
        if(is_null($teamModel)) {
    ?>
            <div id="my_route">
                <p class="line1">我的通勤路线</p>
                <p class="line2">暂未有合适路线匹配</p>
                <a href="javascript:void(0)"><input type="button" class="btn-match" value="马上匹配路线"></a>
            </div>
    <?php
        } else {
    ?>
            <div id="my_route2">
                <p class="line1">我的通勤小组</p>
                <p class="line2 exp" ><span>时间：</span>
                    <span>
                        <?=strlen($teamModel->driver->userInfo->clock_time_hour) == 1 ? 0: ''?><?=$teamModel->driver->userInfo->clock_time_hour?>:<?=strlen($teamModel->driver->userInfo->clock_time_minutes) == 1 ? 0: ''?><?=$teamModel->driver->userInfo->clock_time_minutes?>
                    </span>
                    —
                    <span>
                        <?=strlen($teamModel->driver->userInfo->off_duty_hour) == 1 ? 0: ''?><?=$teamModel->driver->userInfo->off_duty_hour?>:<?=strlen($teamModel->driver->userInfo->off_duty_minutes) == 1 ? 0: ''?><?=$teamModel->driver->userInfo->off_duty_minutes?>
                    </span></p>
                <p class="line3 exp"><span>起点：</span><span><?=$teamModel->driver->userInfo->home_address?>&lt;----&gt;</span><span>终点：</span><span><?=$teamModel->driver->userInfo->company_address?></span></p>
                <ul>
                    <li>等待</li>
                    <a href="<?=Url::to(['/site/route-info','id'=>$teamModel->team_id])?>"><li>查看</li></a>
                    <li>分享</li>
                    <li>撤销</li>
                </ul>
            </div>
    <?php
        }
    ?>



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

    <?=Yii::$app->view->render('../layouts/bottom.php');?>
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




    $(function(){
        $('.btn-match').click(function(){

            var url = '<?=\yii\helpers\Url::to('/route/match')?>';
            var data = {
                _csrf : '<?=Yii::$app->request->getCsrfToken()?>',
            };
            $.ajax({
                url : url,
                data : data,
                dataType : 'json',
                type : 'post',
                success : function (json) {
                    if(json.status == '<?=STATUS_NOT_LOGIN?>'){
                        window.location.href = '<?=Url::to(['/site/login'])?>';
                        return;
                    }
                    var message = json.message;

                    $('#modal').modal('show')
                    $('.modal-body').html(message);
                    if(json.status==1){
                        $('#modal').on('hidden.bs.modal', function () {
                            window.location.href = window.location.href;
                        })
                    }
                }
            })
        })
    })
</script>

</html>