<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2016/12/4
 * Time: 15:26
 */

namespace app\common\components\helpers;


class WeChatHelper {

    const APPID = 'wx2887eeeac1e7d898';                        //公众号appid
    const SECRET = 'a2fb0cb1798fd734be9fda0edfdd3ead';      //公众号secret
    const TOKEN = 'xinjia2015xjc1';

    const MSG_TYPE_TEXT = 'text';
    const MSG_TYPE_IMAGE = 'image';
    const MSG_TYPE_VOICE = 'voice';
    const MSG_TYPE_VIDEO = 'video';
    const MSG_TYPE_LOCATION = 'location';
    const MSG_TYPE_LINK = 'link';
    const MSG_TYPE_EVENT = 'event';

    const MSG_EVENT_SUBSCRIBE = 'subscribe';
    const MSG_EVENT_UNSUBSCRIBE = 'unsubscribe';
    const MSG_EVENT_SCAN = 'scan';
    const MSG_EVENT_LOCATION = 'LOCATION';
    const MSG_EVENT_CLICK = 'CLICK';

    const REPLY_TYPE_TEXT = 'text';
    const REPLY_TYPE_IMAGE = 'image';
    const REPLY_TYPE_VOICE = 'voice';
    const REPLY_TYPE_VIDEO = 'video';
    const REPLY_TYPE_MUSIC = 'music';
    const REPLY_TYPE_NEWS = 'news';

    const MEDIA_TYPE_IMAGE = "image";
    const MEDIA_TYPE_VOICE = 'voice';
    const MEDIA_TYPE_VIDEO = 'video';
    const MEDIA_TYPE_THUMB = 'thumb';

    const SCOPE_REDIRECT = "snsapi_base";
    const SCOPE_POP = "snsapi_userinfo";

    public static function getAppId() {
        return \Yii::$app->params['we_chat_app_id'];
    }

    public static function getSecret() {
        return \Yii::$app->params['we_chat_secret'];
    }

    public static function getToken() {
        return \Yii::$app->params['we_chat_token'];
    }

    private static $links = array(
        'message' => "https://api.weixin.qq.com/cgi-bin/message/mass/send",
        'group_create' => "https://api.weixin.qq.com/cgi-bin/groups/create",
        'group_get' => "https://api.weixin.qq.com/cgi-bin/groups/get",
        'group_getid' => "https://api.weixin.qq.com/cgi-bin/groups/getid",
        'group_rename' => "https://api.weixin.qq.com/cgi-bin/groups/update",
        'group_move' => "https://api.weixin.qq.com/cgi-bin/groups/members/update",
        'user_info' => "https://api.weixin.qq.com/cgi-bin/user/info",
        'user_get' => 'https://api.weixin.qq.com/cgi-bin/user/get',
        'menu_create' => 'https://api.weixin.qq.com/cgi-bin/menu/create',
        'menu_get' => 'https://api.weixin.qq.com/cgi-bin/menu/get',
        'menu_delete' => 'https://api.weixin.qq.com/cgi-bin/menu/delete',
        'qrcode' => 'https://api.weixin.qq.com/cgi-bin/qrcode/create',
        'showqrcode' => 'https://mp.weixin.qq.com/cgi-bin/showqrcode',
        'media_download' => 'http://file.api.weixin.qq.com/cgi-bin/media/get',
        'media_upload' => 'http://file.api.weixin.qq.com/cgi-bin/media/upload',
        'oauth_code' => 'https://open.weixin.qq.com/connect/oauth2/authorize',
        'oauth_access_token' => 'https://api.weixin.qq.com/sns/oauth2/access_token',
        'oauth_refresh' => 'https://api.weixin.qq.com/sns/oauth2/refresh_token',
        'oauth_userinfo' => 'https://api.weixin.qq.com/sns/userinfo'
    );

    private static $errors = array(
        '-1' => '系统繁忙',
        '0' => '请求成功'
    );

    private static $debug = false;

    private $token;
    private $postStr;
    private $postObj;

    private $appid;
    private $appsecret;
    private $access_token;
    private $valid = 0;

