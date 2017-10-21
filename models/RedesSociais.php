<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "redes_sociais".
 *
 * @property integer $id
 * @property string $rede_social
 *
 * @property AnunciosRedesSociais[] $anunciosRedesSociais
 */
class RedesSociais extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'redes_sociais';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rede_social'], 'required'],
            [['rede_social'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rede_social' => 'Rede Social',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnunciosRedesSociais()
    {
        return $this->hasMany(AnunciosRedesSociais::className(), ['rede_social_id' => 'id']);
    }
}
