<?php
/**
 * 功能: 发送短信
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2016/11/27
 * Time: 7:42
 */
namespace app\common\components\helpers;

use linslin\yii2\curl\Curl;
use yii\log\Logger;

class MobileMsgHelpers
{

    /*userid	企业id	企业ID
    account	发送用户帐号	用户帐号，由系统管理员
    password	发送帐号密码	用户账号对应的密码
    mobile	全部被叫号码	发信发送的目的号码.多个号码之间用半角逗号隔开
    content	发送内容	短信的内容，内容需要UTF-8编码
    sendTime	定时发送时间	为空表示立即发送，定时发送格式2010-10-24 09:08:10
    action	发送任务命令	设置为固定的:send
    extno	扩展子号	请先询问配置的通道是否支持扩展子号，如果不支持，请填空。子号只能为数字，且最多5位数。*/


    private $message;
    private static $_instance;

    const ACCOUNT = '001101';
    const PASSWORD = 'Sd123456';

    public static function getInstance(){
        if (is_null(self::$_instance))
            self::$_instance = new MobileMsgHelpers();
        return self::$_instance;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function send(array $mobile, $content="") {

        $rs = false;
        if(is_array($mobile)){
            $rs = $this->_send($mobile, $content);
        }
        return $rs;
    }

    public function _send(array $mobile, $content){

        $result = false;
        $url = "http://send.18sms.com/msg/HttpBatchSendSM";
        $curl = new Curl();
        $queryField = http_build_query([
            'account' => self::ACCOUNT,
            'pswd' => self::PASSWORD,
            'msg' => urlencode($content),
            'mobile' => $mobile[0],
            'product' => '',
            'needstatus' => 'false',
            'extno' => '',
        ]);
        $curl->setOption(
            CURLOPT_POSTFIELDS,
            $queryField
        );
        $curl->setOption(CURLOPT_HEADER, 1);

        $curl->post($url);
        switch ($curl->responseCode) {
            case 'timeout':
                $this->setMessage("访问超时");
                break;
            case 200:
                $result = true;
                break;
            case 404:
                $this->setMessage('404');
                break;
            default:
                $this->setMessage('未知错误');
                break;
        }

        \Yii::getLogger()->log("发送短信".$queryField."|responseCode:".$curl->responseCode, Logger::LEVEL_ERROR);
        return $result;
    }

}