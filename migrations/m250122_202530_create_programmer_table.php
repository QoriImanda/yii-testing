<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%programmer}}`.
 */
class m250122_202530_create_programmer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%programmer}}', [
            'id' => $this->primaryKey(),
            'nama_programmer' => $this->string(),
            'programming_skill' => 'LONGTEXT',
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%programmer}}');
    }
}
