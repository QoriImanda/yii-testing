<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "programmer".
 *
 * @property int $id
 * @property string|null $nama_programmer
 * @property string|null $programming_skill
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Programmer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'programmer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['programming_skill'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['nama_programmer'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_programmer' => 'Nama Programmer',
            'programming_skill' => 'Programming Skill',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
