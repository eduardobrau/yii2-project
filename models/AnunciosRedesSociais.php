<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "anuncios_redes_sociais".
 *
 * @property integer $id
 * @property integer $anuncio_id
 * @property integer $rede_social_id
 * @property string $url
 *
 * @property Anuncios $anuncio
 * @property RedesSociais $redeSocial
 */
class AnunciosRedesSociais extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'anuncios_redes_sociais';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'anuncio_id', 'rede_social_id'], 'required'],
            [['id', 'anuncio_id', 'rede_social_id'], 'integer'],
            [['url'], 'string', 'max' => 150],
            [['anuncio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Anuncios::className(), 'targetAttribute' => ['anuncio_id' => 'id']],
            [['rede_social_id'], 'exist', 'skipOnError' => true, 'targetClass' => RedesSociais::className(), 'targetAttribute' => ['rede_social_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'anuncio_id' => 'Anuncio ID',
            'rede_social_id' => 'Rede Social ID',
            'url' => 'Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnuncio()
    {
        return $this->hasOne(Anuncios::className(), ['id' => 'anuncio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRedeSocial()
    {
        return $this->hasOne(RedesSociais::className(), ['id' => 'rede_social_id']);
    }
}
