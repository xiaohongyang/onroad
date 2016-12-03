<?php

use yii\db\Migration;

class m161203_074526_add_column_route_name_and_time_for_table_team extends Migration
{
    public function up()
    {
        $this->addColumn('tq_team', 'route_name', $this->string(100)->notNull()->defaultValue('')->comment('线路名称') );
        $this->addColumn('tq_team', 'clock_time_hour', $this->smallInteger(2)->comment('上班打卡时间小时部分(只在前台列表页显示，不做匹配之用)') );
        $this->addColumn('tq_team', 'clock_time_minutes', $this->smallInteger(2)->comment('上班打卡时间分钟部分(只在前台列表页显示，不做匹配之用)') );
        $this->addColumn('tq_team', 'off_duty_hour', $this->smallInteger(2)->comment('下班打卡时间小时部分(只在前台列表页显示，不做匹配之用)') );
        $this->addColumn('tq_team', 'off_duty_minutes', $this->smallInteger(2)->comment('下班打卡时间分钟部分(只在前台列表页显示，不做匹配之用)') );
        $this->addColumn('tq_team', 'car_type', $this->string(50)->notNull()->defaultValue('')->comment('车型') );
        $this->addColumn('tq_team', 'car_number', $this->string(20)->notNull()->defaultValue('')->comment('车牌') );
    }

    public function down()
    {
        echo "m161203_074526_add_column_route_name_and_time_for_table_team cannot be reverted.\n";
        $this->dropColumn('tq_team', 'route_name');
        $this->dropColumn('tq_team', 'clock_time_hour');
        $this->dropColumn('tq_team', 'clock_time_minutes');
        $this->dropColumn('tq_team', 'off_duty_hour');
        $this->dropColumn('tq_team', 'off_duty_minutes');
        $this->dropColumn('tq_team', 'car_type');
        $this->dropColumn('tq_team', 'car_number');
        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
