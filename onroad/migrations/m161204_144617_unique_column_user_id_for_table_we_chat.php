<?php

use yii\db\Migration;

class m161204_144617_unique_column_user_id_for_table_we_chat extends Migration
{
    public function up()
    {
        $this->alterColumn('tq_we_chat', 'user_id', $this->integer()->unsigned()->notNull()->comment('用户id')->unique());
    }

    public function down()
    {
        echo "m161204_144617_unique_column_user_id_for_table_we_chat cannot be reverted.\n";
        $this->alterColumn('tq_we_chat', 'user_id', $this->integer()->unsigned()->notNull()->comment('用户id'));
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
