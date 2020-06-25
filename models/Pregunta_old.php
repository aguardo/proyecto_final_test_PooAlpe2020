<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pregunta".
 *
 * @property int $id
 * @property string|null $texto
 * @property string|null $respuesta_correcta
 *
 * @property PreguntaCategoria[] $preguntaCategorias
 * @property Respuesta[] $respuestas
 */
class Pregunta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pregunta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['texto'], 'string', 'max' => 255],
            [['respuesta_correcta'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'texto' => 'Texto',
            'respuesta_correcta' => 'Respuesta Correcta',
        ];
    }

    /**
     * Gets query for [[PreguntaCategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPreguntaCategorias()
    {
        return $this->hasMany(PreguntaCategoria::className(), ['pregunta_id' => 'id']);
    }

    /**
     * Gets query for [[Respuestas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestas()
    {
        return $this->hasMany(Respuesta::className(), ['pregunta_id' => 'id']);
    }
    
    public function getCategorias(){
        return $this->hasMany(Categoria::className(), ['id' => 'categoria_id'])->via('preguntaCategorias');
       
    }
}
