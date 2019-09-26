<?php

use yii\db\Migration;

/**
 * Class m190919_162121_color_create_table
 */
class m190919_162121_color_create_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%color}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string()->notNull(),
            'deleted' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
        $this->insert('{{%color}}', ['color' => 'red']);
        $this->insert('{{%color}}', ['color' => 'green']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apple}}');
    }
}
