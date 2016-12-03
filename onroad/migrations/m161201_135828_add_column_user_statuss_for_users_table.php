<?php

use yii\db\Migration;

class m161201_135828_add_column_user_statuss_for_users_table extends Migration
{
    public function up()
    {
        $this->addColumn('tq_user', 'user_status', $this->smallInteger(1)->unsigned()->notNull()->defaultValue(0)->comment('用户状态0未审核,1审核通过,2审核未通过,3已删除') );
    }

    public function down()
    {
        echo "m161201_135828_add_column_user_statuss_for_users_table cannot be reverted.\n";
        $this->dropColumn('tq_user', 'user_status');
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
