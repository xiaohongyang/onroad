<?php
    use \yii\helpers\Url;
?>
<ul id="bottom">
    <li class="border_rt"><a href="http://www.xjc1.com">找陪驾</a></li>
    <li class="border_rt"><a href="<?=Url::to(['/'])?>">通勤主页</a></li>
    <li class="border_rt"><a href="<?=Url::to(['/site/rent-car'])?>">租车</a></li>
    <li><a href="<?=Url::to(['/site/route-list'])?>">&nbsp;所有线路</a></li>
</ul>