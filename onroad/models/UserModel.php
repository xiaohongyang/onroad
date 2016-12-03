<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2016/11/30
 * Time: 18:20
 */

namespace app\models;


use phpDocumentor\Reflection\Types\Boolean;

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
}