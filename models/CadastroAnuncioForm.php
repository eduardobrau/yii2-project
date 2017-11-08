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

class CadastroAnuncioForm extends Model
{
  //Campos já existentes na tabela anuncios
  public $titulo;
  public $slogan;
  public $texto;
  public $telefone;
  public $endereco;
  public $site;
  public $bairro_id;
  public $categoria_id;
  /*Campos necessários para atribuir valores que estão em outras
  tabelas e carregar dados para alguns campos*/
  public $cidade_id;
  public $redesSociaisID;


  public function rules(){
    return [
      [['titulo', 'texto', 'telefone', 'endereco', 'bairro_id', 'categoria_id', 'cidade_id'], 'required'],
      [['titulo', 'slogan'], 'string', 'max'=>200],
      [['texto'], 'string'],
      [['site'], 'string', 'max'=>45],
      [['bairro_id', 'categoria_id'], 'integer'],
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
    ];
  }
}