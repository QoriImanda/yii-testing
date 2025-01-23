<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%list_programmer}}`.
 */
class m250121_080957_create_list_programmer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%list_programmer}}', [
            'id' => $this->primaryKey(),
            'nama_programmer' => $this->string()->notNull(),
            'skill' => 'LONGTEXT',
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%list_programmer}}');
    }
}
