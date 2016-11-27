<?php

use yii\db\Migration;

class m161125_143842_alter_column_for_table_user extends Migration
{
    public function up()
    {
        $this->alterColumn('tq_user', 'username',  $this->string(50)->notNull()->defaultValue('')->comment('用户名'));
    }

    public function down()
    {
        echo "m161125_143842_alter_column_for_table_user cannot be reverted.\n";
        $this->alterColumn('tq_user', 'username', $this->string(50)->notNull()->comment('用户名'));
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
