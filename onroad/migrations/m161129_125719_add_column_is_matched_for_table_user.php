<?php

use yii\db\Migration;

class m161129_125719_add_column_is_matched_for_table_user extends Migration
{
    public function up()
    {
        $this->addColumn('tq_user', 'is_matched', $this->smallInteger(1)->unsigned()->notNull()->defaultValue(0)->comment('是否已经匹配'));
        $this->addColumn('tq_user', 'login_time', $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('最后一次登录时间'));
    }

    public function down()
    {
        echo "m161129_125719_add_column_is_matched_for_table_user cannot be reverted.\n";
        $this->dropColumn('tq_user', 'is_matched');
        $this->dropColumn('tq_user', 'login_time');
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
