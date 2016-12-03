<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2016/12/3
 * Time: 15:59
 */

namespace app\models;


class TeamUpdateForm extends BaseModel
{

    public $routeName;
    public $clockTimeHour;
    public $clockTimeMinutes;
    public $offDutyHour;
    public $offDutyMinutes;

    public function scenarios()
    {
        return [
            self::SCENARIO_UPDATE => [
                'routeName','clockTimeHour','clockTimeMinutes','offDutyHour','offDutyMinutes',
            ]
        ];
    }

    public static function tableName()
    {
        return parent::getDbPrefix() . 'team';
    }


    public function rules()
    {
        return [
            [
                ['clockTimeHour','clockTimeMinutes','offDutyHour','offDutyMinutes'], 'required', 'on' => self::SCENARIO_UPDATE
            ],
            [   'routeName' ,'required', 'on'=>self::SCENARIO_UPDATE, 'message' => '线路名称不能为空' ]
        ];
    }

    /**
     * 更新 线路名称、上班时间、下班时间
     * @param $data
     * @return bool
     */
    public function edit($data) {

        $rs = false;
        $this->setScenario(self::SCENARIO_UPDATE);

        if (!key_exists(self::formName(), $data)) {
            $data = [self::formName() => $data] ;
        }

        if($this->load($data) && $this->validate()) {

            $this->setAttribute('route_name', $this->routeName);
            $this->setAttribute('clock_time_hour', $this->clockTimeHour);
            $this->setAttribute('clock_time_minutes', $this->clockTimeMinutes);
            $this->setAttribute('off_duty_hour', $this->offDutyHour);
            $this->setAttribute('off_duty_minutes', $this->offDutyMinutes);
            $rs = $this->save();
        }
        return $rs;
    }

}