    /**
     * @param	  $token
     * @param null $appid
     * @param null $appsecret
     * @param bool $debug
     */
    public function __construct($token, $appid = null, $appsecret = null, $debug = false) {
        $this->token = $token;
        if (!empty($_GET) && $this->checkSignature())
            $this->handleRequest();
        $this->appid = $appid;
        $this->appsecret = $appsecret;
        self::$debug = $debug;
    }

    /**
     * 第三方网页通过Oauth2.0获取用户授权
     * 通过code获取access_token
     */
    public function oauthGetAccessToken($code,$type=1) {
        $type = $type?'authorization_code':'snsapi_base';

        return self::get(self::$links['oauth_access_token'] . "?appid={$this->appid}&secret={$this->appsecret}&code={$code}&grant_type={$type}");
    }



    /**
     * 获取关注者列表
     * Author: 清风明月 258082291@qq.com
     * @param null $next_openid
     * @return bool|mixed
     */
    public function userGet($next_openid = null) {
        if ($this->getAccessToken())
        {
            if ($next_openid)
                return self::get(self::$links['user_get'] . "?access_token={$this->access_token}&openid=");
            else
                return self::get(self::$links['user_get'] . "?access_token={$this->access_token}&next_openid={$next_openid}");
        }

        return false;
    }

    /**
     * 获取用户信息
     * Author: 清风明月 258082291@qq.com
     * @param $openid
     * @return bool|mixed
     */
    public function userInfo($openid) {
        if ($this->getAccessToken())
        {
            return self::get(self::$links['user_info'] . "?access_token={$this->access_token}&openid={$openid}");
        }

        return false;
    }


    /**
     * 创建自定义菜单
     * Author: 清风明月 258082291@qq.com
     * @param $menus
     * @return bool
     */
    public function menuCreate($menus) {
        if ($this->getAccessToken())
        {
            $message = array();
            $message['button'] = $menus;

            return self::post(self::$links['menu_create'] . "?access_token={$this->access_token}", json_encode($message, JSON_UNESCAPED_UNICODE));
        }

        return false;
    }




    /**
     * 发送文本客服消息，需要access_token
     * Author: 清风明月 258082291@qq.com
     * @param $openid
     * @param $content
     * @return bool|mixed
     */
    public function sendTextMessage($openid, $content) {
        if ($this->getAccessToken())
        {
            $message = array();

            $message['touser'] = array($openid,$openid,$openid);
            $message['msgtype'] = "text";
            $message['text']['content'] = $content;

            return self::post(self::$links['message'] . "?access_token={$this->access_token}", json_encode($message, JSON_UNESCAPED_UNICODE));
        }

        return false;
    }



    /**
     * 检查签名
     *
     * @return bool
     */
    private function checkSignature() {
        if (!isset($_GET['signature']) || !isset($_GET['timestamp']) || !isset($_GET['nonce']))
            return false;
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $tmpArr = array($this->token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature)
            return true;
        else
            return false;
    }

    /**
     * 获取高级接口的access_token
     * Author: 清风明月 258082291@qq.com
     * @return bool
     */
    private function getAccessToken() {
        if ($this->appid && $this->appsecret)
        {
            if ($this->valid <= time())
            {
                $access = json_decode(ToolsHelper::curl("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appid}&secret={$this->appsecret}"));
                if (isset($access->access_token) && isset($access->expires_in))
                {
                    $this->access_token = $access->access_token;
                    $this->valid = time() + $access->expires_in;
                }
                else
                    return false;
            }

            return true;
        }
        return false;
    }


    //GET方法
    private static function get($link) {
        if (self::$debug)
            Log::out("weixin_debug", 'I', "get:" . $link);

        return json_decode(ToolsHelper::curl($link));
    }

    /**
     * POST方法
     *
     * @param $link
     * @param $data
     *
     * @return mixed
     */
    private static function post($link, $data) {
        if (self::$debug)
            Log::out("weixin_debug", 'I', "post:", $link . ":" . serialize($data));

        return json_decode(ToolsHelper::curl($link, 'POST', $data));
    }

    /******************************************************************************************************************/



