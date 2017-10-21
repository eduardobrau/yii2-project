<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "anuncios".
 *
 * @property integer $id
 * @property string $titulo
 * @property string $slogan
 * @property string $texto
 * @property string $telefone
 * @property string $endereco
 * @property string $site
 * @property integer $bairro_id
 * @property integer $categoria_id
 *
 * @property Bairros $bairro
 * @property Categorias $categoria
 * @property AnunciosRedesSociais[] $anunciosRedesSociais
 * @property AnunciosTags[] $anunciosTags
 */
class Anuncios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'anuncios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'texto', 'telefone', 'endereco', 'bairro_id', 'categoria_id'], 'required'],
            [['texto'], 'string'],
            [['bairro_id', 'categoria_id'], 'integer'],
            [['titulo'], 'string', 'max' => 250],
            [['slogan'], 'string', 'max' => 200],
            [['telefone', 'site'], 'string', 'max' => 45],
            [['endereco'], 'string', 'max' => 150],
            [['bairro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bairros::className(), 'targetAttribute' => ['bairro_id' => 'id']],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::className(), 'targetAttribute' => ['categoria_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'slogan' => 'Slogan',
            'texto' => 'Texto',
            'telefone' => 'Telefone',
            'endereco' => 'Endereco',
            'site' => 'Site',
            'bairro_id' => 'Bairro ID',
            'categoria_id' => 'Categoria ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBairro()
    {
        return $this->hasOne(Bairros::className(), ['id' => 'bairro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::className(), ['id' => 'categoria_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnunciosRedesSociais()
    {
        return $this->hasMany(AnunciosRedesSociais::className(), ['anuncio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnunciosTags()
    {
        return $this->hasMany(AnunciosTags::className(), ['anuncio_id' => 'id']);
    }
}
