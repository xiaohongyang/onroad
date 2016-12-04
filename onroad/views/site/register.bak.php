<?php
    use \yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <title>共享通勤_主页</title>
    <link rel="stylesheet" href="/css/public.css">
    <link rel="stylesheet" href="/css/register.css">
    <!--<script src="/js/jquery-1.7.2.js" type="text/javascript"></script>-->

    <!--bootstrap start-->
    <script src="/js/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!--bootstrap end-->

    <style type="text/css">
        #map-wrapper, #allmap {
            width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";
            position: absolute;
            z-index: 99;
            top: 0;
            left: 0;
            background: #fff;

            display: none;
        }
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=920E6C371bbd1dcb49177014025a28c8"></script>
</head>
<body>
<div id="bg">

    <?php
        $form = \yii\widgets\ActiveForm::begin([
            'method' => 'post',
            'options' => ['enctype' => 'multipart/form-data']
        ]);
    ?>
    <input type="hidden"  name="<?=$model->formName()?>[homeLongitude]" id="homeLongitude" value="homeLongitude" />
    <input type="hidden"  name="<?=$model->formName()?>[homeLatitude]" id="homeLatitude" value="homeLatitude" />
    <input type="hidden"  name="<?=$model->formName()?>[companyLongitude]" id="companyLongitude" value="companyLongitude" />
    <input type="hidden"  name="<?=$model->formName()?>[companyLatitude]" id="companyLatitude" value="companyLatitude" />
    <input type="hidden"  id="searchAddress" value="" />
    <input type="hidden"  id="addressTo" value="" />

    <div id="head">
        <a href="<?=Yii::$app->request->referrer?>"><span class="left"></span></a>
        <div class="center">填写资料</div>
        <button class="right" type="submit">确定</button>
    </div>
    <div id="content">

        <?=$form->field($model, 'mobile', ['options'=>[
            'class' => 'phone_no'
        ]])->textInput(['class'=>'tt','readonly'=>'readonly'])->label('手机号码：',['class'=>'sign'])->error(['class'=>'warning'])?>


        <?=$form->field($model, 'sex', ['options'=>[
            'class' => 'phone_no',
        ]])->radioList([1=>'男', 2=>'女'],['class'=>'tt inline'])->label('性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：',['class'=>'sign'])->error(['class'=>'warning'])?>

        <?=$form->field($model, 'clockTime', ['options'=>[
            'class' => 'phone_no',
        ]])->textInput(['class'=>'tt', 'type'=>'time'])->label('上班时间：',['class'=>'sign'])->error(['class'=>'warning'])?>

        <?=$form->field($model, 'offDutyTime', ['options'=>[
            'class' => 'phone_no',
        ]])->textInput(['class'=>'tt', 'type'=>'time'])->label('下班时间：',['class'=>'sign'])->error(['class'=>'warning'])?>


        <div class="xiaban_time">
            <span class="sign">家庭住址：</span>
            <input type="text" placeholder="请点击地图选择住址" name="<?=$model->formName()?>[homeAddress]" id="homeAddress" readonly="readonly" class="tt ">
            <span class="bt_mp" onclick="setAddress();return false;">地图</span>
        </div>
        <div class="shangban_time ex">
            <div class="fenge"></div>
            <span class="sign">公司住址：</span>
            <input type="text" placeholder="请点击地图选择住址" name="<?=$model->formName()?>[companyAddress]" id="companyAddress" readonly="readonly" class="tt">
            <span class="bt_mp" onclick="setCompanyAddress(); return false;">地图</span>
        </div>

        <div class="jslx">
            <span class="sign">角色类型：</span>
            <input type="radio" name="<?=$model->formName()?>[role]" value="1" checked="checked" class="ck">乘客
            <input type="radio" name="<?=$model->formName()?>[role]" value="2" class="sj">司机
        </div>


        <div class="intime">
            <span class="sign">&nbsp;准&nbsp;时&nbsp;性：</span>
            <input type="radio" name="<?=$model->formName()?>[timeliness]" value="1" checked="checked">准时
            <input type="radio" name="<?=$model->formName()?>[timeliness]" value="2">一般
            <input type="radio" name="<?=$model->formName()?>[timeliness]" value="3">不准时
        </div>


        <div id="up_idcard">
            <span class="head">请上传证件</span>
            <span class="close"></span>
            <div class="content">
                <p>
                    <span class="left">身份证正面：</span>
                    <input type="file" name="<?=$model->formName()?>[idCardFront]" value="">

                </p>
                <p>
                    <span class="left">身份证反面：</span>
                    <input type="file" name="<?=$model->formName()?>[idCardBack]" value="">


                </p>
                <p>
                    <span class="left">&nbsp;&nbsp;&nbsp;&nbsp;驾驶证：&nbsp;&nbsp;&nbsp;</span>
                    <input type="file" name="<?=$model->formName()?>[driverCard]" value="">


                </p>

                <span class="ok">确定</span>
            </div>
        </div>
    </div>

    <?php
        $form::end();
    ?>

    <?=Yii::$app->view->render('../layouts/bottom.php');?>


