<?php
namespace models;


use app\models\MatchModel;
use app\models\UserModel;

class testMatchModelTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testMe()
    {

        $matchModel = new MatchModel();
        $user = UserModel::findOne(['id' => 119]);
        $query = UserModel::find()->where(['>', 'id', 119]);
        $userList = $query->all();
        foreach ($userList as $user02) {
            $rs = $matchModel->matchUser($user, $user02);
            if($rs )
                break;
        }

        $this->assertEquals($rs, true);
    }

    public function testMatchUser(){
        $matchModel = new MatchModel();
        $driver = UserModel::findOne(['id'=>95]);
        $passenger = clone $driver;


        //苏州何山路80号,120.558178,31.312168
        $driver->userInfo->setAttribute('home_longitude', '120.558178');
        $driver->userInfo->setAttribute('home_latitude', '31.312168');
        //苏州何山路50号,120.56711,31.313396
        $passenger->userInfo->setAttribute('home_longitude', '120.56711');
        $passenger->userInfo->setAttribute('home_latitude', '31.313396');

        //苏州何山路80号,120.558178,31.312168
        $driver->userInfo->setAttribute('company_longitude', '120.558178');
        $driver->userInfo->setAttribute('company_latitude', '31.312168');
        //苏州何山路50号,120.56711,31.313396
        $passenger->userInfo->setAttribute('company_longitude', '120.56711');
        $passenger->userInfo->setAttribute('company_latitude', '31.313396');


        $driver->userInfo->setAttribute('clock_time_hour', '07');
        $driver->userInfo->setAttribute('clock_time_minutes', '37');
        $passenger->userInfo->setAttribute('clock_time_hour', '08');
        $passenger->userInfo->setAttribute('clock_time_minutes', '7');

        $driver->userInfo->setAttribute('off_duty_hour', '08');
        $driver->userInfo->setAttribute('off_duty_minutes', '37');
        $passenger->userInfo->setAttribute('off_duty_hour', '08');
        $passenger->userInfo->setAttribute('off_duty_minutes', '7');


        $rs = $matchModel->matchUser($driver, $passenger);
        $this->assertEquals($rs, true);
    }

    public function testIsBeginDistanceOk(){

        /*
        杭州西湖延安路1号,120.170737,30.266971
        苏州何山路1号,120.533644,31.31124
        苏州何山路50号,120.56711,31.313396
        苏州何山路80号,120.558178,31.312168
        苏州何山路100号,120.557633,31.312076
        苏州何山路150号,120.557895,31.312136
        苏州何山路300号,120.534703,31.310643
         */
        $matchModel = new MatchModel();
        $driver = UserModel::findOne(['id'=>97]);
        $passenger = UserModel::findOne(['id' => 106]);

        //苏州何山路1号,120.533644,31.31124
        $driver->userInfo->setAttribute('home_longitude', '120.533644');
        $driver->userInfo->setAttribute('home_latitude', '31.31124');
        //杭州西湖延安路1号,120.170737,30.266971
        $passenger->userInfo->setAttribute('home_longitude', '120.170737');
        $passenger->userInfo->setAttribute('home_latitude', '30.266971');
        $rs = $matchModel->isBeginDistanceOk($driver, $passenger);
        $this->assertEquals($rs, false);

        //苏州何山路80号,120.558178,31.312168
        $driver->userInfo->setAttribute('home_longitude', '120.558178');
        $driver->userInfo->setAttribute('home_latitude', '31.312168');
        //苏州何山路50号,120.56711,31.313396
        $passenger->userInfo->setAttribute('home_longitude', '120.56711');
        $passenger->userInfo->setAttribute('home_latitude', '31.313396');
        $rs = $matchModel->isBeginDistanceOk($driver, $passenger);
        $this->assertEquals($rs, true);
    }

    public function testIsEndDistanceOk(){

        /*
        杭州西湖延安路1号,120.170737,30.266971
        苏州何山路1号,120.533644,31.31124
        苏州何山路50号,120.56711,31.313396
        苏州何山路80号,120.558178,31.312168
        苏州何山路100号,120.557633,31.312076
        苏州何山路150号,120.557895,31.312136
        苏州何山路300号,120.534703,31.310643
         */
        $matchModel = new MatchModel();
        $driver = UserModel::findOne(['id'=>97]);
        $passenger = UserModel::findOne(['id' => 106]);

        //苏州何山路1号,120.533644,31.31124
        $driver->userInfo->setAttribute('company_longitude', '120.533644');
        $driver->userInfo->setAttribute('company_latitude', '31.31124');
        //杭州西湖延安路1号,120.170737,30.266971
        $passenger->userInfo->setAttribute('company_longitude', '120.170737');
        $passenger->userInfo->setAttribute('company_latitude', '30.266971');
        $rs = $matchModel->isEndDistanceOk($driver, $passenger);
        $this->assertEquals($rs, false);

        //苏州何山路80号,120.558178,31.312168
        $driver->userInfo->setAttribute('company_longitude', '120.558178');
        $driver->userInfo->setAttribute('company_latitude', '31.312168');
        //苏州何山路50号,120.56711,31.313396
        $passenger->userInfo->setAttribute('company_longitude', '120.56711');
        $passenger->userInfo->setAttribute('company_latitude', '31.313396');
        $rs = $matchModel->isEndDistanceOk($driver, $passenger);
        $this->assertEquals($rs, true);
    }

    public function testIsTimeClockOk(){
        //判断 双方的“上班”时间是否一致或比司机晚30分钟

        //1.乘客比司机晚30分钟
        $matchModel = new MatchModel();
        $driver = UserModel::findOne(['id'=>97]);
        $driver->userInfo->setAttribute('clock_time_hour', '07');
        $driver->userInfo->setAttribute('clock_time_minutes', '37');

        $passenger = UserModel::findOne(['id' => 106]);
        $passenger->userInfo->setAttribute('clock_time_hour', '08');
        $passenger->userInfo->setAttribute('clock_time_minutes', '7');
        $rs1 = $rs = $matchModel->isTimeClockOk($driver, $passenger);
        $this->assertEquals($rs1, true);

        //比司机晚小于30分钟
        $driver->userInfo->setAttribute('clock_time_hour', '07');
        $driver->userInfo->setAttribute('clock_time_minutes', '37');
        $passenger->userInfo->setAttribute('clock_time_hour', '08');
        $passenger->userInfo->setAttribute('clock_time_minutes', '6');
        $rs2 = $matchModel->isTimeClockOk($driver, $passenger);  //false
        $this->assertEquals($rs2, false);

        //和司机上班时间一致
        $driver->userInfo->setAttribute('clock_time_hour', '07');
        $driver->userInfo->setAttribute('clock_time_minutes', '37');
        $passenger->userInfo->setAttribute('clock_time_hour', '07');
        $passenger->userInfo->setAttribute('clock_time_minutes', '37');
        $rs3 = $matchModel->isTimeClockOk($driver, $passenger);  //false
        $this->assertEquals($rs3, true);
    }

    public function testIsOffDutyTimeOk(){
        //判断 双方的“上班”时间是否一致或比司机晚30分钟

        //乘客比司机早30分钟
        $matchModel = new MatchModel();
        $driver = UserModel::findOne(['id'=>97]);
        $driver->userInfo->setAttribute('off_duty_hour', '08');
        $driver->userInfo->setAttribute('off_duty_minutes', '37');
        $passenger = UserModel::findOne(['id' => 106]);
        $passenger->userInfo->setAttribute('off_duty_hour', '08');
        $passenger->userInfo->setAttribute('off_duty_minutes', '7');
        $rs1 = $rs = $matchModel->isOffDutyClockOk($driver, $passenger);
        $this->assertEquals($rs1, true);

        //和司机上班时间一致
        $driver->userInfo->setAttribute('off_duty_hour', '07');
        $driver->userInfo->setAttribute('off_duty_minutes', '37');
        $passenger->userInfo->setAttribute('off_duty_hour', '07');
        $passenger->userInfo->setAttribute('off_duty_minutes', '37');
        $rs3 = $matchModel->isOffDutyClockOk($driver, $passenger);  //false
        $this->assertEquals($rs3, true);

        //乘客比司机早20分钟
        $matchModel = new MatchModel();
        $driver->userInfo->setAttribute('off_duty_hour', '08');
        $driver->userInfo->setAttribute('off_duty_minutes', '37');
        $passenger->userInfo->setAttribute('off_duty_hour', '08');
        $passenger->userInfo->setAttribute('off_duty_minutes', '17');
        $rs1 = $rs = $matchModel->isOffDutyClockOk($driver, $passenger);
        $this->assertEquals($rs1, false);

        //比司机晚
        $driver->userInfo->setAttribute('off_duty_hour', '07');
        $driver->userInfo->setAttribute('off_duty_minutes', '37');
        $passenger->userInfo->setAttribute('off_duty_hour', '08');
        $passenger->userInfo->setAttribute('off_duty_minutes', '6');
        $rs2 = $matchModel->isOffDutyClockOk($driver, $passenger);  //false
        $this->assertEquals($rs2, false);
    }
}