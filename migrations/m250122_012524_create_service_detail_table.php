<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%service_detail}}`.
 */
class m250122_012524_create_service_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%service_detail}}', [
            'id' => $this->primaryKey(),
            'service_id' => $this->integer()->notNull()->comment('ID Layanan'),
            'layanan' => $this->string(255)->notNull()->comment('Layanan'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->comment('Dibuat Pada'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->comment('Diperbarui Pada'),
        ]);

        $this->addForeignKey(
            'fk-service_detail-service_id',
            '{{%service_detail}}',
            'service_id',
            '{{%service}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-service_detail-service_id', '{{%service_detail}}');
        $this->dropTable('{{%service_detail}}');
    }
}
