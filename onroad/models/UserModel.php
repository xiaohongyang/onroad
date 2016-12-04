<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2016/11/30
 * Time: 18:20
 */

namespace app\models;


use app\common\components\helpers\WeChatHelper;
use phpDocumentor\Reflection\Types\Boolean;
use yii\helpers\ArrayHelper;

class UserModel extends BaseModel
{

    const CONST_STATUS_NOT_VALIDATE = 0;
    const CONST_STATUS_VALIDATE_SUCCESS = 1;
    const CONST_STATUS_VALIDATE_FAILED = 2;
    const CONST_STATUS_DELETED = 3;

    public static function tableName()
    {
        return parent::getDbPrefix() . 'user';
    }

    public function getUserInfo(){
        return $this->hasOne(UserInfoModel::className(), [
            'user_id' => 'id'
        ]);
    }

    /**
     * 微信账户信息
     * @return \yii\db\ActiveQuery
     */
    public function getWeChat(){
        return $this->hasOne(WeChatModel::className(), [
            'user_id' => 'id'
        ]);
    }

    /**
     * 更新匹配状态
     * @param $bool
     * @return bool
     */
    public function updateIsMatched($bool){
        $this->is_matched = $bool;
        return $this->save();
    }

    /**
     * 更新最后登录时间
     */
    public function updateLoginTime(){
        $this->setAttribute('login_time', time());
        return $this->save();
    }

    public function updateWeChat($openId = null){

        $info = $this->getWeChatInfo($openId);
        $info = ArrayHelper::toArray($info);
        $info['user_id'] =   \Yii::$app->user->identity->getId();

        if(is_null($this->weChat)){
            $weChatModel = new WeChatModel();
            $weChatModel->getScenario(self::SCENARIO_CREATE);
        } else {
            $weChatModel  = $this->weChat;
            $weChatModel->getScenario(self::SCENARIO_UPDATE);
        }
        $rs = $weChatModel->createOrEdit($info);
        return $rs;
    }


    /**
     * 更新用户状态
     * @param $status
     * @return bool
     */
    public function updateUserStatus($status) {
        $this->setAttribute('user_status', $status);
        return $this->save();
    }

    public function getUserStatus () {
        return $this->getAttribute('user_status');
    }

    public function getWeChatInfo($openId){

        $helper = new WeChatHelper(WeChatHelper::getToken(), WeChatHelper::getAppId(), WeChatHelper::getSecret());
        $userInfo = $helper->userInfo($openId);
        return $userInfo;
    }
}