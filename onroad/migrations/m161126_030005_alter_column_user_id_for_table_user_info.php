<?php

use yii\db\Migration;

class m161126_030005_alter_column_user_id_for_table_user_info extends Migration
{
    public function up()
    {
        $this->alterColumn('tq_user_info', 'user_id', $this->integer()->notNull()->unsigned()->unique()->comment('用户表id'));
    }

    public function down()
    {
        echo "m161126_030005_alter_column_user_id_for_table_user_info cannot be reverted.\n";
        $this->alterColumn('tq_user_info', 'user_id', $this->integer()->notNull()->unsigned()->comment('用户表id'));
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
