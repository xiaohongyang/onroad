<?php

use yii\db\Migration;

class m161126_025731_alter_coloumn_mobile_for_user_table extends Migration
{
    public function up()
    {
        $this->alterColumn('tq_user', 'mobile', $this->string(20)->notNull()->unsigned()->unique()->comment('用户手机'));
    }

    public function down()
    {
        echo "m161126_025731_alter_coloumn_mobile_for_user_table cannot be reverted.\n";
        $this->alterColumn('tq_user', 'mobile', $this->string(20)->notNull()->unsigned()->comment('用户手机'));
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
