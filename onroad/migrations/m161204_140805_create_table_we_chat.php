<?php

use yii\db\Migration;

class m161204_140805_create_table_we_chat extends Migration
{
    public function up()
    {
        $this->createTable('tq_we_chat', [
            'id' => $this->primaryKey()->comment('主键'),
            'user_id' => $this->integer()->unsigned()->notNull()->comment('用户id'),
            'openid' => $this->string(50)->notNull()->comment('用户id'),
            'nickname' => $this->string(50)->notNull()->defaultValue('')->comment('昵称'),
            'sex' => $this->smallInteger(1)->comment('性别'),
            'language' => $this->string(30)->comment('语言'),
            'city' => $this ->string(30)->comment('城市'),
            'province' => $this ->string(30)->comment('省分'),
            'country' => $this ->string(30)->comment('国家'),
            'headimgurl' => $this ->string(255)->comment('头像'),
            'subscribe_time' => $this->string(20),
            'created_at' => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('添加时间'),
            'updated_at' => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('更新时间')
        ]);
    }

    public function down()
    {
        echo "m161204_140805_create_table_we_chat cannot be reverted.\n";
        $this->dropTable('tq_we_chat');
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
