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


    /*'userId',
    'sex',
    'clock_time_hour',
    'clock_time_minutes',
    'off_duty_hour',
    'off_duty_minutes',
    'home_address',
    'home_longitude',
    'home_latitude',
    'role',
    'id_card_front',
    'id_card_back',
    'driver_card',*/

    public $userId;
    public $sex;
    public $clockTimeHour;
    public $clockTimeMinutes;
    public $offDutyHour;
    public $offDutyMinutes;
    public $homeAddress;
    public $homeLongitude;
    public $homeLatitude;
    public $companyAddress;
    public $companyLongitude;
    public $companyLatitude;
    public $role;
    public $idCardFront;
    public $idCardBack;
    public $driverCard;
    public $timeliness;


    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => [
                'userId',
                'sex',
                'clockTimeHour',
                'clockTimeMinutes',
                'offDutyHour',
                'offDutyMinutes',
                'homeAddress',
                'homeLongitude',
                'homeLatitude',
                'companyAddress',
                'companyLongitude',
                'companyLatitude',
                'role',
                'idCardFront',
                'idCardBack',
                'driverCard',
                'timeliness',
            ]
        ];
    }


    public function rules()
    {

        return [
            [[
                'userId',
                'sex',
                'clockTimeHour',
                'clockTimeMinutes',
                'offDutyHour',
                'offDutyMinutes',
                'homeAddress',
                'homeLongitude',
                'homeLatitude',
                'companyAddress',
                'companyLongitude',
                'companyLatitude',
                'role',
                'timeliness',
            ], 'required', 'on' => self::SCENARIO_CREATE],
            ['userId', function($attribute, $params) {
                if($this->attributes) {
                   if (UserInfoModel::findOne(['user_id'=>$this->$attribute]) ){
                       $this->addError($attribute, '用户已经存在');
                   }
                }
            }],
            ['idCardFront', function ($attribute, $params) {
                if ($this->role == self::ROLE_DRIVER && empty($this->$attribute)) {
                    $this->addError($attribute, '身份证正面图片不能为空');
                }
            }, 'on' => self::SCENARIO_CREATE],
            ['idCardBack', function ($attribute, $params) {
                if ($this->role == self::ROLE_DRIVER && empty($this->$attribute)) {
                    $this->addError($attribute, '身份证反面图片不能为空');
                }
            }, 'on' => self::SCENARIO_CREATE],
            ['driverCard', function ($attribute, $params) {
                if ($this->role == self::ROLE_DRIVER && empty($this->$attribute)) {
                    $this->addError($attribute, '驾驶证图片不能为空');
                }
            }, 'on' => self::SCENARIO_CREATE]
        ];
    }

    public function attributeLabels($attribute)
    {
        return [
            'userId' => '用户id',
            'sex' => '性别',
            'clockTimeHour' => '上班时间hour',
            'clockTimeMinutes' => '上班时间minutes',
            'offDutyHour' => '下班时间hour',
            'offDutyMinutes' => '下班时间minutes',
            'homeAddress' => '家庭住址',
            'homeLongitude' => '家庭住址经度',
            'homeLatitude' => '家庭住址纬度',
            'companyAddress' => '公司地址',
            'companyLongitude' => '公司地址经度',
            'companyLatitude' => '公司地址纬度',
            'role' => '角色'
        ];
    }



    public function create($data){

        $rs = false;
        $this->setScenario(self::SCENARIO_CREATE);
//        if (!key_exists(self::formName(), $data)) {
//            $data = [self::formName() => $data];
//        }
        $this->setAttributes($data);
        if ($this->validate()) {

            $transaction = \Yii::$app->db->beginTransaction();
            try {
                $this->setAttribute('user_id', $this->userId);
                $this->setAttribute('sex', $this->sex);
                $this->setAttribute('clock_time_hour', $this->clockTimeHour);
                $this->setAttribute('clock_time_minutes', $this->clockTimeMinutes);
                $this->setAttribute('off_duty_hour', $this->offDutyHour);
                $this->setAttribute('off_duty_minutes', $this->offDutyMinutes);
                $this->setAttribute('home_address', $this->homeAddress);
                $this->setAttribute('home_longitude', $this->homeLongitude);
                $this->setAttribute('home_latitude', $this->homeLatitude);
                $this->setAttribute('company_address', $this->companyAddress);
                $this->setAttribute('company_longitude', $this->companyLongitude);
                $this->setAttribute('company_latitude', $this->companyLatitude);
                $this->setAttribute('role', $this->role);
                $this->setAttribute('id_card_front', is_null($this->idCardFront)?'':$this->idCardFront);
                $this->setAttribute('id_card_back', is_null($this->idCardBack)?'':$this->idCardBack);
                $this->setAttribute('driver_card', is_null($this->driverCard)?'':$this->driverCard);
                $this->setAttribute('timeliness', $this->timeliness);

                $rs = $this->save();
                if($rs){
                    $transaction->commit();
                } else {
                    $transaction->rollBack();
                }
            } catch (Exception $e) {
                \Yii::getLogger()->log($e->getMessage().'用户信息表记录添加异常',Logger::LEVEL_ERROR);
            }
        }
        return $rs;
    }



}