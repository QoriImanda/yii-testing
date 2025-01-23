<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pasien}}`.
 */
class m250121_074727_create_pasien_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pasien}}', [
            'id' => $this->primaryKey(),
            'no_rekam_medis' => $this->integer()->notNull(),
            'no_identitas' => $this->integer()->notNull(),
            'nama_pasien' => $this->string()->notNull(),
            'tempat_lahir' => $this->string()->notNull(),
            'tgl_lahir' => $this->date(),
            'umur' => $this->string()->notNull(),
            'jenis_kelamin' => "ENUM('Laki-laki', 'Perempuan')",
            'agama' => $this->string()->notNull(),
            'pendidikan' => $this->string()->notNull(),
            'pekerjaan' => $this->string()->notNull(),
            'no_hp' => $this->string()->notNull(),
            'alamat' => $this->string()->notNull(),
            'kewarganegaraan' => $this->string()->notNull(),
            'provinsi' => $this->string()->notNull(),
            'kabupaten' => $this->string()->notNull(),
            'kecamatan' => $this->string()->notNull(),
            'kelurahan' => $this->string()->notNull(),
            'marital_status' => $this->string()->notNull(),
            'nama_ayah' => $this->string()->notNull(),
            'nama_ibu' => $this->string()->notNull(),
            'riwayat_penyakit' => 'LONGTEXT',
            'penanggung_pasien' => $this->string(),
            'no_kartu' => $this->integer(),
            'berkas_penanggung_pasien' => $this->string(),
            'berkas' => $this->string(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pasien}}');
    }
}
