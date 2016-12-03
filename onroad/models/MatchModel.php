<?php
/**
 * 匹配规则类
 * 1. 用户与通勤小组的匹配
 * 2. 用户与用户的匹配
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2016/11/28
 * Time: 17:10
 * @author Foo Bar <foo.bar@email.com>
 */

namespace app\models;


use app\common\components\helpers\MapHelper;

class MatchModel extends BaseModel
{

    /**
     * 获取起点距离限制
     * 暂用常量，后期改为数据库配置
     * @return int
     */
    public static function getBeginDistanceLimit(){
        return 1000;
    }

    /**
     * 获取终点距离限制
     * 暂用常量，后期改为数据库配置
     * @return int
     */
    public static function getEndDistanceLimit(){
        return 1000;
    }

    /**
     * 上班时间限制
     * 暂用常量 ，后期改为数据库配置
     * @return int
     */
    public static function getClockTimeMinutesLimit(){
        return 30;
    }

    /**
     * 下班时间限制
     * 暂用常量 ，后期改为数据库配置
     * @return int
     */
    public static function getOffDutyMinutesLimit(){
        return 30;
    }

    /**
     * 对用户进行匹配 1.用户与组的匹配  2.用户与用户的匹配
     * @param $user
     * @return bool
     */
    public function match(UserModel $user){

        $rs = false;
        if($user->getUserStatus() != UserModel::CONST_STATUS_VALIDATE_SUCCESS) {
            $this->message = "当前用户数据不完整,请先完善用户数据";
        } else if($user->getAttribute('is_matched')){
            $this->message = "当前用户已经匹配成功，不能重复进行匹配";
        } else {
            $rs = $this->traversalMatchTeam($user);
            if (!$rs) {
                $rs = $this->traversalMatchUser($user);
            }
        }
        return $rs;
    }

    /**
     * @param $user
     * @return bool
     * “通勤小组”表匹配流程
     * 读取所有还有余位的通勤小组
     * 遍历通勤小组
     * 与司机起点是否相距“1公里内”
     * 与司机终点是否相距“1公里内”
     * 双方的“上班”时间是否一致或比司机晚30分钟
     * 双方的“下班”时间是否一致或比司机早30分钟
     */
    public function traversalMatchTeam(UserModel $user) {

        $result = false;
        $matchTeams = TeamModel::find()->where(['<', 'family_number', self::CONT_MAX_FAMILY_NUMBER])->all();
        if (is_array($matchTeams) && count($matchTeams)) {
            foreach ($matchTeams as $team) {

                $team = TeamModel::findOne(['team_id' => $team->team_id]);
                if ($team->family_number < 4) {

                    $driver = $team->driver;
                    //判断乘客与司机是否匹配
                    if(!is_null($driver) && $driver instanceof UserModel && $this->matchUser($driver, $user)) {
                        if ($team->addUser($user)) {
                            $result = true;
                            break;
                        }
                    }
                }
            }
        }
        return $result;
    }

    /**
     * 遍历用户表进行匹配, 匹配成功则终止遍历
     * @param UserModel $user
     * @return bool
     */
    public function traversalMatchUser(UserModel $user) {

        $rs = false;
        $isDriver = $user->userInfo->getAttribute('role') == BaseModel::ROLE_DRIVER;
        $query = UserModel::find();
        $query->where(['is_matched' => 0]);
        $query->where(['<>', 'id', $user->getAttributeHint('id')]);
        if (! $isDriver) {
            //乘客只能和司机匹配
            $query->andWhere(['in','id' , UserInfoModel::find()->where(['role'=>BaseModel::ROLE_DRIVER])->select('user_id')]);
        }
        $userList = $query->all();

        if (is_array($userList) && count($userList)) {
            $team = new TeamModel();
            foreach ($userList as $matchUser) {
                if(! $isDriver && $this->matchUser($matchUser, $user)) {
                    $rs = $team->create($matchUser, $user);
                } else if($this->matchUser($user, $matchUser)){
                    $rs = $team->create($user, $matchUser);
                }
                if($rs)
                    break;  //获取成功，停止继续匹配
            }
        }
        return $rs;
    }

