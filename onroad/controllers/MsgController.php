<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2016/11/26
 * Time: 20:37
 */

namespace app\controllers;


use app\common\components\helpers\MobileMsgHelpers;
use app\models\LoginForm;
use yii\log\Logger;
use yii\web\Controller;

class MsgController extends BaseController
{

    public function actionSendCode(){

        $rs = MobileMsgHelpers::getInstance()->send(['15995716443'], '您的验证码8887');
        echo sprintf("结果:%s ,msg:%s", $rs, MobileMsgHelpers::getInstance()->getMessage());
    }

    public function actionGetMobileCheckcode(){

        $mobile = \Yii::$app->request->post('mobile');
        $model = new LoginForm();
        $result = $model->getMobileCheckcode($mobile);
        if($result !== true)
            $this->renderJson(0, $result);
        else{
            $this->renderJson(1,"短信验证码已发送!");
        }
    }

}