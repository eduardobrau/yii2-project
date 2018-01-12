<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

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
 * @property integer $usuario_id
 *
 * @property Bairros $bairro
 * @property Categorias $categoria
 * @property dBUsuarios $dBUsuarios
 * @property Uploads $Uploads
 * @property AnunciosRedesSociais[] $anunciosRedesSociais
 * @property AnunciosTags[] $anunciosTags
 */
class Anuncios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

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
            ['created_at', 'default', 'value' => date('Y-m-d H:i:s')],
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
     * Adicionado depois da geração do gii
     */
    public function getdBUsuario()
    {
        return $this->hasOne(dBUsuarios::className(), ['id' => 'usuario_id']);
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

    /**
   * @return \yii\db\ActiveQuery
   */
    public function getUploads()
    {
        return $this->hasMany(Uploads::className(), ['anuncio_id' => 'id']);
    }

    public function getTags()
    {
        foreach ($this->anunciosTags as $anuncioTag){
            $tags[]= $anuncioTag->tag->tag;
        }
        $tag = implode(', ', $tags);
        
        return $tag;
    }

    public function getAnuncios($cidade_id, $pagSize=NULL){
        
        $anuncios = Anuncios::find()
        ->joinWith(['bairro', 'bairro.cidade'])
        ->where([
            'cidades.id' => $cidade_id,
            'anuncios.status' => self::STATUS_ACTIVE
        ]);
    
        if($pagSize){
            $pages = new Pagination([
                'defaultPageSize' => $pagSize,
                'totalCount' => $anuncios->count(),
            ]);
        }else
            $pages = NULL;

        $query = $anuncios
        /* ->joinWith(['bairro','bairro.cidade'])
        ->andWhere(['cidades.id' => $cidade_id]) */
        ->asArray();
        if($pagSize){
            $query = $query
            ->offset($pages->offset)
            ->limit($pages->limit);
        }
        $query = $query
        ->all();

        $anuncios = array('anuncios' => $query, 'pages'  => $pages,);

        return $anuncios;
    }

    public function pesquisar($tag_id=false, $categoria_id=false, $cidade_id=false, $bairro_id=false){
                
        $query = Anuncios::find()
        ->joinWith([
        'categoria',
        'bairro',
        'bairro.cidade',
        'anunciosTags',
        'anunciosTags.tag',
        'anunciosRedesSociais',
        ])
        ->andFilterWhere([ 
            
            'anuncios_tags.tag_id' => $tag_id,
            'anuncios.categoria_id' => $categoria_id,
            'cidades.id' => $cidade_id,
            'bairros.id' => $bairro_id, 
            'anuncios.status' => self::STATUS_ACTIVE
        ]); 
        
        /* $pages = new Pagination([
            'totalCount' => $query->count(),
            
        ]);

        $query = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();
    
        $anuncios = array('anuncios' => $query, 'pages' => $pages); */
        
        return $query;
    }

}
