<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 06/11/17
 * Time: 11:49
 */

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\AnunciosTags;

class CadastroAnuncioForm extends Model
{
  //Campos já existentes na tabela anuncios
  public $id;
  public $titulo;
  public $slogan;
  public $texto;
  public $telefone;
  public $endereco;
  public $site;
  public $bairro_id;
  public $categoria_id;
  public $usuario_id;
  public $status;
  // Necessário para update
  public $cidade_id;
  public $redes_sociais;
  public $tags_id;
  /*Campos necessários para atribuir valores que estão em outras
  tabelas e carregar dados para o form*/
  public $cidadesID;
  public $categoriasID;
  public $redesSociaisID;
  public $tagsID;

  public function rules(){
    return [
      [['titulo', 'texto', 'telefone', 'endereco', 'bairro_id', 'categoria_id', 'cidade_id', 'usuario_id', 'tags_id'], 'required'],
      [['titulo'], 'string', 'max'=>70],
      [['slogan'], 'string', 'max'=>60],
      [['texto'], 'string', 'max'=>1100],
      [['site'], 'string', 'max'=>45],
      [['bairro_id', 'categoria_id', 'usuario_id'], 'integer'],
      //[['imagens'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 3],
    ];
  }

  public function attributeLabels(){
    return [
      'id_anuncio' => 'Anuncio',
      'titulo' => 'Titulo',
      'slogan' => 'Slogan',
      'texto' => 'Texto',
      'telefone' => 'Telefone',
      'endereco' => 'Endereço',
      'site' => 'Site',
      'cidade_id' => 'Cidade',
      'bairro_id' => 'Bairro',
      'categoria_id' => 'Categoria',
      'tags_id' => 'Selecione até 3 palavras chaves'
    ];
  }

  //Função para setar as tags selecionadas do anuncio
  public function setSelectedTags()
  {
    $an_tags = AnunciosTags::find()->joinWith(['tag'])->
    andWhere(['anuncio_id' => $this->id])->orderBy('tags.tag ASC')->all();
    
    foreach($an_tags as $an_tag)
    {
      $this->tags_id[] = $an_tag->tag_id;
    }
  }

}