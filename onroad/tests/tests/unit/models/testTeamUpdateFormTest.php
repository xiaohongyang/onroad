<?php
namespace models;


use app\models\TeamUpdateForm;

class testTeamUpdateFormTest extends \Codeception\Test\Unit
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
        $teamUpdateForm = TeamUpdateForm::findOne(['team_id' => 22]);
        $data = [
            'routeName' => 'test',
            'clockTimeHour' => 03,
            'clockTimeMinutes' => 04,
            'offDutyHour' => 03,
            'offDutyMinutes' => 04
        ];

        $rs = $teamUpdateForm->edit($data);

        $this->assertEquals($rs, true, implode(',',  $teamUpdateForm->getFirstErrors()));
    }
}