    /**
     *  乘客与司机是否匹配
     *  与司机起点是否相距“1公里内”
     *  与司机终点是否相距“1公里内”
     *  双方的“上班”时间是否一致或比司机晚30分钟
     *  双方的“下班”时间是否一致或比司机早30分钟
     * @param UserModel $driver
     * @param UserModel $passenger
     * @return bool
     */
    public function matchUser(UserModel $driver, UserModel $passenger) {

        $result = true;
        if(!$driver->userInfo || !$passenger->userInfo){
            $result = false;
        } else if (! $this->isBeginDistanceOk($driver, $passenger) ){
            $result = false;
        } else if (! $this->isEndDistanceOk($driver, $passenger)) {
            $result = false;
        } else if (! $this->isTimeClockOk($driver, $passenger)) {
            $result = false;
        } else if (! $this->isOffDutyClockOk($driver, $passenger)) {
            $result = false;
        }
        return $result;
    }


    #region 匹配规则
    /**
     * 判断乘客与司机起点是否符合要求
     * @param UserModel $driver
     * @param UserModel $passanger
     * @return bool
     */
    public function isBeginDistanceOk(UserModel $driver, UserModel $passenger) {

        $lng1 = $driver->userInfo->getHomeLongitude();
        $lat1 = $driver->userInfo->getHomeLatitude();

        $lng2 = $passenger->userInfo->getHomeLongitude();
        $lat2 = $passenger->userInfo->getHomeLatitude();

        if(!($lng1 && $lat1 && $lng2 && $lat2)) {
            //经纬度不存在,匹配失败
            return false;
        }
        $distance = MapHelper::getdistance($lng1, $lat1, $lng2, $lat2);
        $rs =  abs($distance) <= self::getBeginDistanceLimit();
        return $rs;
    }

    /**
     * 判断乘客与司机终点是否符合要求
     * @param UserModel $driver
     * @param UserModel $passenger
     * @return bool
     */
    public function isEndDistanceOk(UserModel $driver, UserModel $passenger) {

        $lng1 = $driver->userInfo->getCompanyLongitude();
        $lat1 = $driver->userInfo->getCompanyLatitude();

        $lng2 = $passenger->userInfo->getCompanyLongitude();
        $lat2 = $passenger->userInfo->getCompanyLatitude();

        if(!($lng1 && $lat1 && $lng2 && $lat2)) {
            //经纬度不存在,匹配失败
            return false;
        } else {
            $distance = MapHelper::getdistance($lng1, $lat1, $lng2, $lat2);
            $rs = abs($distance) <= self::getBeginDistanceLimit();
            return $rs;
        }
    }

    /**
     * 判断乘客与司机的上班时间是否符合要求,双方的“上班”时间是否一致或比司机晚30分钟
     * @param UserModel $driver
     * @param UserModel $passenger
     * @return bool
     */
    public function isTimeClockOk(UserModel $driver, UserModel $passenger) {

        $driverInfoModel = $driver->userInfo;
        $passengerInfoModel = $passenger->userInfo;

        if(!$driverInfoModel instanceof UserInfoModel || !$passengerInfoModel instanceof UserInfoModel)
            return false;
        $driverClockTime = $driverInfoModel->getClockTimeMinutes();
        $passengerClockTime = $passengerInfoModel->getClockTimeMinutes();

        $diffTime = $passengerClockTime - $driverClockTime;
        $rs = $diffTime >= self::getClockTimeMinutesLimit() || $diffTime == 0;

        return $rs;
    }

    /**
     * 判断乘客与司机的下班时间是否符合要求, 双方的“下班”时间是否一致或比司机早30分钟
     * @param UserModel $driver
     * @param UserModel $passenger
     * @return bool
     */
    public function isOffDutyClockOk(UserModel $driver, UserModel $passenger) {

        $driverInfoModel = $driver->userInfo;
        $passengerInfoModel = $passenger->userInfo;

        if(!$driverInfoModel instanceof UserInfoModel || !$passengerInfoModel instanceof UserInfoModel)
            return false;
        $driverOffDuty = $driverInfoModel->getOffDutyMinutes();
        $passengerOffDuty = $passengerInfoModel->getOffDutyMinutes();

        $diffTime = $driverOffDuty - $passengerOffDuty;
        $rs = $diffTime >= self::getOffDutyMinutesLimit() || $diffTime == 0;

        return $rs;
    }
    #endregion
}