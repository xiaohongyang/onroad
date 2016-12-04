<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2016/12/4
 * Time: 21:38
 */

namespace app\common\components\helpers;


class ToolsHelper
{
//4>post方法
    static function curl($url,$method='post',$data=array())
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        if (curl_errno($curl)) {
            return 'Errno'.curl_error($curl);
        }
        curl_close($curl);
        return $result;
    }

    public static function isWeChatBrowser(){

        $client = $_SERVER['HTTP_USER_AGENT'];

        return strpos($client , 'MicroMessenger') === true;
    }
}