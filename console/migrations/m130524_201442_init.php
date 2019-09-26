<?php

use yii\db\Migration;

/**
 * Class m130524_201442_init
 */
class m130524_201442_init extends Migration
{
    /** @inheritDoc */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'verification_token' => $this->string()
        ], $tableOptions);
        $this->insert(
            '{{%user}}',
            [
                'username' => 'admin',
                'password_hash' => '$2y$13$ZFKp7vDfFmGzOI8BTo9vLeTNVy7r8SpEJbzLKHejB8cmeMb3dHH6q',
                'status' => 10,
                'created_at' => 1568631945,
                'updated_at' => 1568631945
            ]
        );
    }

    /** @inheritDoc */
    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
