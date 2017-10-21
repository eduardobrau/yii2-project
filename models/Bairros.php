<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bairros".
 *
 * @property integer $id
 * @property string $bairro
 * @property string $cep
 * @property integer $cidade_id
 *
 * @property Anuncios[] $anuncios
 * @property Cidades $cidade
 */
class Bairros extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bairros';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bairro', 'cidade_id'], 'required'],
            [['cidade_id'], 'integer'],
            [['bairro'], 'string', 'max' => 150],
            [['cep'], 'string', 'max' => 10],
            [['cidade_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cidades::className(), 'targetAttribute' => ['cidade_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bairro' => 'Bairro',
            'cep' => 'Cep',
            'cidade_id' => 'Cidade ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnuncios()
    {
        return $this->hasMany(Anuncios::className(), ['bairro_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCidade()
    {
        return $this->hasOne(Cidades::className(), ['id' => 'cidade_id']);
    }
}
