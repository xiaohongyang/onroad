<?php

use yii\db\Migration;

class m161125_161306_set_default_value_for_password_colomn_in_user_table extends Migration
{
    public function up()
    {
        $this->alterColumn('tq_user','password' , $this->string(255)->notNull()->defaultValue('') );

    }

    public function down()
    {
        echo "m161125_161306_set_default_value_for_password_colomn_in_user_table cannot be reverted.\n";
        $this->alterColumn('tq_user','password' , $this->string(255)->notNull());
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
