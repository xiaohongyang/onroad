<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_info`.
 */
class m161125_132615_create_user_info_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        //用户信息表
        $this->createTable('tq_user_info', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->unique()->comment('用户id'),
            'sex' => $this->smallInteger(1)->notNull()->unsigned()->defaultValue(1)->comment('1男,2女,3未知'),
            'clock_time_hour' => $this->smallInteger(2)->notNull()->unsigned()->defaultValue(0)->comment('上班hour部分'),
            'clock_time_minutes' => $this->smallInteger(2)->notNull()->unsigned()->defaultValue(0)->comment('上班minutes部分'),
            'off_duty_hour' => $this->smallInteger(2)->notNull()->unsigned()->defaultValue(0)->comment('下班hour部分'),
            'off_duty_minutes' => $this->smallInteger(2)->notNull()->unsigned()->defaultValue(0)->comment('下班minutes部分'),
            'home_address' => $this->string(255)->notNull()->defaultValue('')->comment('家庭住址'),
            'home_longitude' => $this->string(100)->notNull()->defaultValue('')->comment('家庭住址经度'),
            'home_latitude' => $this->string(100)->notNull()->defaultValue('')->comment('家庭住址纬度'),
            'company_address' =>  $this->string(255)->notNull()->defaultValue('')->comment('公司地址'),
            'company_longitude' => $this->string(100)->notNull()->defaultValue('')->comment('公司地址经度'),
            'company_latitude' => $this->string(100)->notNull()->defaultValue('')->comment('公司地址纬度'),
            'role' => $this->smallInteger(1)->unsigned()->notNull()->defaultValue(1)->comment('1乘客 2司机'),
            'id_card_front' => $this->string('255')->notNull()->defaultValue('')->comment('身份证正面照片'),
            'id_card_back' => $this->string('255')->notNull()->defaultValue('')->comment('身份证反面照片'),
            'driver_card' => $this->string('255')->notNull()->defaultValue('')->comment('驾驶证照片'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tq_user_info');
    }
}
