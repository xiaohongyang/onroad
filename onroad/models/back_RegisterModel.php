<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2016/11/25
 * Time: 20:46
 */

namespace app\models;


use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;
use yii\log\Logger;
use yii\web\UploadedFile;

class RegisterUserInfoModel extends BaseModel
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className()
            ]
        ];
    }

    public function getUser(){
        return $this->hasOne(UserModel::className(), [
            'id' => 'user_id'
        ]);
    }

    public static function tableName()
    {
        return \Yii::$app->db->tablePrefix.'user_info';
    }

    public function formName()
    {
        return \Yii::$app->db->tablePrefix.'user_info';
    }


    public $mobile;

    public $userId;
    public $sex;
    public $clockTime;
    public $offDutyTime;
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
                'mobile',
                'sex',
                'clockTime',
                'offDutyTime',
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


    public function rules(){

        $rules = [
            [['sex',
                'homeAddress', 'homeLongitude', 'homeLatitude', 'companyAddress', 'companyLongitude', 'companyLatitude',
                'role','timeliness'], 'required', 'on' => self::SCENARIO_CREATE],
            [
                'mobile', 'required', 'on' => self::SCENARIO_CREATE, 'message' => '请输入手机号'
            ],[
                'clockTime', 'required', 'on' => self::SCENARIO_CREATE, 'message' => '请填打卡时间'
            ],[
                'offDutyTime', 'required', 'on' => self::SCENARIO_CREATE, 'message' => '请填下班时间'
            ],
            [
                'mobile', 'unique', 'on'=>self::SCENARIO_CREATE, 'message' => '手机号已被注册'
            ],
            [
                'mobile',function($attribute, $params){
                    if(!preg_match('#[0-9]{11}#', $this->$attribute)){
                        $this->addError($attribute, '手机号不合法');
                    }
                }, 'on' => self::SCENARIO_CREATE
            ],

        ];

        return $rules;
    }

    public function attributeLabels($attribute)
    {
        return [
            'mobile' => '手机号码',
            'sex' => '性别',
            'clockTime' => '上班时间',
            'offDutyTime' => '下班时间',
            'homeAddress' => '家庭住址',
            'homeLongitude' => '家庭住址经度',
            'homeLatitude' => '家庭住址纬度',
            'companyAddress' => '公司地址',
            'companyLongitude' => '公司地址经度',
            'companyLatitude' => '公司地址纬度',
            'role' => '角色'
        ];
    }


    /**
     * 创建用户, 用户表增加一条记录，用户信息表也增加一条记录
     * @param $data
     * @return bool
     */
    public function create($data){

        $rs = false;
        $this->setScenario(self::SCENARIO_CREATE);

        if (!key_exists(self::formName(), $data)) {
            $data = [self::formName() => $data];
        }

        if ( $this->load($data) && $this->validate()) {

            $this->setAttribute('mobile', $this->mobile);
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                $rs = $this->save();
                if($rs){
                    $transaction->commit();
                } else {
                    $transaction->rollBack();
                    \Yii::$app->log->getLogger()->log("添加用户失败!");
                }
            } catch (Exception $e) {
                \Yii::getLogger()->log($e->getMessage(),Logger::LEVEL_ERROR);
                $transaction->rollBack();
            }
        }
        return $rs;
    }


    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {

            if($this->role == self::ROLE_DRIVER){
                $this->upload();
                if(is_array($this->getFirstErrors()) && count($this->getFirstErrors())>0){
                    throw new Exception("添加用户信息表记录失败.error:".implode('|', $this->getFirstErrors()));
                }
            }

            $model = new UserInfoForm();
            $clockTimeArr = explode(':', $this->clockTime);
            list($clockTimeHour, $clockTimeMinutes) = $clockTimeArr;

            $offDutyTimeArr = explode(':', $this->offDutyTime);
            list($offDutyTimeHour, $offDutyTimeMinutes) = $offDutyTimeArr;

            $data = [
                'userId' => $this->id,
                'sex' => $this->sex,
                'clockTimeHour' => $clockTimeHour,
                'clockTimeMinutes' => $clockTimeMinutes,
                'offDutyHour' => $offDutyTimeHour,
                'offDutyMinutes' => $offDutyTimeMinutes,
                'homeAddress' => $this->homeAddress,
                'homeLongitude' => $this->homeLongitude,
                'homeLatitude' => $this->homeLatitude,
                'companyAddress' => $this->companyAddress,
                'companyLongitude' => $this->companyLongitude,
                'companyLatitude' => $this->companyLatitude,
                'role' => $this->role,
                'idCardFront' => $this->idCardFront,
                'idCardBack' => $this->idCardBack,
                'driverCard' => $this->driverCard,
                'timeliness' => $this->timeliness,
            ];

            $rs = $model->create($data);
            if (!$rs) {
                throw new Exception("添加用户信息表记录失败.error:".implode('|', $model->getFirstErrors()));
            }
        }

        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    public function upload()
    {
        try {
            $dir = 'uploads/'.$this->id;
            if(!file_exists($dir)){
                mkdir($dir, 0777, true );
            }

            $op = UploadedFile::getInstance($this, 'idCardFront');
            $saveFilePath = 'uploads/'.$this->id.'/idCardFront'.'.'.$op->extension;
            $this->_uploadHandle($op, 'idCardFront', $saveFilePath);

            $op = UploadedFile::getInstance($this, 'idCardBack');
            $saveFilePath = 'uploads/'.$this->id.'/idCardBack'.'.'.$op->extension;
            $this->_uploadHandle($op, 'idCardBack', $saveFilePath);

            $op = UploadedFile::getInstance($this, 'driverCard');
            $saveFilePath = 'uploads/'.$this->id.'/driverCard'.'.'.$op->extension;
            $this->_uploadHandle($op, 'driverCard', $saveFilePath);

            if(is_array($this->getFirstErrors()) && count($this->getFirstErrors())){
                //删除注册失败的文件夹
                FileHelper::removeDirectory($dir);
            }
        } catch (Exception $e) {
            \Yii::getLogger()->log($e->getMessage());
            $this->addError('idCardFront', '上传失败');
        }

    }

    private function _uploadHandle($handle, $field, $saveFilePath, $extension){
        if(is_null($handle)) {
            $this->addError($field, '请上传文件');
        }else if(!in_array($handle->extension, ['jpg', 'png'])){
            $this->addError($field, '文件类型不合法');
        } else if(!$handle->saveAs($saveFilePath)){
            $this->addError($field, '上传失败');
        } else {
            $this->$field = $saveFilePath;
        }
    }

}