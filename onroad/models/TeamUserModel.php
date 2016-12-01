<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2016/11/29
 * Time: 20:40
 */

namespace app\models;


use yii\behaviors\TimestampBehavior;

class TeamUserModel extends BaseModel
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
        return parent::getDbPrefix() . 'team_user';
    }

    public function getTeam(){
        return $this->hasOne(TeamModel::className(), [
            'team_id' => 'team_id'
        ]);
    }

    public function getUser(){
        return $this->hasOne(UserIdentity::className(), [
            'id' => 'user_id'
        ]);
    }

}