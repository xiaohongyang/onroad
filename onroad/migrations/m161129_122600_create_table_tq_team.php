<?php

use yii\db\Migration;

class m161129_122600_create_table_tq_team extends Migration
{
    public function up()
    {
        $this->createTable('tq_team', [
            'team_id' => $this->primaryKey()->comment('主键'),
            'family_number' => $this->smallInteger(2)->unsigned()->notNull()->defaultValue(0)->comment('当前成员数量'),
            'driver_user_id' => $this->integer()->unsigned()->notNull()->comment('司机user_id'),
            'created_at' => $this->integer()->unsigned()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer()->unsigned()->notNull()->comment('更新时间')
        ]);
    }

    public function down()
    {
        echo "m161129_122600_create_table_tq_team cannot be reverted.\n";
        $this->dropTable('tq_team');
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
