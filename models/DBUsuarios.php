<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property integer $id
 * @property string $user_name
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 * @property string $email
 * @property Anuncios[] $anuncios
 * @property Perfil[] $perfils
 * @property integer $admin 
 */
class DBUsuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_name', 'password', 'email'], 'required'],
            [['user_name'], 'string', 'max' => 50],
            [['password', 'auth_key', 'access_token'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_name' => 'Usuário',
            'password' => 'Senha',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnuncios()
    {
        return $this->hasMany(Anuncios::className(), ['usuario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerfils()
    {
        return $this->hasMany(Perfil::className(), ['usuario_id' => 'id']);
    }
}
