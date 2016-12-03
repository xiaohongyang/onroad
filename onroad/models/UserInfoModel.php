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


    /**
     * 更新home_address 和 home经纬度
     * @param $homeAddress
     * @param $longitude
     * @param $latitude
     * @return bool
     */
    public function setHomeAddressInfo($homeAddress, $longitude, $latitude){

        $this->setAttribute('home_address', $homeAddress);
        $this->setAttribute('home_longitude', $longitude);
        $this->setAttribute('home_latitude', $latitude);
        return $this->save();
    }

    /**
     * 更新company_address 和 company经纬度
     * @param $companyAddress
     * @param $longitude
     * @param $latitude
     * @return bool
     */
    public function setCompanyAddressInfo($companyAddress, $longitude, $latitude){

        $this->setAttribute('company_address', $companyAddress);
        $this->setAttribute('company_longitude', $longitude);
        $this->setAttribute('company_latitude', $latitude);

        return $this->save();
    }





    public function getHomeLongitude() {
        return $this->getAttribute('home_longitude');
    }

    public function getHomeLatitude() {
        return $this->getAttribute('home_latitude');
    }

    public function getCompanyLongitude() {
        return $this->getAttribute('company_longitude');
    }

    public function getCompanyLatitude() {
        return $this->getAttribute('company_latitude');
    }

    public function getClockTimeMinutes() {
        if(!is_numeric($this->getAttribute('clock_time_hour')) || !is_numeric($this->getAttribute('clock_time_minutes')))
            return 0;
        return intval($this->getAttribute('clock_time_hour')) * 60 + intval($this->getAttribute('clock_time_minutes'));
    }

    public function getOffDutyMinutes() {
        if(!is_numeric($this->getAttribute('off_duty_hour')) || !is_numeric($this->getAttribute('off_duty_minutes')))
            return 0;
        return intval($this->getAttribute('off_duty_hour')) * 60 + intval($this->getAttribute('off_duty_minutes'));
    }
}