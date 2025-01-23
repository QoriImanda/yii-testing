<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "list_programmer".
 *
 * @property int $id
 * @property string $nama_programmer
 * @property string|null $skill
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class ListProgrammer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'list_programmer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_programmer'], 'required'],
            [['skill'], 'string'],
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
            'skill' => 'Skill',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
