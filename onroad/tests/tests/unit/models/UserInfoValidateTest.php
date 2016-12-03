<?php
namespace models;


use app\models\UserInfoModel;
use app\models\UserModel;

class UserInfoValidateTest extends \Codeception\Test\Unit
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
        $this->testBatchSetHomeAddressInfo();
    }

    public function testSetHomeAddressInfo()
    {
        $userId = 106;
        $model = UserInfoModel::findOne(['user_id' => $userId]);
        $address = '苏州何山路大润发';
        $longitude = '120.570323';
        $latitude = '31.313036';
        $rs = $model->setHomeAddressInfo($address, $longitude, $latitude);
        $info = $rs ? "ok" : $model->getFirstErrors();
        $this->assertEquals($rs, true, $info);
    }

    public function testBatchSetHomeAddressInfo()
    {

        $rs = true;

        $info = "";


        $userList = UserModel::find()->where(['>','id',0])->all();


        if (is_array($userList) && count($userList)) {

            $userCount = count($userList);
            $userIndex = 0;


            $mapFile = dirname(__FILE__) . "/map.txt";
            try {
                $mapTxt = file($mapFile);
                if (is_array($mapTxt) && count($mapTxt)) {
                    foreach ($mapTxt as $line) {

                        if ($userIndex > $userCount-1) {
                            breakk;
                        }

                        $line = str_replace("\r\n", "", $line);
                        $data = explode(',', $line);
                        $user = $userList[$userIndex];

                        if ($user instanceof UserModel && !is_null($user->userInfo) && $user->userInfo instanceof UserInfoModel) {
                            $userInfo = $user->userInfo;
                            if ($userInfo instanceof UserInfoModel) {

                                $address = $data[0];
                                $longitude = $data[1];
                                $latitude = $data[2];
                                $rs = $userInfo->setHomeAddressInfo($address, $longitude, $latitude);

                                if(!$rs){
                                    $info = "设置失败";
                                    break;
                                }
                            }
                            $userIndex++;
                        }
                    }
                }
            } catch (Exception $e) {
                $info = $e->getMessage();
            }
        }

        $this->assertEquals($rs, true, $info);
    }


}