    //验证签名
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if($tmpStr == $signature){
            echo $echoStr;
            exit;
        }
    }

    //响应消息
    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            $this->logger("R ".$postStr);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);

            //消息类型分离
            switch ($RX_TYPE)
            {
                case "event":
                    $result = $this->receiveEvent($postObj);
                    break;
                case "text":
                    $result = $this->receiveText($postObj);
                    break;
                case "image":
                    $result = $this->receiveImage($postObj);
                    break;
                case "location":
                    $result = $this->receiveLocation($postObj);
                    break;
                case "voice":
                    $result = $this->receiveVoice($postObj);
                    break;
                case "video":
                    $result = $this->receiveVideo($postObj);
                    break;
                case "link":
                    $result = $this->receiveLink($postObj);
                    break;
                default:
                    $result = "unknown msg type: ".$RX_TYPE;
                    break;
            }
            $this->logger("T ".$result);
            echo $result;
        }else {
            echo "";
            exit;
        }
    }

    //接收事件消息
    private function receiveEvent($object)
    {
        $content = "";
        switch ($object->Event)
        {
            case "subscribe":
                //$content = "欢迎您使用筑牛网微信，请先登录您的账号: <a href='http://zhuniu168.com/webweixin/login'>马上登录</a>";
                $href= 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx3ee4b2dc32844eb9&redirect_uri=http://www.zhuniu.com/wx/oauth2&response_type=code&scope=snsapi_userinfo&state=1&connect_redirect=1#wechat_redirect';
                $content = "欢迎您使用筑牛网微信，请先登录您的账号: <a href='http://zhuniu168.com/webweixin/login'>马上登录</a>";
                break;
            case "unsubscribe":
                $content = "取消关注";
                break;
            case "SCAN":
                $content = "扫描场景 ".$object->EventKey;
                break;
            case "CLICK":
                switch ($object->EventKey)
                {
                    case "COMPANY":
                        $content = array();
                        $content[] = array("Title"=>"多图文1标题", "Description"=>"", "PicUrl"=>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
                        break;
                    default:
                        //$content = "点击菜单：".$object->EventKey;
                        $content = "";
                        break;
                }
                break;
            case "LOCATION":
                $content = "上传位置：纬度 ".$object->Latitude.";经度 ".$object->Longitude;
                break;
            case "VIEW":
                $content = "跳转链接 ".$object->EventKey;
                break;
            case "MASSSENDJOBFINISH":
                $content = "消息ID：".$object->MsgID."，结果：".$object->Status."，粉丝数：".$object->TotalCount."，过滤：".$object->FilterCount."，发送成功：".$object->SentCount."，发送失败：".$object->ErrorCount;
                break;
            default:
                $content = "receive a new event: ".$object->Event;
                break;
        }
        if(is_array($content)){
            if (isset($content[0])){
                $result = $this->transmitNews($object, $content);
            }else if (isset($content['MusicUrl'])){
                $result = $this->transmitMusic($object, $content);
            }
        }else{
            $result = $this->transmitText($object, $content);
        }

        return $result;
    }

    //接收文本消息
    private function receiveText($object)
    {
        $keyword = trim($object->Content);
        //多客服人工回复模式
        if (strstr($keyword, "您好") || strstr($keyword, "你好") || strstr($keyword, "在吗")){
            $result = $this->transmitService($object);
        }

        if (strstr($keyword, "t")){
            $href= 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx3ee4b2dc32844eb9&redirect_uri=http://www.zhuniu.com/wx/oauth2&response_type=code&scope=snsapi_userinfo&state=1&connect_redirect=1#wechat_redirect';
            $result = $this->transmitText($object, "<a href='{$href}'>test</a>");
        }
        //自动回复模式
        else{
            if (strstr($keyword, "单图文")){
                $content = array();
                $content[] = array("Title"=>"单图文标题",  "Description"=>"单图文内容", "PicUrl"=>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
            }

            if(is_array($content)){
                if (isset($content[0]['PicUrl'])){
                    $result = $this->transmitNews($object, $content);
                }else if (isset($content['MusicUrl'])){
                    $result = $this->transmitMusic($object, $content);
                }
            }else{
                $result = $this->transmitText($object, $content);
            }
        }

        return $result;
    }

    //接收图片消息
    private function receiveImage($object)
    {
        $content = array("MediaId"=>$object->MediaId);
        $result = $this->transmitImage($object, $content);
        return $result;
    }

    //接收位置消息
    private function receiveLocation($object)
    {
        $content = "你发送的是位置，纬度为：".$object->Location_X."；经度为：".$object->Location_Y."；缩放级别为：".$object->Scale."；位置为：".$object->Label;
        $result = $this->transmitText($object, $content);
        return $result;
    }

    //接收语音消息
    private function receiveVoice($object)
    {
        if (isset($object->Recognition) && !empty($object->Recognition)){
            $content = "你刚才说的是：".$object->Recognition;
            $result = $this->transmitText($object, $content);
        }else{
            $content = array("MediaId"=>$object->MediaId);
            $result = $this->transmitVoice($object, $content);
        }

        return $result;
    }

    //接收视频消息
    private function receiveVideo($object)
    {
        $content = array("MediaId"=>$object->MediaId, "ThumbMediaId"=>$object->ThumbMediaId, "Title"=>"", "Description"=>"");
        $result = $this->transmitVideo($object, $content);
        return $result;
    }

    //接收链接消息
    private function receiveLink($object)
    {
        $content = "你发送的是链接，标题为：".$object->Title."；内容为：".$object->Description."；链接地址为：".$object->Url;
        $result = $this->transmitText($object, $content);
        return $result;
    }

    //回复文本消息
    private function transmitText($object, $content)
    {
        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $result;
    }

    //回复图片消息
    private function transmitImage($object, $imageArray)
    {
        $itemTpl = "<Image>
    <MediaId><![CDATA[%s]]></MediaId>
</Image>";

        $item_str = sprintf($itemTpl, $imageArray['MediaId']);

        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[image]]></MsgType>
$item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复语音消息
    private function transmitVoice($object, $voiceArray)
    {
        $itemTpl = "<Voice>
    <MediaId><![CDATA[%s]]></MediaId>
</Voice>";

        $item_str = sprintf($itemTpl, $voiceArray['MediaId']);

        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[voice]]></MsgType>
$item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复视频消息
    private function transmitVideo($object, $videoArray)
    {
        $itemTpl = "<Video>
    <MediaId><![CDATA[%s]]></MediaId>
    <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
    <Title><![CDATA[%s]]></Title>
    <Description><![CDATA[%s]]></Description>
</Video>";

        $item_str = sprintf($itemTpl, $videoArray['MediaId'], $videoArray['ThumbMediaId'], $videoArray['Title'], $videoArray['Description']);

        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[video]]></MsgType>
$item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复图文消息
    private function transmitNews($object, $newsArray)
    {
        if(!is_array($newsArray)){
            return;
        }
        $itemTpl = "    <item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
    </item>
";
        $item_str = "";
        foreach ($newsArray as $item){
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>%s</ArticleCount>
<Articles>
$item_str</Articles>
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
        return $result;
    }

    //回复音乐消息
    private function transmitMusic($object, $musicArray)
    {
        $itemTpl = "<Music>
    <Title><![CDATA[%s]]></Title>
    <Description><![CDATA[%s]]></Description>
    <MusicUrl><![CDATA[%s]]></MusicUrl>
    <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
</Music>";

        $item_str = sprintf($itemTpl, $musicArray['Title'], $musicArray['Description'], $musicArray['MusicUrl'], $musicArray['HQMusicUrl']);

        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[music]]></MsgType>
$item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复多客服消息
    private function transmitService($object)
    {
        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[transfer_customer_service]]></MsgType>
</xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //日志记录
    private function logger($log_content)
    {
        if(isset($_SERVER['HTTP_APPNAME'])){   //SAE
            sae_set_display_errors(false);
            sae_debug($log_content);
            sae_set_display_errors(true);
        }else if($_SERVER['REMOTE_ADDR'] != "127.0.0.1"){ //LOCAL
            $max_size = 10000;
            $log_filename = "log.xml";
            if(file_exists($log_filename) and (abs(filesize($log_filename)) > $max_size)){unlink($log_filename);}
            file_put_contents($log_filename, date('H:i:s')." ".$log_content."\r\n", FILE_APPEND);
        }
    }


}