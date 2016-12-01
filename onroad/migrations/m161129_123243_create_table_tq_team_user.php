<?php

use yii\db\Migration;

class m161129_123243_create_table_tq_team_user extends Migration
{
    public function up()
    {
        $this->createTable('tq_team_user', [
            'id' => $this->primaryKey(),
            'team_id' => $this->integer()->unsigned()->notNull()->comment('组id'),
            'user_id' => $this->integer()->unsigned()->notNull()->comment('用户id'),
            'created_at' => $this->integer()->unsigned()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer()->unsigned()->notNull()->comment('更新时间')
        ]);
    }

    public function down()
    {
        echo "m161129_123243_create_table_tq_team_user cannot be reverted.\n";
        $this->dropTable('tq_team_user');
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
