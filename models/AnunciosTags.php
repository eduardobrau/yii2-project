<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "anuncios_tags".
 *
 * @property integer $id
 * @property integer $anuncio_id
 * @property integer $tag_id
 *
 * @property Anuncios $anuncio
 * @property Tags $tag
 */
class AnunciosTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'anuncios_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['anuncio_id', 'tag_id'], 'required'],
            [['anuncio_id', 'tag_id'], 'integer'],
            [['anuncio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Anuncios::className(), 'targetAttribute' => ['anuncio_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::className(), 'targetAttribute' => ['tag_id' => 'id']],
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
            'tag_id' => 'Tag ID',
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
    public function getTag()
    {
        return $this->hasOne(Tags::className(), ['id' => 'tag_id']);
    }
}
