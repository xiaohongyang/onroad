<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2016/11/25
 * Time: 20:47
 */

namespace app\models;


use yii\base\Model;
use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord
{

    const SCENARIO_CREATE ='create';
    const SCENARIO_UPDATE ='update';

    const ROLE_PASSENGER = 1;
    const ROLE_DRIVER = 2;

    const CONT_MAX_FAMILY_NUMBER = 4;

    public $message;



    public function create($data){
        $this->setScenario(self::SCENARIO_CREATE);
        if ($this->load($data) && $this->validate()) {
        }
    }

    public static function getDbPrefix(){
        return \Yii::$app->db->tablePrefix;
    }

    public function getConnection(){
         return \Yii::$app->db;
    }


}