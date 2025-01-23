<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%service}}`.
 */
class m250122_012513_create_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%service}}', [
            'id' => $this->primaryKey(),
            'pasien_id' => $this->integer()->notNull()->comment('Pasien ID'),
            'date' => $this->date()->notNull()->comment('Tanggal Layanan'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->comment('Dibuat Pada'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->comment('Diperbarui Pada'),
        ]);

        $this->addForeignKey(
            'fk-service-pasien_id',
            '{{%service}}',
            'pasien_id',
            '{{%pasien}}',
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
        $this->dropForeignKey('fk-service-pasien_id', '{{%service}}');
        $this->dropTable('{{%service}}');
    }
}
