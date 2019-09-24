<?php

use yii\db\Migration;

/**
 * Class m190916_114613_apple_create_table
 */
class m190916_114613_apple_create_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'color_id' => $this->integer()->notNull(),
            'create_date' => $this->integer()->notNull(),
            'drop_date' => $this->integer()->null(),
            'state_id' => $this->integer()->notNull(),
            'how_much_is_eaten' => $this->integer()->notNull(),
            'deleted' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apple}}');
    }
}
