<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2016/12/4
 * Time: 16:07
 */

namespace app\controllers;


use app\common\components\helpers\WeChatHelper;

class WxController extends BaseController
{



    public function actionOauth2(){

        if (isset($_GET['code'])){

            $code = $_GET['code'];
            $wxObj = new WeChatHelper(WeChatHelper::TOKEN,WeChatHelper::APPID,WeChatHelper::SECRET);
            $oauthInfo = $wxObj->oauthGetAccessToken($code);

            $openid = $oauthInfo->openid;
            $userInfo = $wxObj->userInfo($openid);
            $this->redirect('/site/login?wxOpenid='.$userInfo->openid);

        }else{
            echo "NO CODE";
        }
    }

}