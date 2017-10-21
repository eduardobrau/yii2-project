<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cidades".
 *
 * @property integer $id
 * @property string $cidade
 *
 * @property Bairros[] $bairros
 */
class Cidades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cidades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cidade'], 'required'],
            [['cidade'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cidade' => 'Cidade',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBairros()
    {
        return $this->hasMany(Bairros::className(), ['cidade_id' => 'id']);
    }
}
