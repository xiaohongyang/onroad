<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2016/11/25
 * Time: 20:46
 */

namespace app\models;


use yii\web\UploadedFile;

class UserInfoModel extends BaseModel
{
    public static function tableName()
    {
        return \Yii::$app->db->tablePrefix.'user_info';
    }

}