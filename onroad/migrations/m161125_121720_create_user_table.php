<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m161125_121720_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tq_user', [
            'id' => $this->primaryKey()->comment('主键'),
            'username' => $this->string(50)->notNull()->comment('用户名'),
            'password' => $this->string(100)->notNull()->comment('用户密码'),
            'mobile' => $this->string(20)->notNull()->comment('用户手机号'),
            'authKey' => $this->string(100)->notNull()->comment('authKey')->defaultValue(''),
            'accessToken' => $this->string(100)->notNull()->defaultValue('')->comment('accessToken'),
            'created_at' => $this->integer(10)->defaultValue(0)->comment('添加时间'),
            'updated_at' => $this->integer(10)->defaultValue(0)->comment('更新时间')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tq_user');
    }
}
