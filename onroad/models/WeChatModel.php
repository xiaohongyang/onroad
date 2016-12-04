<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2016/12/4
 * Time: 22:17
 */

namespace app\models;


use yii\behaviors\TimestampBehavior;

class WeChatModel extends BaseModel
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className()
            ]
        ];
    }


    public static function tableName()
    {
        return parent::getDbPrefix() . 'we_chat';
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => [
                'user_id',
                'openid',
                'nickname',
                'sex',
                'language',
                'city',
                'province',
                'country',
                'headimgurl',
                'subscribe_time',
                'created_at',
                'updated_at',
            ],
            self::SCENARIO_UPDATE => [
                'user_id',
                'openid',
                'nickname',
                'sex',
                'language',
                'city',
                'province',
                'country',
                'headimgurl',
                'subscribe_time',
                'created_at',
                'updated_at',
            ]
        ];
    }


    /**
     * 添加或更新
     * @param $data
     * @return bool
     */
    public function createOrEdit($data) {

        $rs = false;
        unset($data['tagid_list']);
        if (!key_exists(self::formName(), $data)) {
            $data = [self::formName() => $data];
        }
        $this->scenario = self::SCENARIO_CREATE;
        if($this->load($data)) {
            $rs = $this->save();
        }
        return $rs;
    }

}