</div>

    <div id="map-wrapper">
        <div style="width:100%;margin:auto; font-size: 12px; padding-top:5px;">
            地址：<input id="text_" class="phone_no" type="text" value="杭州" style="margin-right:20px; border: 1px solid #000;"/>
            <input id="result_" type="hidden" />
            <button onclick="searchByStationName();">查询</button>
            <button class="btn-yes"  >确定</button>
            <button class="btn-no"  >取消</button>
            <br/>
            <div class="warning map_warning" style="margin-left: 5px;">

            </div>
            <div id="container" style="position: absolute; margin-top:30px; width: 100%; height: 80%; top:15px; border: 1px solid gray; overflow:hidden;">
            </div>
        </div>
        <!--<div id="allmap"></div>-->
    </div>
    <script type="text/javascript">

        var defaultAddress = '杭州';

        $('#searchAddress').val(defaultAddress);

        var map = new BMap.Map("container");
        map.centerAndZoom(defaultAddress, 12);
        map.enableScrollWheelZoom();    //启用滚轮放大缩小，默认禁用
        map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用

        map.addControl(new BMap.NavigationControl());  //添加默认缩放平移控件
        map.addControl(new BMap.OverviewMapControl()); //添加默认缩略地图控件
        map.addControl(new BMap.OverviewMapControl({isOpen: true, anchor: BMAP_ANCHOR_BOTTOM_RIGHT}));   //右下角，打开

        var localSearch = new BMap.LocalSearch(map);
        localSearch.enableAutoViewport(); //允许自动调节窗体大小
        function searchByStationName() {
            map.clearOverlays();//清空原来的标注
            var keyword = document.getElementById("text_").value;


            localSearch.setSearchCompleteCallback(function (searchResult) {


                    var poi = searchResult.getPoi(0);
                    if (poi) {
                        document.getElementById("result_").value = poi.point.lng + "," + poi.point.lat;
                        map.centerAndZoom(poi.point, 13);
                        $('#searchAddress').val(keyword);
                        $('.map_warning').html('')
                    } else {
                        $('#searchAddress').val('');
                        $('.map_warning').html('没有搜索到结果.')
                    }
                    var marker = new BMap.Marker(new BMap.Point(poi.point.lng, poi.point.lat));  // 创建标注，为要查询的地方对应的经纬度
                    map.addOverlay(marker);
                    var content = document.getElementById("text_").value + "<br/><br/>经度：" + poi.point.lng + "<br/>纬度：" + poi.point.lat;
                    var infoWindow = new BMap.InfoWindow("<p style='font-size:14px;'>" + content + "</p>");
                    marker.addEventListener("click", function () {
                        this.openInfoWindow(infoWindow);
                    });

                // marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
            });
            localSearch.search(keyword);
        }

        var aavv = function(){}

        var setAddress = function(){
            $('#map-wrapper').show();
            searchByStationName();
            $('#addressTo').val('#homeAddress');
        }

        var setCompanyAddress = function(){
            $('#map-wrapper').show();
            searchByStationName();
            $('#addressTo').val('#companyAddress');
        }

        $('.btn-no').click(function(){
            $('#map-wrapper').hide()
        })
        $('.btn-yes').click(function(){

            var address = $('#searchAddress').val().trim();
            if(address.length > 0){
                var targetId = $('#addressTo').val();
                $(targetId).val(address);
                var result_ = $('#result_').val();
                result_ = result_.split(',')
                if(result_.length==2){
                    if(targetId == '#homeAddress'){
                        $('#homeLongitude').val(result_[0])
                        $('#homeLatitude').val(result_[1])
                    } else {
                        $('#companyLongitude').val(result_[0])
                        $('#companyLatitude').val(result_[1])
                    }
                }
            }
            $('#map-wrapper').hide()
            return false;
        })
        $(function(){
//            $('body').on('click', '.bt_mp', function(){
//                $('#map-wrapper').show();
//            })
        })

        /*$(function(){
            // 百度地图API功能
            var map = new BMap.Map("allmap");
            map.centerAndZoom("杭州",12);

            //单击获取点击的经纬度
            map.addEventListener("click",function(e){
                alert(e.point.lng + "," + e.point.lat);

                var marker = new BMap.Marker(new BMap.Point(e.point.lng, e.point.lat));  // 创建标注，为要查询的地方对应的经纬度
                map.addOverlay(marker);
                var content = document.getElementById("text_").value + "<br/><br/>经度：" + e.point.lng + "<br/>纬度：" + e.point.lat;
                var infoWindow = new BMap.InfoWindow("<p style='font-size:14px;'>" + content + "</p>");
                marker.addEventListener("click", function () { this.openInfoWindow(infoWindow); });
                $('#allmap').hide();
            });
            map.enableScrollWheelZoom();                 //启用滚轮放大缩小

            $('body').on('click', '.bt_mp', function(){
                $('#allmap').show();
            })
        })*/


    </script>



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
//    $("#head .right").click(function(){
//        $("#up_idcard").css('display','block')
//    });


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

    <?php
        if(is_array($model->getFirstErrors()) && count($model->getFirstErrors())) {
            $message = "";
            foreach ($model->getFirstErrors() as $v) {
                $message .= "<li>". $v ."</li>";
            }
            $message = '<ul>' . $message . '</ul>';
    ?>
            $('#modal').modal('show')
            $('.modal-body').html('<?=$message?>');
    <?php
        }
    ?>

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