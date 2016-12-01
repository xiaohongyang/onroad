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
    public static function tableName()
    {
        return parent::getDbPrefix() . 'user';
    }

    public function getHomeLongitude() {
        return $this->home_longitude;
    }

    public function getHomeLatitude() {
        return $this->home_latitude;
    }

    public function getCompanyLongitude() {
        return $this->company_longitude;
    }

    public function getCompanyLatitude() {
        return $this->company_latitude;
    }

    public function _getClockTimeMinutes() {
        return $this->clock_time_hour * 60 + $this->clock_time_minutes;
    }

    public function _getOffDutyMinutes() {
        return $this->off_duty_hour * 60 + $this->off_duty_minutes;
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

}