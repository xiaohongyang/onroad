<?php

use yii\db\Migration;

class m161204_134630_add_column_open_id_for_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('tq_user', 'open_id', $this->string(50)->notNull()->defaultValue('')->comment('微信open_id'));
    }

    public function down()
    {
        echo "m161204_134630_add_column_open_id_for_user_table cannot be reverted.\n";
        $this->dropColumn('tq_user', 'open_id');
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
