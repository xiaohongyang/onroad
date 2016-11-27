<?php

use yii\db\Migration;

class m161126_112817_add_column_timeliness_for_table_user_info extends Migration
{
    public function up()
    {
        $this->addColumn('tq_user_info', 'timeliness', $this->smallInteger(1)->unsigned()->notNull()->defaultValue(1)->comment('时效性 1准时, 2一般, 3不准时'));
    }

    public function down()
    {
        echo "m161126_112817_add_column_timeliness_for_table_user_info cannot be reverted.\n";
        $this->dropColumn('tq_user_info', 'timeliness');
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
